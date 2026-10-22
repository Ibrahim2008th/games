@extends('base')

@section('title', 'Permissie toevoegen')

@section('content')

<h1>Permissie toevoegen</h1>

<form action="{{ route('admin.permissions.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name">Naam van permissie</label>

        <input type="text"
               name="name"
               id="name"
               class="form-control"
               required>
    </div>

    <button type="submit" class="btn btn-success">
        Opslaan
    </button>

    <a href="{{ route('admin.permissions.index') }}"
       class="btn btn-secondary">
        Terug
    </a>

</form>

@endsection