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
            <input type="text" class="form-control {{ $errors->first('title') ? "is-invalid" : "" }}" name="title" id="title" placeholder="Title Book" value="{{ old('title') }}">
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="cover">Cover</label><br>
            <input type="file" name="cover" id="cover" class="form-control {{ $errors->first('cover') ? "is-invalid" : "" }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control {{ $errors->first('description') ? "is-invalid" : "" }}" name="description" id="description" placeholder="Give a description about this book">{{ old('description') }}</textarea>
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="categories[]" multiple id="categories-select2" class="form-control {{ $errors->first('categories') ? "is-invalid" : "" }}"></select>
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" class="form-control {{ $errors->first('stock') ? "is-invalid" : "" }}" name="stock" id="stock" min="0" value="0">
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control {{ $errors->first('author') ? "is-invalid" : "" }}" name="author" id="author" placeholder="Book Author" value="{{ old('author') }}">
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" class="form-control {{ $errors->first('publisher') ? "is-invalid" : "" }}" name="publisher" id="publisher" placeholder="Book Publisher" value="{{ old('publisher') }}">
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control {{ $errors->first('price') ? "is-invalid" : "" }}" name="price" id="price" min="0" placeholder="Book Price" value="{{ old('price') }}">
            <div class="invalid-feddback">
                {{ $errors->first('title') }}
            </div>
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
