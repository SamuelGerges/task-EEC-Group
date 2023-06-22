@extends('site.index')
@section('content')
    <div class="container m-5 p-5">
        @include('site.inc.success')
        <div class="d-flex justify-content-between mb-3">
            <h2>Pharmacies</h2>
            <a href="{{ route('pharmacies.create')}}" class="btn btn-sm btn-primary">Add New Pharmacy</a>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <form method="get" action="{{ route('pharmacies.index') }}">
                <input
                    type="search"
                    style="padding: 3px;margin: 5px"
                    class="form-control"
                    placeholder="Find pharmacy here"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                >
                <button id="search-button" type="submit" class="btn btn-light"
                        style="padding: 5px;">
                    Search For a Pharmacy
                </button>
            </form>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name Pharmacy</th>
                <th scope="col">Address Pharmacy</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            @isset($pharmacies)
                @foreach($pharmacies as $key => $pharmacy)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$pharmacy->pharmacy_name}}</td>
                        <td>{{$pharmacy->pharmacy_address}}</td>
                        <td>
                            <a class="btn btn-light"
                               href="{{ route('pharmacies.showProductsByPharmacyId',$pharmacy->pharmacy_id) }}">
                                Show Products
                            </a>
                            <a class="btn btn-primary"
                               href="{{ route('pharmacy.add.product',$pharmacy->pharmacy_id) }}">
                                Add Products
                            </a>
                            <a class="btn btn-light" href="{{ route('pharmacies.edit',$pharmacy->pharmacy_id) }}">Edit</a>
                            <a class="btn btn-danger" href="{{ route('pharmacies.delete',$pharmacy->pharmacy_id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
        {!! $pharmacies->render() !!}
    </div>
@endsection
