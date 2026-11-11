@extends('layouts.app')

@section('title', 'Книги')

@section('content')
    <div style="max-width: 1000px; margin: 0 auto;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Книги</h2>
            <a href="{{ route('books.create') }}" style="padding: 8px 14px; background: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">
                Добавить книгу
            </a>
        </div>

        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin: 15px 0;">
                {{ session('success') }}
            </div>
        @endif

        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="background: #eee; text-align: left;">
                    <th style="padding: 8px;">Название</th>
                    <th>Категория</th>
                    <th>Авторы</th>
                    <th>Цена</th>
                    <th>Опубликована</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 8px;">
                            <a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                        </td>
                        <td>{{ $book->category->name }}</td>
                        <td>{{ $book->authors->pluck('name')->join(', ') ?: '—' }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->published_at?->format('d.m.Y') ?? '—' }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('books.edit', $book) }}">Изменить</a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;" onsubmit="return confirm('Удалить книгу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; color: #c00; cursor: pointer; padding: 0;">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 8px;">Книг пока нет.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
