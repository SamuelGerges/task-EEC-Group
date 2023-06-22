@extends('site.index')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Product / Edit / {{ $productObj->product_title }}  </h6>
            <a href="{{ route('products.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')
        <form method="POST" action="{{route('products.update',$productObj->product_id)}}">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productObj->product_id }}">
            <div class="form-group">
                <label for="product_title">Product Title</label>
                <input type="text" name="product_title" class="form-control" value="{{ $productObj->product_title }}">
            </div>
            <div class="form-group">
                <label for="product_desc">Product Description</label>
                <input name="product_desc" class="form-control"  {{ $productObj->product_desc }}>
            </div>
            <div class="form-group">

                <div>
                    <img src="{{ $productObj->product_image }}" alt="" style="width: 200px;height: 100px">
                </div>
                <label for="product_image">Product Image</label>
                <input type="file" name="product_image" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
