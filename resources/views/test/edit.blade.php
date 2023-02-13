@extends('layouts.app2')
@section('title')
    View Test Status | Covid-19 Hospital
@endsection
@section('content')
    <div class='container-fluid bg-white h-100 w-75 rounded-3 p-4 mt-2'>
        <h2 class="text-center pt-3 mb-3">View Test</h2>
        {{-- {{ $test }} --}}

        <h4 class="mt-5">Details</h4>
        <div class="px-3">
            <div class="d-flex flex-row ">
                <span class="col-md-6">
                    <strong class="me-3">Patient Name:</strong> {{ $test->patient_name }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Blood Group:</strong> {{ $test->blood_group }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Gender:</strong> {{ $test->gender }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Weight:</strong> {{ $test->weight }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Age:</strong> {{ $test->age() }}
                </span>
                <span class="col-md-6">
                    <strong class="me-3">Phone no:</strong> {{ $test->user->phone_number }}
                </span>
            </div>
        </div>
        <div>
            <h4 class="mt-5">Test Status</h4>
            <form action="{{ route('test.update', $test->id) }}" method="post" class="px-3"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="col-md-6">
                    <!-- status input -->
                    <select class="form-select mb-4 ms-2 {{ $errors->get('status') ? 'is-invalid' : '' }}"
                        aria-label=" Status" name="status">
                        <option value="{{ $test->status }}" selected>Status:
                            {{ $test->status }}</option>
                        <option value="Requested">Status: Requested</option>
                        <option value="Canceled">Status: Canceled</option>
                        <option value="Sample Collected">Status: Sample Collected</option>
                        <option value="Completed">Status: Completed</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mb-2" autofocus />
                </div>

                <div class="col-md-6">
                    <!-- name input -->
                    <div class="form-outline mb-4 ms-2">
                        <textarea cols="30" rows="3" id="comments"
                            class="form-control form-control-lg {{ $errors->get('comments') ? 'is-invalid' : '' }}" name="comments">{{ $test->comments }}</textarea>
                        <label class="form-label" for="comments">Comments</label>
                    </div>
                    <x-input-error :messages="$errors->get('comments')" class="mb-2" autofocus />
                </div>
                <div class="col-md-6">
                    <div class="mb-4 ms-2">
                        <label for="formFile" class="form-label">Report:</label>
                        <input class="form-control" type="file" accept="application/pdf" id="report" name="report">
                    </div>
                </div>
                <x-input-error :messages="$errors->get('report')" class="mb-2" autofocus />

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>


        </div>
    </div>
@endsection
