
@extends('base')

@section('title', 'Rollen beheren')

@section('content')
<div class="container mt-4">

    <h1>Rollen beheren</h1>

    <a href="{{ route('admin.roles.create') }}"
       class="btn btn-success mb-3">
        Rol toevoegen
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <th>Acties</th>
            </tr>
        </thead>

        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                           class="btn btn-primary btn-sm">
                            Bewerken
                        </a>

                        @if(!in_array($role->name, ['admin', 'klant']))
                            <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Weet je het zeker?')">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">
                                    Verwijderen
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.index') }}"
       class="btn btn-secondary">
        Terug naar admin
    </a>

</div>
@endsection
