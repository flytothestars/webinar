<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Онлайн Вебинар</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to right, #eef2f3, #f3f4f6);
      color: #1f2937;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    header {
      background: linear-gradient(135deg, #4f46e5, #3b82f6);
      color: white;
      padding: 3rem 1.5rem;
      text-align: center;
    }
    header h1 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      animation: fadeIn 1s ease-in-out;
    }
    header p {
      font-size: 1.2rem;
      opacity: 0.9;
      animation: fadeIn 1.2s ease-in-out;
    }

    main {
      flex: 1;
      padding: 2rem 1.5rem;
      max-width: 900px;
      margin: 0 auto;
    }

    .section {
      margin-bottom: 2.5rem;
      background-color: white;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      transition: transform 0.3s ease;
    }

    .section:hover {
      transform: translateY(-5px);
    }

    .section h2 {
      color: #4f46e5;
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }

    .section p {
      font-size: 1.1rem;
      line-height: 1.6;
    }

    .whatsapp-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background-color: #25D366;
      color: white;
      font-weight: 600;
      padding: 0.9rem 1.8rem;
      font-size: 1rem;
      border: none;
      border-radius: 12px;
      text-decoration: none;
      transition: background-color 0.3s, transform 0.2s;
      box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
    }

    .whatsapp-btn:hover {
      background-color: #1ebe5d;
      transform: scale(1.03);
    }

    .whatsapp-icon {
      font-size: 1.3rem;
    }

    footer {
      text-align: center;
      padding: 1.5rem;
      font-size: 0.9rem;
      color: #6b7280;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
      header h1 {
        font-size: 2rem;
      }
      .section {
        padding: 1.2rem;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Онлайн Вебинар: Стартуй с нами!</h1>
    <p>Участвуй в обучении из любой точки мира</p>
  </header>

  <main>
    <section class="section">
      <h2>📚 Что вас ждет</h2>
      <p>Погружение в полезные темы, доступ к лучшим спикерам и ответы на ваши вопросы в режиме реального времени. Все участники получат материалы после вебинара.</p>
    </section>

    <section class="section">
      <h2>🧭 Как это работает</h2>
      <p>После регистрации мы отправим вам ссылку на трансляцию. Участие бесплатное. Просто подключайтесь в указанное время и получайте знания!</p>
    </section>

    <section class="section">
      <h2>💬 Остались вопросы?</h2>
      <p>Мы всегда на связи. Напишите нам в WhatsApp — ответим быстро!</p>
      <a class="whatsapp-btn" href="https://wa.me/77077711197" target="_blank">
        <span class="whatsapp-icon">💬</span> Написать в WhatsApp
      </a>
    </section>
  </main>

  <footer>
    © 2025 Онлайн Вебинар. Все права защищены.
  </footer>

</body>
</html>
