@extends('layouts.app2')
@section('title')
    View Appointment Status | Covid-19 Hospital
@endsection
@section('content')
    <div class='container-fluid bg-white h-100 w-75 rounded-3 p-4 mt-2'>
        <h2 class="text-center pt-3 mb-3">View Appointment</h2>
        {{-- {{ $appointment }} --}}

        <h4 class="mt-5">Details</h4>
        <div class="px-3">
            <div class="d-flex flex-row ">
                <span class="col-md-6">
                    <strong class="me-3">Patient Name:</strong> {{ $appointment->patient_name }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Blood Group:</strong> {{ $appointment->blood_group }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Gender:</strong> {{ $appointment->gender }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Weight:</strong> {{ $appointment->weight }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Age:</strong> {{ $appointment->age() }}
                </span>
                <span class="col-md-6">
                    <strong class="me-3">Phone no:</strong> {{ $appointment->user->phone_number }}
                </span>
            </div>
        </div>
        <div>
            <h4 class="mt-5">Appointment Status</h4>
            <form action="{{ route('appointment.update', $appointment->id) }}" method="post" class="px-3">
                @csrf
                @method('PATCH')

                <div class="col-md-6">
                    <!-- status input -->
                    <select class="form-select mb-4 ms-2 {{ $errors->get('status') ? 'is-invalid' : '' }}"
                        aria-label=" Status" name="status">
                        <option value="{{ $appointment->status }}" selected>Status:
                            {{ $appointment->status }}</option>
                        <option value="Requested">Status: Requested</option>
                        <option value="Canceled">Status: Canceled</option>
                        <option value="Confirmed">Status: Confirmed</option>
                        <option value="Missed">Status: Missed</option>
                        <option value="Completed">Status: Completed</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mb-2" autofocus />
                </div>

                <div class="col-md-6">
                    <!-- name input -->
                    <div class="form-outline mb-4 ms-2">
                        <textarea cols="30" rows="3" id="comments"
                            class="form-control form-control-lg {{ $errors->get('comments') ? 'is-invalid' : '' }}" name="comments">{{ $appointment->comments }}</textarea>
                        <label class="form-label" for="comments">Comments</label>
                    </div>
                    <x-input-error :messages="$errors->get('comments')" class="mb-2" autofocus />
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>


        </div>
    </div>
@endsection
