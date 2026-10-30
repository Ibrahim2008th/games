
@extends('base')

@section('title', 'Permissies koppelen aan rollen')

@section('content')
<div class="container mt-4">

    <h1>Permissies koppelen aan rollen</h1>

    <a href="{{ route('admin.role-permissions.create') }}"
       class="btn btn-success mb-3">
        Nieuwe koppeling
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Rol</th>
                <th>Permissie</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                @foreach($role->permissions as $permission)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <form action="{{ route('admin.role-permissions.destroy', [$role->id, $permission->id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Koppeling verwijderen?')">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.index') }}"
       class="btn btn-secondary">
        Terug naar admin
    </a>

</div>
@endsection
