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
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert-info">
                {{ session('info') }}
            </div>
        @endif

        <h1>Все статьи</h1>

        @forelse ($texts as $text)
            <section class="article-item">
                <h2><a href="{{ route('article.show', $text->slug) }}">{{ $text->title }}</a></h2>
                <div class="article-meta">
                    <span><strong>Категория:</strong> <a href="{{ route('category.show', $text->category->slug) }}">{{ $text->category->name }}</a></span>
                    <span><strong>Автор:</strong> {{ $text->author->username }}</span>
                    <span><strong>Дата:</strong> {{ $text->published_at->format('d.m.Y H:i') }}</span>
                </div>
                <p>{{ Str::limit($text->content, 200) }}</p>
                <a href="{{ route('article.show', $text->slug) }}" class="btn btn-blue">Читать далее</a>
            </section>
        @empty
            <p>Статей пока нет. <a href="/register">Зарегистрируйтесь</a> и опубликуйте первую статью!</p>
        @endforelse

        <!-- Pagination -->
        @if ($texts->hasPages())
            <div class="pagination-container">
                {{ $texts->links() }}
            </div>
        @endif
    </main>

    @include('components.footer')

</body>
</html>