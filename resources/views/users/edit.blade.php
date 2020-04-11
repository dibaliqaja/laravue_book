@extends('layouts.global')
@section('title_page','Edit User')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('users.update', [$user->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
        </div>
        <div class="form-group">
            <label class="d-block">Roles</label>
            <div class="form-check">
                <input {{ in_array("ADMIN", json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" name="roles[]" type="checkbox" id="ADMIN" value="ADMIN">
                <label class="form-check-label" for="ADMIN">
                    Administrator
                </label>
            </div>
            <div class="form-check">
                <input {{ in_array("STAFF", json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" name="roles[]" type="checkbox" id="STAFF" value="STAFF">
                <label class="form-check-label" for="STAFF">
                    Staff
                </label>
            </div>
            <div class="form-check">
                <input {{ in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : "" }} class="form-check-input" name="roles[]" type="checkbox" id="CUSTOMER" value="CUSTOMER">
                <label class="form-check-label" for="CUSTOMER">
                    Customer
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone }}">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" id="address">{{ $user->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label><br>
            <input type="file" name="avatar" id="avatar"><br>
            <small class="text-muted">Note: Kosongkan jika tidak ingin mengubah avatar</small>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Password Confirmation">
        </div>
        <div class="form-group">
            <label class="d-block">Status</label>
            <div class="form-check">
            <input {{ $user->status == "ACTIVE" ? "checked" : "" }} class="form-check-input" type="radio" name="status" id="ACTIVE" value="ACTIVE">
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>
            <div class="form-group">
            <div class="form-check">
                <input {{ $user->status == "INACTIVE" ? "checked" : "" }} class="form-check-input" type="radio" name="status" id="INACTIVE" value="INACTIVE">
                <label class="form-check-label" for="status">
                    Inactive
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Update User">
        </div>
    </form>

@endsection
