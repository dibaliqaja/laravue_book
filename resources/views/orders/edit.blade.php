@extends('layouts.global')
@section('title_page', 'Edit Order')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('orders.update', [$order->id]) }}" method="post">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <div class="form-group">
            <label for="invoice_number">Invoice number</label>
            <input type="text" class="form-control" value="{{ $order->invoice_number }}" disabled>
        </div>
        <div class="form-group">
            <label for="buyer">Buyer</label>
            <input type="text" class="form-control" value="{{ $order->user->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="created_at">Order date</label>
            <input type="text" class="form-control" value="{{ $order->created_at }}" disabled>
        </div>
        <div class="form-group">
            <label for="">Books ({{ $order->totalQuantity }})</label>
            <ul>
                @foreach ($order->books as $book)
                    <li>{{ $order->title }} <b>({{ $book->pivot->quantity }})</b></li>
                @endforeach
            </ul>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option {{ $order->status == "SUBMIT" ? "selected" : "" }} value="SUBMIT">SUBMIT</option>
                <option {{ $order->status == "PROCESS" ? "selected" : "" }} value="PROCESS">PROCESS</option>
                <option {{ $order->status == "FINISH" ? "selected" : "" }} value="FINISH">FINISH</option>
                <option {{ $order->status == "CANCEL" ? "selected" : "" }} value="CANCEL">CANCEL</option>
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Update Order">
        </div>
    </form>

@endsection

