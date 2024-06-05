@extends('layouts.music-task')

@section('title', 'Music Task')

@section('styles')
    <link rel="icon" type="image/svg+xml" href="{{ asset('vite.svg') }}" />
    <link rel="stylesheet" crossorigin href="{{ asset('hangman-task/assets/index-jn6iSWk4.css') }}">
@endsection

@section('content')
    <div id="root"></div>
@endsection

@section('scripts')
    <script type="module" crossorigin src="{{ asset('hangman-task/assets/index-DJfugsSc.js') }}"></script>
@endsection
