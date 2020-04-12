@extends('layouts.global')
@section('title_page','Create Book')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title Book">
        </div>
        <div class="form-group">
            <label for="cover">Cover</label><br>
            <input type="file" name="cover" id="cover">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" placeholder="Give a description about this book"></textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="categories[]" multiple id="categories-select2" class="form-control"></select>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" min="0" value="0">
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="Book Author">
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Book Publisher">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" min="0" placeholder="Book Price">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="save_action" value="PUBLISH">Publish</button>
            <button type="submit" class="btn btn-light" name="save_action" value="DRAFT">Save as Draft</button>
        </div>
    </form>

@endsection

@section('footer-scripts')
    <script>
        $(document).ready(function() {
            $('#categories-select2').select2({
                ajax: {
                    url: '/ajax/categories/search',
                    processResults: function(data) {
                        return {
                            results: data.map(function(item){
                                return { id: item.id, text: item.name }
                            })
                        }
                    }
                }
            });
        });
    </script>
@endsection
