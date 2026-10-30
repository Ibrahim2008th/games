@extends('base')

@section('title', 'Permissies beheren')

@section('content')

<h1>Permissies beheren</h1>

<a href="{{ route('admin.permissions.create') }}"
   class="btn btn-success mb-3">
    Permissie toevoegen
</a>

@foreach($permissions as $permission)
    <div class="d-flex align-items-center gap-2 mb-3">

        <span>{{ $permission->id }} - {{ $permission->name }}</span>

        <a href="{{ route('admin.permissions.edit', $permission->id) }}"
           class="btn btn-primary btn-sm">
            Bewerken
        </a>

        <form action="{{ route('admin.permissions.destroy', $permission->id) }}"
              method="POST"
              onsubmit="return confirm('Weet je het zeker?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
                Verwijderen
            </button>
        </form>

    </div>
@endforeach

