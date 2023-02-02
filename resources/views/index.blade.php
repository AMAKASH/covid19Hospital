@extends('layouts.app2')

@section('styles')
    <style>
        .body-layout {
            width: 100%;
            min-height: 100vh;
            background-image: url(/images/bg.jpg);
            background-position: center;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <x-search-bar-component :areas="$areas" />
@endsection
