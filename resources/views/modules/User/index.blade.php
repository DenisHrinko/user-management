@extends('layouts.master')
@section('content')
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Mail</th>
            <th>Teams</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->teams->pluck('name')->join(', ') }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}">Edit</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('users.create') }}">New user</a>
@endsection
