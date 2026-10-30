@extends('base')

@section('title', 'Permissie bewerken')

@section('content')

<h1>Permissie bewerken</h1>

<form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">      @csrf
    @method('PUT')

    <label>Naam</label>

    <input type="text"
           name="name"
           class="form-control"
           value="{{ $permission->name }}">

    <button class="btn btn-primary mt-3">
        Opslaan
    </button>
</form>

@endsection