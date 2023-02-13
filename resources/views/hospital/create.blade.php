@extends('layouts.app2')
@section('title')
    Hospital Registration | Covid-19 Hospital
@endsection
@section('content')
    <div class='container-fluid bg-white h-100 w-75 rounded-3 p-4'>
        <h2 class="text-center pt-3 mb-3">Hospital Dashboard</h2>
        <h6 class="">Welcome <strong>{{ $user->name }}</strong>, to your dashboard. To complete creation of your
            'Hospital Account'. Please fillup the below form.
        </h6>
        <form action="{{ route('hospital.store', $user->id) }}" method="post" class="px-3">
            @csrf
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
                    <div class="col-md-6">
                        <!-- license_number input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="license_number"
                                class="form-control form-control-lg {{ $errors->get('license_number') ? 'is-invalid' : '' }}"
                                name="license_number" value="{{ old('license_number') }}" />
                            <label class="form-label" for="license_number">License Number</label>
                        </div>
                        <x-input-error :messages="$errors->get('license_number')" class="mb-2" autofocus />
                    </div>
                    <div class="col-md-6  ms-2">
                        <!-- area input -->
                        <select class="form-select" aria-label="Default select example" name='area_id' id='area'>
                            <option value='' selected>Select Area</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->area_name }} </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('area')" class="mb-2" autofocus />
                    </div>


                </div>
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <div class="form-outline mb-4">
                            <div class="form-outline mb-4">
                                <textarea cols="30" rows="3" id="address"
                                    class="form-control form-control-lg {{ $errors->get('address') ? 'is-invalid' : '' }}" name="address">{{ old('address') }}</textarea>
                                <label class="form-label" for="address">Address</label>
                            </div>
                            <x-input-error :messages="$errors->get('address')" class="mb-2" autofocus />
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="mt-5">Services Status</h4>

                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <!-- name input -->
                        <div class="form-outline mb-4">
                            <input type="number" id="general_bed"
                                class="form-control form-control-lg {{ $errors->get('general_bed') ? 'is-invalid' : '' }}"
                                name="general_bed" value="{{ old('general_bed') }}" />
                            <label class="form-label" for="general_bed">General Bed</label>
                        </div>
                        <x-input-error :messages="$errors->get('general_bed')" class="mb-2" autofocus />
                    </div>

                    <div class="col-md-6">
                        <!-- email input -->
                        <div class="form-outline mb-4 ms-2">
                            <input type="number" id="icu_bed"
                                class="form-control form-control-lg {{ $errors->get('icu_bed') ? 'is-invalid' : '' }}"
                                name="icu_bed" value="{{ old('icu_bed') }}" />
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
                            </option>
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
                            </option>
                            <option value="Yes">Covid Vaccine Availability: Yes</option>
                            <option value="No">Covid Vaccine Availability: No</option>
                        </select>
                        <x-input-error :messages="$errors->get('covid_vaccine_availability')" class="mb-2" autofocus />
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Complete Registration</button>
                </div>
        </form>


    </div>
    </div>
@endsection
