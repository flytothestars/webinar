<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Webinar;
use App\Enums\StatusEnum;

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
            if($currentDate === $startDate)
            {
                if ($currentTime === $startTime || $timeBefore === $startTime || $timeAfter === $startTime) {
                    Log::info("Checking stream for {$startTime}...");
                    
                    if($this->startStream()) {
                        $webinar->update(['status' => StatusEnum::STARTED]);
                    }
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

        Log::info('Video stream started successfully.');
        $this->info('Streaming started.');
    }

    private function startStream()
    {
        // Команда для запуска видео стрима через ffmpeg
        // $command = "ffmpeg -i /path/to/video/source -c:v libx264 -f flv rtmp://streaming/server";
        
        // Выполнение команды
        // shell_exec($command);
        $output = [];
        $statusCode = null;
        $command = 'echo "Hello World"'; 
        
        exec($command, $output, $statusCode);
        Log::info($output);
        if ($statusCode === 0) {
            Log::info('Video stream started successfully.');
            return true;
        } else {
            // Если команда завершилась с ошибкой, логируем вывод и возвращаем false
            Log::error('Ошибка запуска стрима: ' . implode("\n", $output));
            return false;
        }
        // Логирование
        Log::info('Video stream started successfully.');
    }
}
