<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Категория</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <h1>Категория: Информационные технологии</h1>

        <section>
            <h2>Новый язык программирования</h2>
            <img src="https://picsum.photos/200/150?1" alt="IT">
            <p>Вышла новая версия языка с улучшенной производительностью и новыми возможностями для разработчиков...</p>
        </section>

        <section>
            <h2>Искусственный интеллект достиг нового уровня</h2>
            <img src="https://picsum.photos/200/150?2" alt="AI">
            <p>AI научился предсказывать болезни с точностью 99% на основе анализа медицинских снимков...</p>
        </section>

        <section>
            <h2>Квантовые компьютеры открывают новые возможности</h2>
            <img src="https://picsum.photos/200/150?3" alt="Quantum">
            <p>Создан первый универсальный квантовый компьютер с 1000 кубитов, способный решать задачи...</p>
        </section>
    </main>

    @include('components.footer')

</body>
</html>