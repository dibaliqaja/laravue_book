@extends('layouts.global')
@section('title_page', 'Create Category')

@section('content')

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Category Name" value="{{ old('name') }}">
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    </div>
    <div class="form-group">
        <label for="avatar">Category Image</label><br>
        <input type="file" name="image" id="image">
        <div class="invalid-feedback">
            {{ $errors->first('image') }}
        </div>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Create Category">
    </div>
    </form>

@endsection
