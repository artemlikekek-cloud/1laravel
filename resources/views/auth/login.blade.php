<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <section class="auth-section">
            <h1>Вход</h1>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="username">Логин:</label>
                    <input type="text" id="username" name="username" placeholder="Введите логин..." 
                           value="{{ old('username') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль..." required>
                </div>

                <button type="submit" class="btn btn-blue">Войти</button>
            </form>

            <p class="auth-link">
                Нет аккаунта? <a href="{{ route('register') }}">Зарегистрируйтесь здесь</a>
            </p>
        </section>
    </main>

    @include('components.footer')

</body>
</html>
