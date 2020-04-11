@extends('layouts.global')
@section('title_page','Data Categories')

@section('content')

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a><br><br>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('categories.index') }}">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Input Name for filter..." value="{{ Request::get('keyword') }}">
                    <div class="input-group-append">
                        <input type="submit" value="Filter" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link">Published</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.trash') }}" class="nav-link active">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trash_category as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" width="100px">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('categories.restore', [$category->id]) }}">Restore</a>
                        <form action="{{ route('categories.delete-permanent', [$category->id]) }}" method="post" onsubmit="return confirm('Delete this category permanently?')" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    {{ $trash_category->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
