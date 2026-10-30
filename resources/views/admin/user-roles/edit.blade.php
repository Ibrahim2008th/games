
@extends('base')

@section('title', 'Rol wijzigen')

@section('content')
<div class="container mt-4">

    <h1>Rol wijzigen</h1>

    <p>
        Gebruiker: <strong>{{ $user->name }}</strong>
    </p>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.user-roles.update', $user->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Kies nieuwe rol</label>

            <select name="role_id" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id', $user->roles->first()?->id) == $role->id)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Opslaan
        </button>

        <a href="{{ route('admin.user-roles.index') }}"
           class="btn btn-secondary">
            Annuleren
        </a>

    </form>
</div>
@endsection
