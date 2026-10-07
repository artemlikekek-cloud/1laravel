<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <section>
            <h2>Прорыв в IT</h2>
            <img src="https://picsum.photos/200/150?1" alt="IT">
            <p>Учёные создали новый алгоритм, который ускоряет работу нейросетей в 10 раз. Разработка уже тестируется в крупных компаниях.</p>
        </section>

        <section>
            <h2>Новости космоса</h2>
            <img src="https://picsum.photos/200/150?2" alt="Космос">
            <p>Телескоп NASA обнаружил новую экзопланету в зоне обитаемости. Учёные не исключают наличие воды на её поверхности.</p>
        </section>

        <section>
            <h2>Медицина</h2>
            <img src="https://picsum.photos/200/150?3" alt="Медицина">
            <p>Разработана новая вакцина против сезонного вируса. Клинические испытания показали эффективность 95%.</p>
        </section>

        <section>
            <h2>Робототехника</h2>
            <img src="https://picsum.photos/200/150?4" alt="Робот">
            <p>Инженеры представили робота, который умеет готовить завтрак. Премьера состоится на выставке технологий в Токио.</p>
        </section>
    </main>

    @include('components.footer')

</body>
</html>