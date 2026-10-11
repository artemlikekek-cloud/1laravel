<header>
    <nav>
        <a href="/">Главная</a>
        
        <!-- Меню категорий -->
        <div class="dropdown">
            <button class="dropdown-btn">Категории ▼</button>
            <div class="dropdown-content">
                @foreach (\App\Models\Category::get() as $category)
                    <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        
        @auth
            @if (Auth::user()->role->name === 'journalist' || Auth::user()->role->name === 'admin')
                <a href="/journalist">Журналист</a>
            @endif
        @endauth
        @auth
            @if (Auth::user()->role->name === 'admin')
                <a href="/admin">Админ</a>
            @endif
        @endauth
    </nav>
    <div class="header-auth">
        @auth
            <span>{{ Auth::user()->username }}</span>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-red btn-small">Выход</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-blue btn-small">Вход</a>
            <a href="{{ route('register') }}" class="btn btn-blue btn-small">Регистрация</a>
        @endauth
    </div>
</header>