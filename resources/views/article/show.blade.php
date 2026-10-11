<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $text->title }}</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <article>
            <h1>{{ $text->title }}</h1>

            <div class="article-info">
                <div class="article-info-text">
                    <span><strong>Категория:</strong> <a href="{{ route('category.show', $text->category->slug) }}">{{ $text->category->name }}</a></span>
                    <span style="margin-left: 20px;"><strong>Автор:</strong> {{ $text->author->username }}</span>
                    <span style="margin-left: 20px;"><strong>Дата публикации:</strong> {{ $text->published_at->format('d.m.Y H:i') }}</span>
                </div>

                @auth
                    @if (Auth::id() === $text->user_id)
                        <div class="article-actions">
                            <a href="{{ route('article.edit', $text->id) }}" class="btn btn-blue">Редактировать</a>
                            <form action="{{ route('article.destroy', $text->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red" 
                                        onclick="return confirm('Вы уверены что хотите удалить эту статью?')">Удалить</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <div class="article-content">
                {!! nl2br(e($text->content)) !!}
            </div>

            <hr>

            <p>
                <a href="/">← Вернуться на главную</a> | 
                <a href="{{ route('category.show', $text->category->slug) }}">Другие статьи категории "{{ $text->category->name }}"</a>
            </p>
        </article>
    </main>

    @include('components.footer')

</body>
</html>
