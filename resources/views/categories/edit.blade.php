@extends('layouts.global')
@section('title_page', 'Edit Category')

@section('content')

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('categories.update', [$category->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="PUT" name="_method">
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
    </div>
    <div class="form-group">
        <label for="avatar">Category Image</label><br>
        @if ($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" width="120px" alt="image_category"><br><br>
        @endif
        <input type="file" name="image" id="image"><br>
        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Category">
    </div>
    </form>

@endsection
