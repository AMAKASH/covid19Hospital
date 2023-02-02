@extends('layouts.app2')
@section('title')
    Tests | {{ config('app.name', 'Laravel') }}
@endsection
@section('styles')
@endsection
@section('content')
    <div class='d-flex flex-column align-items-center justify-content-center mt-3'>
        <h3 class="d-flex align-items-start text-white" style="text-shadow: #000000 1px 0 10px;">List of All Tests:</h3>
        <hr style="width:40%;text-align:left;margin-left:0;height:5px; color:aliceblue;">
        <div class="bg-light rounded-2" style="width:40%;">
            <ul class="list-group">
                @foreach ($test_names as $test)
                    <li title="View Hospitals for this Test" class="list-group-item px-4">
                        <a href="{{ route('hospital.index') . '?test_name=' . $test->id }}" class="text-decoration-none">
                            <h5>{{ $test->name }}</h5>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
