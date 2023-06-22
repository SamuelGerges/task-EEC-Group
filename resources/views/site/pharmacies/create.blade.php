@extends('site.index')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Pharmacy / Add New</h6>
            <a href="{{ route('pharmacies.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')
        <form method="POST" action="{{ route('pharmacies.store') }}">
            @csrf
            <div class="form-group">
                <lable>Pharmacy Name</lable>
                <input type="text" name="pharmacy_name" class="form-control">
            </div>
            <div class="form-group">
                <lable>Pharmacy Address</lable>
                <input type="text" name="pharmacy_address" class="form-control">
            </div>
            <button type="submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
