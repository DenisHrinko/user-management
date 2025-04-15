@extends('layouts.master')
@section('content')
    <h1>{{ isset($user) ? 'Edit User: ' . $user->name : 'Create New User' }}</h1>

    <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
        @csrf
        @isset($user) @method('PUT') @endisset

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name ?? '' }}" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label>Mail</label>
            <input type="email" name="email" value="{{ $user->email ?? '' }}" required @readonly(isset($user))>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" @if(isset($user)) placeholder="Leave blank to keep current password" @else required @endif>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div> <!-- Add relevant classes -->
            <label for="password_confirmation">Confirm Password</label>
            <input type="password"
                   id="password_confirmation" name="password_confirmation"
                   @if(!isset($user)) required @endif>
        </div>

        <div>
            <label>Teams</label>
            @foreach($teams as $team)
                <label>
                    <input type="checkbox" name="teams[]" value="{{ $team->id }}"
                    @isset($user) @checked($user->teams->contains($team)) @endisset>
                    {{ $team->name }}
                </label>
            @endforeach
            @error('teams')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit">Save</button>
    </form>
@endsection
