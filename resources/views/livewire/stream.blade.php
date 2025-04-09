<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-4">
    @if(!$registered)
        <div class="bg-white p-6 rounded-xl shadow-xl w-full max-w-md">
            <h2 class="text-xl font-bold mb-4 text-center">Регистрация на вебинар</h2>
            <form wire:submit.prevent="register" class="space-y-4">
                <input wire:model="name" type="text" placeholder="Ваше имя" class="w-full border px-4 py-2 rounded-lg">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <input wire:model="phone" type="text" placeholder="Телефон" class="w-full border px-4 py-2 rounded-lg">
                @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 w-full">Смотреть</button>
            </form>
        </div>
    @else
        <div wire:poll.1s="checkStreamStatus" class="w-full max-w-4xl mt-6">
            @if($isLive)
                <h2>{{$video_name}}</h2>
                <div class="text-green-600 font-bold">Стрим в эфире!</div>
                <video id="video" autoplay muted playsinline></video>

            @else
                <p id="thank-you-message" class="text-center text-lg mt-4">Спасибо за внимание!</p>
            @endif
        </div>
        <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
        <script>
            var player = videojs('#player', {
                controlBar: {
                    pictureInPictureToggle: false, // Отключаем PiP
                    volumePanel: { inline: false } // Оставляем кнопку громкости
                }
            });

            // Гарантируем, что видео не остановится
            player.on('pause', function() {
                player.play();
            });

            // Если вкладка стала активной — продолжить проигрывание
            document.addEventListener("visibilitychange", function() {
                if (document.visibilityState === "visible") {
                    player.play();
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>
        <script>
        if (Hls.isSupported()) {
            var video = document.getElementById('video');
            var hls = new Hls();
            hls.on(Hls.Events.MEDIA_ATTACHED, function () {
            console.log('video and hls.js are now bound together !');
            });
            hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
            console.log(
                'manifest loaded, found ' + data.levels.length + ' quality level',
            );
            });
            hls.loadSource('http://80.242.213.87/hls/{{ $video_uuid }}/{{ $video_uuid }}.m3u8');
            // bind them together
            hls.attachMedia(video);
        }
        </script>
    @endif
</div>
