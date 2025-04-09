<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Webinar;
use App\Enums\StatusEnum;
use Illuminate\Support\Facades\File;

class StartStreaming extends Command
{
    protected $signature = 'stream:start';
    
    protected $description = 'Start video streaming using FFmpeg at a scheduled time';

    public function handle()
    {
        $currentTime = now()->format('H:i');
        $currentDate = now()->format('Y-m-d');

        $timeBefore = now()->subMinute()->format('H:i');  // 1 минута до
        $timeAfter = now()->addMinute()->format('H:i');   // 1 минута после

        $webinars = Webinar::where('status', StatusEnum::PUBLISHED->value)->get();
        foreach ($webinars as $webinar) {
            $startTime = $webinar->time;
            $startDate = $webinar->date;
            if ($webinar->status !== StatusEnum::STARTED->value) {
                if($currentDate === $startDate)
                {
                    if ($currentTime === $startTime || $timeBefore === $startTime || $timeAfter === $startTime) {
                        Log::info("Checking stream for {$startTime}...");
                        
                        $webinar->update(['status' => StatusEnum::STARTED]);
                        Log::info("Video stream started for webinar {$webinar->id}");
                        $this->startStream($webinar); 
                        Log::info('Video stream end successfully.');
                        $this->info('Streaming end.');
                    }
                }
            }
        }
    }

    private function startStream($webinar)
    {
        $file = $webinar->attachment('webinarVideo')->first();
        $path = storage_path('app/public/' . $file->path . $file->name . '.' . $file->extension);
        $pathHls = '/var/www/webinar/hls/' . $file->name;
        
        if (!file_exists($pathHls)) {
            mkdir($pathHls, 0755, true);
        }
    
        $hlsFile = $pathHls . '/' . $file->name . '.m3u8';
        
        $output = [];
        $statusCode = null;
        
        $command = "ffmpeg -re -i $path -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf 'scale=1280:720' -g 60 -c:a aac -b:a 128k -ac 2 -f hls -hls_time 5 -hls_list_size 10 -hls_flags delete_segments $hlsFile"; 
        
        exec($command, $output, $statusCode);

        Log::info($output);
        if ($statusCode === 0) {
            Log::info('Video stream finished successfully.');
            $webinar->update(['status' => StatusEnum::FINISHED]);
            $this->deleteDirectory($file->name);
            return true;
        } else {
            Log::error('Ошибка запуска стрима: ' . implode("\n", $output));
            return false;
        }
    }

    private function deleteDirectory($uuid) {
        $folderPath = base_path("hls/$uuid");

        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
            Log::info('deleted');
            return true;
        } else {
            return false;
        }
    }

}


// $videoFilePath = '/path/to/video/source';
        // $command = "ffmpeg -i {$videoFilePath} -c:v libx264 -f flv rtmp://streaming/server";
        // Используем exec для получения кода статуса
       
        // $videoPath = storage_path('app/public/sample.mp4');  // Путь к видео в проекте
        // $rtmpUrl = "rtmp://185.146.3.39:1935/live/stream";

        // ffmpeg -re -i /var/www/vebinar/public/storage/sample.mp4 -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf "scale=1280:720" -g 60 -c:a aac -b:a 128k -ac 2 -f hls -hls_time 5 -hls_list_size 10 -hls_flags delete_segments /var/www/hls/stream.m3u8
        // if (!file_exists($videoPath)) {
        //     Log::error("Video file not found: $videoPath");
        //     $this->error("Video file not found.");
        //     return;
        // }

        // $command = "ffmpeg -re -i $videoPath -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf 'scale=1280:720' -g 60 -c:a aac -b:a 128k -ac 2 -f flv $rtmpUrl";
        // $command = 'ffmpeg -re -i /var/www/vebinar/public/storage/sample.mp4 -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf "scale=1280:720" -g 60 -c:a aac -b:a 128k -ac 2 -f hls -hls_time 5 -hls_list_size 10 -hls_flags delete_segments /var/www/hls/stream.m3u8';
        // shell_exec($command);