@if ($errors->any())
    <div style="padding: 12px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 15px;">
        <strong>Пожалуйста, исправьте ошибки:</strong>
        <ul style="margin: 8px 0 0 20px; padding: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $book->exists ? route('books.update', $book) : route('books.store') }}" method="POST">
    @csrf
    @if ($book->exists)
        @method('PUT')
    @endif

    <div style="margin-bottom: 15px;">
        <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Название:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}"
               style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        @error('title')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="slug" style="display: block; margin-bottom: 5px; font-weight: bold;">Slug:</label>
        <input type="text" id="slug" name="slug" value="{{ old('slug', $book->slug) }}"
               style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        @error('slug')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="category_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Категория:</label>
        <select id="category_id" name="category_id"
                style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">— выберите —</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="authors" style="display: block; margin-bottom: 5px; font-weight: bold;">Авторы:</label>
        <select id="authors" name="authors[]" multiple size="5"
                style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', $book->authors->pluck('id')->all())))>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
        @error('authors')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="price" style="display: block; margin-bottom: 5px; font-weight: bold;">Цена:</label>
        <input type="number" step="0.01" min="0" id="price" name="price" value="{{ old('price', $book->price) }}"
               style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        @error('price')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="published_at" style="display: block; margin-bottom: 5px; font-weight: bold;">Дата публикации:</label>
        <input type="datetime-local" id="published_at" name="published_at"
               value="{{ old('published_at', $book->published_at?->format('Y-m-d\TH:i')) }}"
               style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        @error('published_at')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Описание:</label>
        <textarea id="description" name="description" rows="5"
                  style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">{{ old('description', $book->description) }}</textarea>
        @error('description')
            <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" style="padding: 10px 20px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;">
        Сохранить
    </button>
    <a href="{{ route('books.index') }}" style="margin-left: 10px;">Отмена</a>
</form>
