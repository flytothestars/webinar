
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Stream</title>
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet">
    <style>
        /* Скрываем кнопку паузы */
        .vjs-play-control {
            display: none !important;
        }
    </style>
</head>
<body>
    <video id="player" class="video-js vjs-default-skin" height="360" width="640" preload="auto" controls autoplay muted disablePictureInPicture>
        <source src="https://testbilimzet.kz:8877/hls/stream.m3u8" type="application/x-mpegURL"/>
    </video>
 <h1>ali</h1>
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
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вебинар</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- @livewireStyles -->
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background: #111; color: #fff; overflow: hidden; }
        .modal { position: fixed; inset: 0; background: rgba(0,0,0,0.8); display: flex; justify-content: center; align-items: center; z-index: 2; }
        .modal-content { background: #222; padding: 20px; border-radius: 10px; width: 300px; }
        .player { display: flex; flex-direction: column; align-items: center; margin-top: 100px; z-index: 2; position: relative; }
        .count { margin-top: 10px; font-size: 18px; }
        canvas { position: fixed; top: 0; left: 0; z-index: 1; }
    </style>
</head>
<body>

<canvas id="stars"></canvas>

<div id="modal" class="modal">
    <div class="modal-content">
        <h3>Введите данные</h3>
        <input type="text" id="name" placeholder="Ваше имя" style="width:100%;margin-top:10px;padding:8px;">
        <input type="text" id="phone" placeholder="Телефон" style="width:100%;margin-top:10px;padding:8px;">
        <button onclick="submitForm()" style="width:100%;margin-top:10px;padding:8px;">Войти</button>
    </div>
</div>

<div class="player" id="player" style="display:none;">
    <h1>Вебинар скоро начнётся...</h1>
    <video width="640" height="360" controls muted autoplay loop style="margin-top:20px;">
        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
    </video>
    <!-- @livewire('webinar-counter') -->
</div>

<!-- @livewireScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/jquery.inputmask.min.js"></script>
<script>
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    $(document).ready(function() {
        $('#phone').inputmask("+7 999 999 99 99", {
            clearIncomplete: true,
            showMaskOnHover: false,
            showMaskOnFocus: true
        });
    });

    function submitForm() {
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        fetch('/webinar/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf
            },
            body: JSON.stringify({ name, phone })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modal').style.display = 'none';
                document.getElementById('player').style.display = 'flex';
                Livewire.emit('userRegistered');
            }
        });
    }

    // Stars Animation
    const canvas = document.getElementById('stars');
    const ctx = canvas.getContext('2d');

    let w = window.innerWidth;
    let h = window.innerHeight;
    canvas.width = w;
    canvas.height = h;

    const stars = [];

    for (let i = 0; i < 150; i++) {
        stars.push({
            x: Math.random() * w,
            y: Math.random() * h,
            radius: Math.random() * 1.5,
            vx: -0.5 + Math.random(),
            vy: -0.5 + Math.random()
        });
    }

    function drawStars() {
        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = '#fff';
        ctx.shadowBlur = 2;
        ctx.shadowColor = '#fff';

        for (let i = 0; i < stars.length; i++) {
            const s = stars[i];
            ctx.beginPath();
            ctx.arc(s.x, s.y, s.radius, 0, 2 * Math.PI);
            ctx.fill();
        }

        moveStars();
    }

    function moveStars() {
        for (let i = 0; i < stars.length; i++) {
            const s = stars[i];
            s.x += s.vx;
            s.y += s.vy;

            if (s.x < 0 || s.x > w) s.x = Math.random() * w;
            if (s.y < 0 || s.y > h) s.y = Math.random() * h;
        }
    }

    function animate() {
        drawStars();
        requestAnimationFrame(animate);
    }

    animate();

    window.addEventListener('resize', () => {
        w = window.innerWidth;
        h = window.innerHeight;
        canvas.width = w;
        canvas.height = h;
    });
</script>
</body>
</html>
