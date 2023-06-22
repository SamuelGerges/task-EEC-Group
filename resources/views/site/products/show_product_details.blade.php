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
                <th scope="col">Product Description</th>
            </tr>
            </thead>
            <tbody>
            @isset($product)
                    <tr>
                        <td>#</td>
                        <td><img style="width: 200px;height: 100px" src="{{ $product->product_image }}" alt=""></td>
                        <td>{{$product->product_title}}</td>
                        <td>{{$product->product_desc}}</td>
                    </tr>
            @endisset
            </tbody>
        </table>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pharmacy Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Image</th>
            </tr>
            </thead>
            <tbody>
            @isset($productDetails)
                @foreach($productDetails as $key=>$product)
                    <tr>
                        <td>{{$key + 1 }}</td>
                        <td>{{$product->pharmacy_name}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>{{$product->product_price}}</td>

                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
        {!! $productDetails->render() !!}
    </div>
@endsection
