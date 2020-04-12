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
            <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : ""}}" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
            <div class="invalid-feedback">
                {{ $errors->first('name') }}
            </div>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control {{ $errors->first('username') ? "is-invalid" : ""}}" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
            <div class="invalid-feedback">
                {{ $errors->first('username') }}
            </div>
        </div>
        <div class="form-group">
            <label class="d-block">Roles</label>
            <div class="form-check">
                <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : ""}}" name="roles[]" type="checkbox" id="ADMIN" value="ADMIN">
                <label class="form-check-label" for="ADMIN">
                    Administrator
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : ""}}" name="roles[]" type="checkbox" id="STAFF" value="STAFF">
                <label class="form-check-label" for="STAFF">
                    Staff
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : ""}}" name="roles[]" type="checkbox" id="CUSTOMER" value="CUSTOMER">
                <label class="form-check-label" for="CUSTOMER">
                    Customer
                </label>
            </div>
            <div class="invalid-feedback">
                {{ $errors->first('roles') }}
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control {{ $errors->first('phone') ? "is-invalid" : ""}}" name="phone" id="phone" placeholder="08XXXXXXXXXX" value="{{ old('phone') }}">
            <div class="invalid-feedback">
                {{ $errors->first('phone') }}
            </div>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control {{ $errors->first('address') ? "is-invalid" : ""}}" name="address" id="address" placeholder="Address">{{ old('address') }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('address') }}
            </div>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label><br>
            <input class="{{ $errors->first('avatar') ? "is-invalid" : ""}}" type="file" name="avatar" id="avatar">
            <div class="invalid-feedback">
                {{ $errors->first('avatar') }}
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control {{ $errors->first('email') ? "is-invalid" : ""}}" name="email" id="email" placeholder="user@mail.com" value="{{ old('email') }}">
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control {{ $errors->first('password') ? "is-invalid" : ""}}" name="password" id="password" placeholder="Password">
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control {{ $errors->first('password_confirmation') ? "is-invalid" : ""}}" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
            <div class="invalid-feedback">
                {{ $errors->first('password_confirmation') }}
            </div>
        </div>
        <div class="form-group">
            <label class="d-block">Status</label>
            <div class="form-check">
                <input class="form-check-input {{ $errors->first('status') ? "is-invalid" : ""}}" type="radio" name="status" id="ACTIVE" value="ACTIVE" checked>
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
            <div class="invalid-feedback">
                {{ $errors->first('status') }}
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Create User">
        </div>
    </form>

@endsection
