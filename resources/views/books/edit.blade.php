@extends('layouts.app')

@section('title', 'Редактирование книги')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <h2>Редактирование книги</h2>

        @include('books._form')
    </div>
@endsection
