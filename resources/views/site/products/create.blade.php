@extends('site.index')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Product / Add New</h6>
            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" name="product_title" class="form-control" id="product_title">
            </div>
            <div class="form-group">
                <label for="product_desc">Product Description</label>
                <input name="product_desc" class="form-control" id="product_desc">
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" class="form-control" id="product_image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
