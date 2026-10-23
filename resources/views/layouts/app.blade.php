<!-- Базовый карказ всей страницы -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Проект')</title>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; }
        main { padding: 20px; min-height: 60vh; }
    </style>
</head>
<body>

{{-- Подключаем хедер через вставку --}}
@include('partials.header')

{{-- Сюда будет подставляться контент конкретной страницы --}}
<main>
    @yield('content')
</main>

{{-- Подключаем футер через вставку --}}
@include('partials.footer')

</body>
</html>
