<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование статьи</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    @include('components.header')

    <main>
        <section class="edit-section">
            <h1>Редактирование статьи</h1>

            @if ($errors->any())
                <div class="alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('article.update', $text->id) }}" method="POST" class="edit-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Заголовок статьи:</label>
                    <input type="text" name="title" placeholder="Введите заголовок..." 
                           value="{{ old('title', $text->title) }}" required>
                </div>

                <div class="form-group">
                    <label>Категория:</label>
                    <select name="category_id" required>
                        <option value="">Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ old('category_id', $text->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Текст статьи:</label>
                    <textarea name="content" rows="8" placeholder="Введите текст статьи..." 
                              required>{{ old('content', $text->content) }}</textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-blue">Сохранить изменения</button>
                    <a href="/journalist" class="btn btn-yellow">Отмена</a>
                </div>
            </form>
        </section>
    </main>

    @include('components.footer')

</body>
</html>
