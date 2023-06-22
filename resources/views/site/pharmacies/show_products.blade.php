@extends('site.index')
@section('content')
    <div class="container m-5 p-5">
        @include('site.inc.success')
        <div class="d-flex justify-content-between mb-3">
            <h2>Products</h2>
            <a href="{{ route('pharmacies.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Title</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product quantity</th>
                <th scope="col">Operation</th>

            </tr>
            </thead>
            <tbody>
            @isset($products)
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td><img src="{{ $product->product_image }}" alt=""></td>
                        <td>{{$product->product_title}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('editProductInPharmacy',$product->id) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('pharmacy.deleteProductInPharmacy',$product->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
        {!! $products->render() !!}
    </div>
@endsection
