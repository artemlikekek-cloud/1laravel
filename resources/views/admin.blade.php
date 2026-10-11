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
                    <th>Категория</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\Text::with('author', 'category')->get() as $text)
                    <tr>
                        <td>{{ $text->id }}</td>
                        <td>{{ $text->title }}</td>
                        <td>{{ $text->author->username }}</td>
                        <td>{{ $text->category->name }}</td>
                        <td>{{ $text->created_at->format('d.m.Y') }}</td>
                        <td>
                            <form action="{{ route('article.destroy', $text->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red" onclick="return confirm('Удалить?')">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>👥 Управление пользователями и ролями</h2>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Логин</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\User::with('role')->get() as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                <form action="{{ route('admin.update-role', $user->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()">
                                        @foreach (\App\Models\Role::get() as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                @if ($user->id !== Auth::id())
                                    <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red" onclick="return confirm('Удалить пользователя?')">Удалить</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>

    @include('components.footer')

</body>
</html>