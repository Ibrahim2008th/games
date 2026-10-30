
@extends('base')

@section('title', 'Admin Beheeromgeving')

@section('content')

<div class="container mt-4">

    <h1>Admin Beheeromgeving</h1>

    <p>Welkom beheerder!</p>

    <div class="list-group">

        <!-- CRUD 1: Permissies beheren -->
        <a href="{{ route('admin.permissions.index') }}"
           class="list-group-item list-group-item-action">
            Permissies beheren
        </a>

        <!-- CRUD 2: Rollen beheren -->
        <a href="{{ route('admin.roles.index') }}"
           class="list-group-item list-group-item-action">
            Rollen beheren
        </a>

        <!-- CRUD 3: Permissies koppelen aan rollen -->
        <a href="{{ route('admin.role-permissions.index') }}"
           class="list-group-item list-group-item-action">
            Permissies koppelen aan rollen
        </a>

        <!-- CRUD 4: Rollen koppelen aan gebruikers -->
        <a href="{{ route('admin.user-roles.index') }}"
           class="list-group-item list-group-item-action">
            Rollen koppelen aan gebruikers
        </a>

    </div>

</div>

@endsection

