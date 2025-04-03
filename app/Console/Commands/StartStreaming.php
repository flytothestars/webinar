<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use App\Enum\StatusEnum;

class StartStreaming extends Command
{
    protected $signature = 'stream:start';
    
    protected $description = 'Start video streaming using FFmpeg at a scheduled time';

    public function handle()
    {
        $currentTime = now()->format('H:i');
        
        // Определяем время для проверки до и после (19:29 и 19:31, например)
        $timeBefore = now()->subMinute()->format('H:i');  // 1 минута до
        $timeAfter = now()->addMinute()->format('H:i');   // 1 минута после

        // Получаем все опубликованные настройки
        $settings = Setting::where('status', StatusEnum::PUBLISHED)->get();
        
        foreach ($settings as $setting) {
            // Получаем время старта из настроек
            $startTime = $setting->start_time;

            // Проверяем, если текущее время находится между timeBefore и timeAfter
            if ($currentTime === $startTime || $timeBefore === $startTime || $timeAfter === $startTime) {
                Log::info("Checking stream for {$startTime}...");
                
                // Запуск видео стрима
                $this->startStream();
            }
        }

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
        $command = "ffmpeg -i /path/to/video/source -c:v libx264 -f flv rtmp://streaming/server";
        
        // Выполнение команды
        shell_exec($command);

        // Логирование
        Log::info('Video stream started successfully.');
    }
}
