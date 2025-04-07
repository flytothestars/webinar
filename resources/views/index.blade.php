@extends('layouts.app')

@section('content')
    @livewire('stream', ['webinar_id' => $webinar_id])  {{-- Передаем webinar_id --}}
@endsection
