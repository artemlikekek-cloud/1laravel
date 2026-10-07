<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Журналист</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <h1>Панель журналиста</h1>
        
        <section>
            <h2>Опубликовать новую статью</h2>
            
            <form action="#" method="POST" style="text-align: left;">
                @csrf
                
                <div class="form-group">
                    <label>Заголовок статьи:</label>
                    <input type="text" name="title" placeholder="Введите заголовок..." required>
                </div>

                <div class="form-group">
                    <label>Категория:</label>
                    <select name="category" required>
                        <option value="">Выберите категорию</option>
                        <option>IT</option>
                        <option>Медицина</option>
                        <option>Космос</option>
                        <option>Робототехника</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Текст статьи:</label>
                    <textarea name="content" rows="8" placeholder="Введите текст статьи..." required></textarea>
                </div>

                <button type="submit" class="btn btn-blue">Опубликовать</button>
            </form>
        </section>
    </main>

    @include('components.footer')

</body>
</html>