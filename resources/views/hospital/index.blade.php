@extends('layouts.app2')
@section('title')
    Hospitals | {{ config('app.name', 'Laravel') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class='d-flex flex-column align-items-center justify-content-center mt-3'>
        @if (count($hospitals) > 0)
            <h3 class="text-white" style="text-shadow: #000000 1px 0 10px;">{{ $title_text }}</h3>
        @else
            <h3 class="text-white text-center " style="text-shadow: #000000 1px 0 10px;">
                <p> Sorry, we could not find any hospitals for the given Entity.</p>
            </h3>
        @endif
        <hr style="width:40%;text-align:left;margin-left:0;height:5px; color:aliceblue;">
        @foreach ($hospitals as $hospital)
            <x-hospital-card :hospital="$hospital" />
        @endforeach
    </div>
@endsection
