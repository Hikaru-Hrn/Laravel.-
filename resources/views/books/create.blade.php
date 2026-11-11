@extends('layouts.app')

@section('title', 'Новая книга')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <h2>Новая книга</h2>

        @include('books._form')
    </div>
@endsection
