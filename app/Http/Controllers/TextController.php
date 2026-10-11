<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::with(['author', 'category'])
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('index', compact('texts'));
    }

    public function showCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $texts = $category->texts()
            ->with('author')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('category', compact('category', 'texts'));
    }

    public function showJournalist()
    {
        $categories = Category::orderBy('name')->get();
        $userTexts = Auth::user()->texts()->orderBy('created_at', 'desc')->paginate(5);

        return view('journalist', compact('categories', 'userTexts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|min:10',
        ], [
            'title.required' => 'Заголовок обязателен',
            'category_id.required' => 'Выберите категорию',
            'category_id.exists' => 'Выбранная категория не существует',
            'content.required' => 'Текст статьи обязателен',
            'content.min' => 'Текст должен быть не менее 10 символов',
        ]);

        $slug = Str::slug($validated['title']);
        $counter = 1;
        while (Text::where('slug', $slug)->exists()) {
            $slug = Str::slug($validated['title']) . '-' . $counter;
            $counter++;
        }

        $text = Text::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'published_at' => now(),
        ]);

        return redirect('/journalist')->with('success', 'Статья успешно опубликована!');
    }

    public function show($slug)
    {
        $text = Text::where('slug', $slug)
            ->whereNotNull('published_at')
            ->with(['author', 'category'])
            ->firstOrFail();

        return view('article.show', compact('text'));
    }

    public function edit($id)
    {
        $text = Text::findOrFail($id);

        if (Auth::id() !== $text->user_id) {
            return redirect('/journalist')->with('error', 'Вы не можете редактировать эту статью');
        }

        $categories = Category::orderBy('name')->get();
        return view('article.edit', compact('text', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $text = Text::findOrFail($id);

        if (Auth::id() !== $text->user_id) {
            return redirect('/journalist')->with('error', 'Вы не можете редактировать эту статью');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string|min:10',
        ]);

        $text->update($validated);

        return redirect('/journalist')->with('success', 'Статья успешно обновлена!');
    }

    public function destroy($id)
    {
        $text = Text::findOrFail($id);

        if (Auth::id() !== $text->user_id) {
            return redirect('/journalist')->with('error', 'Вы не можете удалить эту статью');
        }

        $text->delete();

        return redirect('/journalist')->with('success', 'Статья успешно удалена!');
    }
}
