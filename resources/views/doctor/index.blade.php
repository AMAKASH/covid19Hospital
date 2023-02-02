@extends('layouts.app2')
@section('title')
    Doctors | {{ config('app.name', 'Laravel') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class='d-flex flex-column align-items-center justify-content-center mt-3'>
        <h3 class="d-flex align-items-start text-white" style="text-shadow: #000000 1px 0 10px;">List of All Doctors:</h3>
        <hr style="width:40%;text-align:left;margin-left:0;height:5px; color:aliceblue;">
        @foreach ($doctors as $doctor)
            <x-doctor-card :doctor="$doctor" />
        @endforeach
    </div>
@endsection
