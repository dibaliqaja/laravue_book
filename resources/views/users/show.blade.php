@extends('layouts.global')
@section('title_page','User Detailed')

@section('content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" width="200px" alt="image_user">
                @else
                    No Avatar
                @endif
                <br><br>
                <b>Name:</b>{{ $user->name }}<br><br>
                <b>Email:</b>{{ $user->email }}<br><br>
                <b>Username:</b>{{ $user->username }}<br><br>
                <b>Phone Number:</b>{{ $user->phone }}<br><br>
                <b>Address:</b>{{ $user->address }}<br><br>
                <b>Roles:</b>
                @foreach (json_decode($user->roles) as $role)
                    {{ $role }}
                @endforeach
            </div>
        </div>
    </div>

@endsection
