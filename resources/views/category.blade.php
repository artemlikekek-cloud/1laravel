<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $category->name }}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <h1>Категория: {{ $category->name }}</h1>
        @if ($category->description)
            <p>{{ $category->description }}</p>
        @endif

        @forelse ($texts as $text)
            <section class="article-item">
                <h2><a href="{{ route('article.show', $text->slug) }}">{{ $text->title }}</a></h2>
                <div class="article-meta">
                    <span><strong>Автор:</strong> {{ $text->author->username }}</span>
                    <span><strong>Дата:</strong> {{ $text->published_at->format('d.m.Y H:i') }}</span>
                </div>
                <p>{{ Str::limit($text->content, 200) }}</p>
                <a href="{{ route('article.show', $text->slug) }}" class="btn btn-blue">Читать далее</a>
            </section>
        @empty
            <p>В этой категории пока нет статей.</p>
        @endforelse

        <!-- Pagination -->
        @if ($texts->hasPages())
            <div class="pagination-container">
                {{ $texts->links() }}
            </div>
        @endif

        <p class="back-link">
            <a href="/">← Вернуться на главную</a>
        </p>
    </main>

    @include('components.footer')

</body>
</html>