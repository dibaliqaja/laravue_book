@extends('layouts.global')
@section('title_page','Data Books')

@section('content')

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('books.create') }}" class="btn btn-primary">Add Books</a><br><br>

    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('books.index') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="keyword" id="keyword" value="{{ Request::get('keyword') }}" placeholder="Filter by title...">
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" value="Filter">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link {{ Request::get('status') == NULL && Request::path() == 'books' ? 'active' : '' }}">All</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index', ['status' => 'publish']) }}" class="nav-link {{ Request::get('status') == 'publish' ? 'active' : '' }}">Publish</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index', ['status' => 'draft']) }}" class="nav-link {{ Request::get('status') == 'draft' ? 'active' : '' }}">Draft</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.trash') }}" class="nav-link {{ Request::path() == 'books/trash' ? 'active' : '' }}">Trash</a>
                </li>
            </ul>
        </div>
    </div>
    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Categories</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>
                        @if ($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}" width="100px">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        @if ($book->status == "DRAFT")
                            <span class="badge badge-dark">{{ $book->status }}</span>
                        @else
                        <span class="badge badge-success">{{ $book->status }}</span>
                        @endif
                    </td>
                    <td>
                        @foreach ($book->categories as $category)
                            <h6><span class="badge badge-info">{{ $category->name }}</span></h6>
                        @endforeach
                    </td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ number_format($book->price, 2, ',', '.') }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('books.edit', [$book->id]) }}">Edit</a>
                        <form action="{{ route('books.destroy', [$book->id]) }}" method="post" onsubmit="return confirm('Move book to trash?')" class="d-inline">
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
                    {{ $books->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
