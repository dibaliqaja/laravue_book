@extends('layouts.app')

@section('content')

<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>401</h1>
                    <div class="page-description">
                        {{ $exception->getMessage() }}
                    </div>
                    <div class="page-search">
                        <div class="mt-3">
                            <a href="{{ url('/home') }}">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
