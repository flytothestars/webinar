<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StartStreaming extends Command
{
    protected $signature = 'stream:start';
    
    protected $description = 'Start video streaming using FFmpeg at a scheduled time';

    public function handle()
    {
        Log::info('Starting video stream...');

        // $videoPath = storage_path('app/public/sample.mp4');  // Путь к видео в проекте
        // $rtmpUrl = "rtmp://185.146.3.39:1935/live/stream";

        // ffmpeg -re -i /var/www/vebinar/public/storage/sample.mp4 -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf "scale=1280:720" -g 60 -c:a aac -b:a 128k -ac 2 -f hls -hls_time 5 -hls_list_size 10 -hls_flags delete_segments /var/www/hls/stream.m3u8
        // if (!file_exists($videoPath)) {
        //     Log::error("Video file not found: $videoPath");
        //     $this->error("Video file not found.");
        //     return;
        // }

        // $command = "ffmpeg -re -i $videoPath -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf 'scale=1280:720' -g 60 -c:a aac -b:a 128k -ac 2 -f flv $rtmpUrl";
        $command = 'ffmpeg -re -i /var/www/vebinar/public/storage/sample.mp4 -c:v libx264 -preset veryfast -b:v 3000k -maxrate 3000k -bufsize 6000k -vf "scale=1280:720" -g 60 -c:a aac -b:a 128k -ac 2 -f hls -hls_time 5 -hls_list_size 10 -hls_flags delete_segments /var/www/hls/stream.m3u8';
        shell_exec($command);

        Log::info('Video stream started successfully.');
        $this->info('Streaming started.');
    }
}
