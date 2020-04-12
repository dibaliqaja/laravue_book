@extends('layouts.global')
@section('title_page','Edit Book')

@section('content')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{ route('books.update', [$book->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $book->title }}">
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="cover">Cover</label><br>
            <input type="file" name="cover" id="cover">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description">{{ $book->description }}</textarea>
            <div class="invalid-feedback">
                {{ $errors->first('description') }}
            </div>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="categories[]" multiple id="categories-select2" class="form-control"></select>
            <div class="invalid-feedback">
                {{ $errors->first('categories') }}
            </div>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" min="0" value="{{ $book->stock }}">
            <div class="invalid-feedback">
                {{ $errors->first('stock') }}
            </div>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}">
            <div class="invalid-feedback">
                {{ $errors->first('author') }}
            </div>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control" name="publisher" id="publisher" value="{{ $book->publisher }}">
            <div class="invalid-feedback">
                {{ $errors->first('publisher') }}
            </div>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price" id="price" min="0" value="{{ $book->price }}">
            <div class="invalid-feedback">
                {{ $errors->first('price') }}
            </div>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>Publish</option>
                <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>Draft</option>
            </select>
            <div class="invalid-feedback">
                {{ $errors->first('status') }}
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Book</button>
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

            var categories = {!! $book->categories !!}
            categories.forEach(function (category) {
                var option = new Option(category.name, category.id, true, true);
                $('#categories-select2').append(option).trigger('change');
            });
        });
    </script>
@endsection
