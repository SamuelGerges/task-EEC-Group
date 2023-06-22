@extends('site.index')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h6>Pharmacy / Edit / {{$pharmacyObj->pharmacy_name}}</h6>
            <a href="{{ route('pharmacies.index')}}" class="btn btn-sm btn-primary">Back</a>
        </div>
        @include('site.inc.errors')
        <form method="POST" action="{{route('pharmacies.update',$pharmacyObj->pharmacy_id)}}">
            @csrf
            <input type="hidden" name="pharmacy_id" value="{{$pharmacyObj->pharmacy_id}}">
            <div class="form-group">
                <lable>Pharmacy Name</lable>
                <input type="text" name="pharmacy_name" class="form-control" value="{{ $pharmacyObj->pharmacy_name }}">
            </div>
            <div class="form-group">
                <lable>Pharmacy Address</lable>
                <input type="text" name="pharmacy_address" class="form-control" value="{{ $pharmacyObj->pharmacy_address }}">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
