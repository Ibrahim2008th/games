@extends('base')

@section('title', 'Permissies beheren')

@section('content')

<h1>Permissies beheren</h1>

<a href="{{ route('admin.permissions.create') }}"
   class="btn btn-success mb-3">
    Permissie toevoegen
</a>

@foreach($permissions as $permission)
    <p>{{ $permission->id }} - {{ $permission->name }}</p>
@endforeach

@endsection