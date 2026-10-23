@extends('layouts.app')

@section('title', 'Контакты и обратная связь')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Форма обратной связи</h2>

        {{-- Сообщение об успешной отправке из flash-сессии --}}
        @if(session('success'))
            <div style="padding: 12px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Общий блок ошибок валидации если они есть --}}
        @if ($errors->any())
            <div style="padding: 12px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px; margin-bottom: 20px;">
                <strong>Пожалуйста, исправьте следующие ошибки:</strong>
                <ul style="margin: 8px 0 0 20px; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Форма отправки --}}
        <form action="{{ route('contact.handle') }}" method="POST">
            {{-- Защита от CSRF-атак --}}
            @csrf

            {{-- Поле: Имя --}}
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Ваше имя:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                @error('name')
                <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Поле: Email --}}
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">E-mail адрес:</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}"
                       style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
                @error('email')
                <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Поле: Сообщение --}}
            <div style="margin-bottom: 15px;">
                <label for="message" style="display: block; margin-bottom: 5px; font-weight: bold;">Сообщение:</label>
                <textarea id="message" name="message" rows="5"
                          style="width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">{{ old('message') }}</textarea>
                @error('message')
                <div style="color: red; font-size: 0.85em; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Отправить данные
            </button>
        </form>
    </div>
@endsection
