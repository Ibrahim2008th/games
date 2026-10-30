
@extends('base')

@section('title', 'Permissie koppelen')

@section('content')
<div class="container mt-4">

    <h1>Permissie koppelen aan rol</h1>

    <form action="{{ route('admin.role-permissions.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">
            <label class="form-label">Kies een rol</label>

            <select name="role_id" class="form-control" required>
                <option value="">Selecteer rol</option>

                @foreach($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Kies een permissie</label>

            <select name="permission_id" class="form-control" required>
                <option value="">Selecteer permissie</option>

                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}">
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Koppelen
        </button>

        <a href="{{ route('admin.role-permissions.index') }}"
           class="btn btn-secondary">
            Annuleren
        </a>

    </form>

</div>
@endsection

