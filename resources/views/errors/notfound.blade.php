@extends('layouts.app')

@section('title', 'Не найдено')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-lg text-center">
        <h1 class="text-4xl font-bold text-red-500 mb-4">404</h1>
        <h2 class="text-2xl font-semibold mb-2">Запись не найдена</h2>
        <p class="text-gray-600 mb-6">
            Извините, мы не смогли найти такой вебинар или запись. Возможно, она была удалена или никогда не существовала.
        </p>
        <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Вернуться на главную
        </a>
    </div>
</div>
@endsection
