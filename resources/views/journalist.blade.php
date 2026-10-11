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

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <section>
            <h2>Опубликовать новую статью</h2>
            
            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('article.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>Заголовок статьи:</label>
                    <input type="text" name="title" placeholder="Введите заголовок..." 
                           value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label>Категория:</label>
                    <select name="category_id" required>
                        <option value="">Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Текст статьи:</label>
                    <textarea name="content" rows="8" placeholder="Введите текст статьи..." 
                              required>{{ old('content') }}</textarea>
                </div>

                <button type="submit" class="btn btn-blue">Опубликовать</button>
            </form>
        </section>

        <h2>Мои статьи</h2>
        
        <div class="articles-container">
            @forelse ($userTexts as $text)
                <section class="article-card">
                    <h3>{{ $text->title }}</h3>
                    <div class="article-card-meta">
                        <span><strong>Категория:</strong> {{ $text->category->name }}</span>
                        <span><strong>Дата:</strong> {{ $text->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <p>{{ Str::limit($text->content, 150) }}</p>
                    <div class="article-card-actions">
                        <a href="{{ route('article.edit', $text->id) }}" class="btn btn-blue">Редактировать</a>
                        <form action="{{ route('article.destroy', $text->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-red" 
                                    onclick="return confirm('Вы уверены что хотите удалить эту статью?')">Удалить</button>
                        </form>
                    </div>
                </section>
            @empty
                <p class="empty-message">Вы ещё не опубликовали статей. Создайте первую выше!</p>
            @endforelse

            @if ($userTexts->hasPages())
                <div class="pagination-container">
                    {{ $userTexts->links() }}
                </div>
            @endif
        </div>
    </main>

    @include('components.footer')

</body>
</html>