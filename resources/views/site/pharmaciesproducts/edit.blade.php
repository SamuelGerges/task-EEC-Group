@extends('site.index')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Pharmacy / Edit  Product</h6>
            <a href="{{ route('pharmacies.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')
        <form method="POST" action="{{ route('pharmacy.updateForProduct',$product->id) }}">
            @csrf
            <div class="form-group">
                <lable>Product Price</lable>
                <input type="number" step="any" name="product_price" class="form-control" value="{{$product->product_price}}">
            </div>
            <div class="form-group">
                <lable>Product Quantity</lable>
                <input type="number" name="product_quantity" class="form-control" value="{{$product->product_quantity}}">
            </div>
            <button type="submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
