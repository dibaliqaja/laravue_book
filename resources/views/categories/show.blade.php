@extends('layouts.global')
@section('title_page','Category Detailed')

@section('content')

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" width="200px" alt="image_category">
                @else
                    No Avatar
                @endif
                <br><br>
                <b>Name:</b>{{ $category->name }}<br><br>
                <b>Slug:</b>{{ $category->slug }}<br><br>
            </div>
        </div>
    </div>

@endsection
