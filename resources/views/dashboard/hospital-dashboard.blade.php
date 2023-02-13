@extends('layouts.app2')
@section('title')
    Dashboard | Covid-19 Hospital
@endsection
@section('styles')
    <style>
        .fixed-height {
            height: 150px;
        }
    </style>
@endsection
@section('content')
    <div class='container-fluid bg-white h-100 w-75 rounded-3 p-4'>
        <h2 class="text-center pt-3 mb-3">Hospital Dashboard</h2>
        <h6 class="">Welcome <strong>{{ $user->name }}</strong>, to your dashboard. You can use this dashboard to
            monitor tests, appointments updates and also update service status(Contact admin tp update other informations).
        </h6>
        @if (session('success-msg'))
            <div class="alert alert-success col-md-8 mb-3 " role="alert">
                {{ session('success-msg') }}
            </div>
        @endif

        @if ($not_verified)
            <div class="alert alert-warning col-md-8 mb-3 " role="alert">
                {{-- {{ $not_verified }} <br> --}}
                <span>
                    This hopsital is submitted to the <strong>Administrators for Verification</strong>. <br>
                    Your Hospital will <strong>not </strong>be visible publicly until verified.
                </span>
            </div>
        @endif

        <h4 class="mt-5">Hospital Information</h4>
        <div class="px-3">
            <div class="d-flex flex-row ">
                <span class="col-md-6">
                    <strong class="me-3">Hospital ID:</strong> {{ $user->username }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Name:</strong> {{ $user->name }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Email:</strong> {{ $user->email }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Phone Number:</strong> {{ $user->phone_number }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">License No:</strong> {{ $hospital->license_number }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Area:</strong> {{ $hospital->area->area_name }}
                </span>
            </div>
            <div class="d-flex flex-row mt-3">
                <span class="col-md-6">
                    <strong class="me-3">Address:</strong> {{ $hospital->address }}
                </span>

            </div>
            <a href="#" id='passwordUpdateButton' class="mt-3" onclick="showPasswordForm()">Update Password</a>
        </div>
        <div>
            <h4 class="mt-5">Services Status</h4>
            <form action="{{ route('hospital.update', $hospital->id) }}" method="post" class="px-3">
                @csrf
                @method('PATCH')
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <!-- name input -->
                        <div class="form-outline mb-4">
                            <input type="number" id="general_bed"
                                class="form-control form-control-lg {{ $errors->get('general_bed') ? 'is-invalid' : '' }}"
                                name="general_bed" value="{{ $hospital->general_bed }}" />
                            <label class="form-label" for="general_bed">General Bed</label>
                        </div>
                        <x-input-error :messages="$errors->get('general_bed')" class="mb-2" autofocus />
                    </div>

                    <div class="col-md-6">
                        <!-- email input -->
                        <div class="form-outline mb-4 ms-2">
                            <input type="number" id="icu_bed"
                                class="form-control form-control-lg {{ $errors->get('icu_bed') ? 'is-invalid' : '' }}"
                                name="icu_bed" value="{{ $hospital->icu_bed }}" />
                            <label class="form-label" for="icu_bed">ICU Bed</label>
                        </div>
                        <x-input-error :messages="$errors->get('icu_bed')" class="mb-2" autofocus />
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <!-- status input -->
                        <select
                            class="form-select mb-4 {{ $errors->get('oxygen_suppply_availability') ? 'is-invalid' : '' }}"
                            aria-label="Select Covid Vaccination Status" name="oxygen_suppply_availability"
                            id='oxygen_suppply_availability'>
                            <option value="" selected>Oxygen Supply Availability:
                                {{ $hospital->oxygen_suppply_availability }}</option>
                            <option value="Yes">Oxygen Supply Availability: Yes</option>
                            <option value="No">Oxygen Supply Availability: No</option>
                        </select>

                        <x-input-error :messages="$errors->get('oxygen_suppply_availability')" class="mb-2" autofocus />
                    </div>
                    <div class="col-md-6">
                        <!-- status input -->
                        <select
                            class="form-select mb-4 ms-2 {{ $errors->get('covid_vaccine_availability') ? 'is-invalid' : '' }}"
                            aria-label="Select Covid Vaccination Status" name="covid_vaccine_availability">
                            <option value="" selected>Covid Vaccine Availability:
                                {{ $hospital->covid_vaccine_availability }}</option>
                            <option value="Yes">Covid Vaccine Availability: Yes</option>
                            <option value="No">Covid Vaccine Availability: No</option>
                        </select>
                        <x-input-error :messages="$errors->get('covid_vaccine_availability')" class="mb-2" autofocus />
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>


        </div>
        <div class='{{ $errors->get('password') ? '' : 'd-none ' }}' id='passwordUpdateForm'>
            <h4 class="mt-5">Update Password</h4>
            <form action="{{ route('user.update.password') }}" method="post" class="px-3">
                @csrf
                @method('PATCH')
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <input type="password" id="password"
                                class="form-control form-control-lg {{ $errors->get('password') ? 'is-invalid' : '' }}"
                                name="password" value="{{ old('password') }}" />
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mb-2" autofocus />
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline mb-3 ms-2">
                            <input type="password" id="password_confirmation"
                                class="form-control form-control-lg {{ $errors->get('password_confirmation') ? 'is-invalid' : '' }}"
                                name="password_confirmation" placeholder="Enter password" />
                            <label class="form-label" for="password_confirmation">Confirm Password</label>

                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mb-2" autofocus />
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>


        </div>


        <div>
            <form action="{{ route('hospital.update_test_doctor', $hospital->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="d-flex flex-row justify-content-center">
                    <div class="col-md-4">
                        <h4 class="mt-5">Test Names:</h4>
                        <div class='mx-3 fixed-height overflow-auto border border-secondary rounded-2 p-2'>
                            @foreach ($test_names as $names)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $names->id }}"
                                        id="{{ 'check_' . $names->id }}" name='test_names[]'
                                        {{ $names->checked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ 'check_' . $names->id }}">
                                        {{ $names->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8 ms-2">
                        <h4 class="mt-5">Doctors:</h4>
                        <div class='mx-3 fixed-height overflow-auto border border-secondary rounded-2 p-2'>
                            @foreach ($doctors as $doctor)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $doctor->id }}"
                                        id="{{ 'check_' . $doctor->id }}" name='doctors[]'
                                        {{ $doctor->checked ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ 'check_' . $doctor->id }}">
                                        {{ $doctor->name }} [{{ $doctor->specialty }}]
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
        <x-test-table :entity="$hospital" show_view='true' />

        <x-appointment-table :entity="$hospital" show_view='true' />
    </div>
@endsection
@section('scripts')
    <script>
        function showPasswordForm() {
            button = document.getElementById('passwordUpdateButton');
            button.classList.add('d-none')
            button.classList.remove('mt-3')
            form = document.getElementById('passwordUpdateForm');
            form.classList.remove('d-none')
        }
    </script>
@endsection
