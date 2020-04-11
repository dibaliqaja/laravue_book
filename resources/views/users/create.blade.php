@extends('layouts.global')
@section('title_page','Create User')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label class="d-block">Roles</label>
            <div class="form-check">
                <input class="form-check-input" name="roles[]" type="checkbox" id="ADMIN" value="ADMIN">
                <label class="form-check-label" for="ADMIN">
                    Administrator
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="roles[]" type="checkbox" id="STAFF" value="STAFF">
                <label class="form-check-label" for="STAFF">
                    Staff
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="roles[]" type="checkbox" id="CUSTOMER" value="CUSTOMER">
                <label class="form-check-label" for="CUSTOMER">
                    Customer
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="08XXXXXXXXXX">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label><br>
            <input type="file" name="avatar" id="avatar">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="user@mail.com">
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
                <input class="form-check-input" type="radio" name="status" id="ACTIVE" value="ACTIVE" checked>
                <label class="form-check-label" for="status">
                    Active
                </label>
            </div>
            <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="INACTIVE" value="INACTIVE">
                <label class="form-check-label" for="status">
                    Inactive
                </label>
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Create User">
        </div>
    </form>
    
@endsection
