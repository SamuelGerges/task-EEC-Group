@extends('site.index')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Pharmacy / Add New Product</h6>
            <a href="{{ route('pharmacies.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')
        <form method="POST" action="{{ route('pharmacy.store.product', $id) }}">
            @csrf
            <div class="form-group">
                <lable>Product</lable>
                <select name="product_id" class="selectjs form-control">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group">
                <lable>Product Price</lable>
                <input type="number" step="any" name="product_price" class="form-control">
            </div>
            <div class="form-group">
                <lable>Product Quantity</lable>
                <input type="number" name="product_quantity" class="form-control">
            </div>
            <button type="submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js" integrity="sha512-jhV1NyiaGUuhKDn+6sd6nLLKNMUslj3hf7gDf3FcG1F2Fg1W7v6VO5Il1pxCKJeE4+X+/Ktuqx+v/HHpZJ2NOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {
            $('.selectjs').select2({
                placeholder: "Please choose the product",
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('search.products.select2') }}",
                    dataType: "json",
                    type: "GET",
                    delay: 250,
                    data: function (params) {
                        return {
                            product_name: params.term,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true,
                }
            })
        });
    </script>
@endsection
