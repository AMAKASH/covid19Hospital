@extends('layouts.app2')
@section('title')
    Search Results | {{ config('app.name', 'Laravel') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class='d-flex align-items-center justify-content-center mt-3'>
        <x-search-bar-relative right="29%" top="10%" :search_value="$search_value" :areas="$areas" />
    </div>
    <div class='d-flex flex-column align-items-center justify-content-center mt-3'>
        @if ($hospitals)
            <h3 class="text-white" style="text-shadow: #000000 1px 0 10px;">Search Results:</h3>
        @else
            <h3 class="text-white text-center" style="text-shadow: #000000 1px 0 10px;">
                <p> Sorry we could not find any hospitals in your Area.<br> Please search for a different area ...</p>
            </h3>
        @endif

        @foreach ($hospitals as $hospital)
            <x-hospital-card :hospital="$hospital" />
        @endforeach
    </div>
@endsection
