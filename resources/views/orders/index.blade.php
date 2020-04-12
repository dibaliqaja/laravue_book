@extends('layouts.global')
@section('title_page','Data Orders')

@section('content')

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- <a href="{{ route('orders.create') }}" class="btn btn-primary">Add Books</a><br><br> --}}
    <form action="{{ route('orders.index') }}">
    <div class="row">
        <div class="col-md-5">
            <input type="text" class="form-control" name="buyer_email" id="buyer_email" value="{{ Request::get('buyer_email') }}" placeholder="Search by buyer email">
        </div>
        <div class="col-md-2">
            <select name="status" id="status" class="form-control">
                <option value="">ANY</option>
                <option {{ Request::get('status') == "SUBMIT" ? "selected" : "" }} value="SUBMIT">SUBMIT</option>
                <option {{ Request::get('status') == "PROCESS" ? "selected" : "" }} value="PROCESS">PROCESS</option>
                <option {{ Request::get('status') == "FINISH" ? "selected" : "" }} value="FINISH">FINISH</option>
                <option {{ Request::get('status') == "CANCEL" ? "selected" : "" }} value="CANCEL">CANCEL</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
    </form>
    <br>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Invoice number</th>
                <th><b>Status<b></th>
                <th><b>Buyer<b></th>
                <th><b>Total quantity<b></th>
                <th><b>Order date<b></th>
                <th><b>Total price<b></th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->invoice_number }}</td>
                    <td>
                        @if ($order->status == "SUBMIT")
                            <span class="badge badge-warning">{{ $order->status }}</span>
                        @elseif ($order->status == "PROCESS")
                            <span class="badge badge-info">{{ $order->status }}</span>
                        @elseif ($order->status == "FINISH")
                            <span class="badge badge-success">{{ $order->status }}</span>
                        @elseif ($order->status == "CANCEL")
                            <span class="badge badge-dark">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td>{{ $order->user->name }}<br><small>{{ $order->user->email }}</small></td>
                    <td>{{ $order->totalQuantity }} pc (s)</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('orders.edit', [$order->id]) }}">Edit</a>
                        {{-- <a class="btn btn-warning btn-sm" href="{{ route('books.show', [$book->id]) }}">Show</a>
                        <form action="{{ route('books.destroy', [$book->id]) }}" method="post" onsubmit="return confirm('Move book to trash?')" class="d-inline">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    {{ $orders->appends(Request::all())->links() }}
                </td>
            </tr>
        </tfoot>
    </table>

@endsection
