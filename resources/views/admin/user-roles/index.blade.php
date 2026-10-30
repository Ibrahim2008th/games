
@extends('base')

@section('title', 'Rollen koppelen aan gebruikers')

@section('content')
<div class="container mt-4">

    <h1>Rollen koppelen aan gebruikers</h1>

    <a href="{{ route('admin.user-roles.create') }}"
       class="btn btn-success mb-3">
        Rol koppelen
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Gebruiker</th>
                <th>E-mail</th>
                <th>Rollen</th>
                <th>Acties</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @forelse($user->roles as $role)
                            <span class="badge bg-primary">
                                {{ $role->name }}
                            </span>
                        @empty
                            Geen rol
                        @endforelse
                    </td>

                    <td>
                        <a href="{{ route('admin.user-roles.edit', $user->id) }}"
                           class="btn btn-primary btn-sm">
                            Bewerken
                        </a>

                        @foreach($user->roles as $role)
                            <form action="{{ route('admin.user-roles.destroy', [$user->id, $role->id]) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Rol verwijderen?')">
                                    Verwijder {{ $role->name }}
                                </button>
                            </form>
                        @endforeach
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
