@extends('layouts.global')
@section('title_page','Data Users')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a><br><br>

    <form action="{{ route('users.index') }}">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}" placeholder="Input Email for filter...">
            </div>
            <div class="col-md-2">
                <input type="radio" name="status" id="active" value="ACTIVE" {{ Request::get('status') == 'ACTIVE' ? 'checked' : ''}}>
                <label for="active">Active</label><br>
                <input type="radio" name="status" id="inactive" value="INACTIVE" {{ Request::get('status') == 'INACTIVE' ? 'checked' : ''}}>
                <label for="active">Inactive</label>
            </div>
            <div>
                <input type="submit" value="Filter" class="btn btn-primary">
            </div>
        </div>
    </form>
    <br>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Avatar</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" width="100px">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($user->status == "ACTIVE")
                            <span class="badge badge-success">
                                {{ $user->status }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                {{ $user->status }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('users.edit', [$user->id]) }}">Edit</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('users.show', [$user->id]) }}">Show</a>
                        <form action="{{ route('users.destroy', [$user->id]) }}" method="post" onsubmit="return confirm('Delete this user permanently?')" class="d-inline">
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
                    {{ $users->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
