@extends('base')

@section('title', '🎮 Show Game')

@section('content')

<div class="card">
    <div class="card-body">
        <p><strong>Game Name:</strong> {{ $game->game_name }}</p>
        <p><strong>Platform:</strong> {{ $game->platform }}</p>
        <p><strong>Genre:</strong> {{ $game->genre }}</p>
        <p><strong>Rating:</strong> {{ $game->rating }}/10</p>
    </div>
</div>

<a href="/games" class="btn btn-primary mt-3">Back to overview</a>

@endsection