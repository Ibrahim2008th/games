
@extends('base')

@section('title', 'Rol koppelen')

@section('content')
<div class="container mt-4">

    <h1>Rol koppelen aan gebruiker</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.user-roles.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Gebruiker</label>

            <select name="user_id" class="form-control" required>
                <option value="">Kies een gebruiker</option>

                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        @selected(old('user_id') == $user->id)>
                        {{ $user->name }} - {{ $user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Rol</label>

            <select name="role_id" class="form-control" required>
                <option value="">Kies een rol</option>

                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id') == $role->id)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Koppelen
        </button>

        <a href="{{ route('admin.user-roles.index') }}"
           class="btn btn-secondary">
            Annuleren
        </a>

    </form>
</div>
@endsection
