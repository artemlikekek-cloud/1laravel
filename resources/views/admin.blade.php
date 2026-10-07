<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <h1>Админ-панель</h1>

        <h2>📰 Управление статьями</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Автор</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Прорыв в IT</td>
                    <td>Иван</td>
                    <td>Опубликована</td>
                    <td>
                        <button class="btn btn-blue">Редактировать</button>
                        <button class="btn btn-yellow">Заблокировать</button>
                        <button class="btn btn-red">Удалить</button>
                    </td>
            </tbody>
        </table>

        <h2 style="margin-top: 30px;">👥 Управление пользователями и ролями</h2>
        <section>
            <form action="#" method="POST" style="text-align: left; max-width: 400px; margin: 0 auto;">
                @csrf
                
                <div class="form-group">
                    <label>Пользователь:</label>
                    <select name="user_id" required>
                        <option value="">Выберите пользователя</option>
                        <option value="1">user1@example.com (Иван)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Роль:</label>
                    <select name="role" required>
                        <option value="reader">Читатель</option>
                        <option value="journalist">Журналист</option>
                        <option value="admin">Администратор</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-blue">Изменить роль</button>
            </form>
        </section>
    </main>

    @include('components.footer')

</body>
</html>