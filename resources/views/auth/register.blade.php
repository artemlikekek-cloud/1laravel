<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <section class="auth-section">
            <h1>Регистрация</h1>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="username">Логин:</label>
                    <input type="text" id="username" name="username" placeholder="Введите логин..." 
                           value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль..." required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Подтверждение пароля:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           placeholder="Повторите пароль..." required>
                </div>

                <button type="submit" class="btn btn-blue">Зарегистрироваться</button>
            </form>

            <p class="auth-link">
                Уже есть аккаунт? <a href="{{ route('login') }}">Войдите здесь</a>
            </p>
        </section>
    </main>

    @include('components.footer')

</body>
</html>
