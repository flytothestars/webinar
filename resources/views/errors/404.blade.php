@extends('layouts.app')

@section('title', 'Страница не найдена')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-xl p-8 max-w-lg text-center">
        <h1 class="text-5xl font-bold text-red-600 mb-4">404</h1>
        <h2 class="text-2xl font-semibold mb-2">Страница не найдена</h2>
        <p class="text-gray-600 mb-6">
            Упс! Мы не можем найти страницу, которую вы ищете.
        </p>
        <a href="{{ url('/') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            На главную
        </a>
    </div>
</div>
@endsection
