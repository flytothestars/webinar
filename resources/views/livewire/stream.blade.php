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
        <div class="w-full max-w-4xl mt-6">
            <h2>{{$video_name}}</h2>
            <video id="player" class="video-js vjs-default-skin rounded-xl shadow-xl w-full h-[450px]" height="360" width="640" preload="auto" controls autoplay muted disablePictureInPicture>
                <source src="http://80.242.213.87/hls/{{$video_uuid}}/{{$video_uuid}}.m3u8" type="application/x-mpegURL"/>
            </video>
            <p id="thank-you-message" class="hidden text-center text-lg mt-4">Спасибо за внимание!</p>
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

            // Когда видео закончится, показать текст "Спасибо за внимание"
            player.on('ended', function() {
                // Останавливаем плеер
                player.pause();
                // Скрываем плеер
                document.getElementById('video-container').innerHTML = '';
                // Показываем текст
                document.getElementById('thank-you-message').classList.remove('hidden');
            });
        </script>
    @endif
</div>
