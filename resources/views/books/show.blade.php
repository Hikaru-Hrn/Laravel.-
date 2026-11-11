@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div style="max-width: 700px; margin: 0 auto;">
        @if (session('success'))
            <div style="padding: 12px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif

        <h2>{{ $book->title }}</h2>

        <p><strong>Категория:</strong> {{ $book->category->name }}</p>
        <p><strong>Авторы:</strong> {{ $book->authors->pluck('name')->join(', ') ?: '—' }}</p>
        <p><strong>Цена:</strong> {{ $book->price }}</p>
        <p><strong>Дата публикации:</strong> {{ $book->published_at?->format('d.m.Y') ?? '—' }}</p>
        <p><strong>Описание:</strong><br>{{ $book->description ?? '—' }}</p>

        <h3>Отзывы ({{ $book->reviews->count() }})</h3>

        @forelse ($book->reviews as $review)
            <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 4px;">
                <strong>{{ $review->reviewer_name }}</strong> — {{ $review->rating }}/5
                <p style="margin-bottom: 0;">{{ $review->body }}</p>
            </div>
        @empty
            <p>Отзывов пока нет.</p>
        @endforelse

        <p style="margin-top: 20px;">
            <a href="{{ route('books.edit', $book) }}">Изменить</a> |
            <a href="{{ route('books.index') }}">← К списку книг</a>
        </p>
    </div>
@endsection
