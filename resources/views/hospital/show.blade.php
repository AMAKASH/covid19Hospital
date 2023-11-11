@extends('layouts.app2')
@section('title')
    {{ $hospital->name }} | Covid-19 Hospital
@endsection
@section('content')
    <div class='d-flex flex-column align-items-center justify-content-center mt-2'>
        <div class="card mb-2" style="width: 40%;">
            <div class="card-body">
                <a href="{{ route('hospital.show', $hospital->id) }}" class="text-decoration-none">
                    <h3 class="card-title text-center">{{ $hospital->name ?? 'Hospital Name' }} </h3>
                </a>
                <h6 class="card-subtitle mb-4 text-muted text-center">{{ Str::ucfirst($hospital->area->area_name) }}</h6>

                <div class='d-flex gap-5'>
                    <div title='General Bed' class='icon icon-info d-flex flex-row align-items-center gap-2'>
                        <img src="{{ asset('images/icon/002-hospital-bed.png') }}" alt="" width="30px">
                        <span>{{ $hospital->general_bed }}</span>
                    </div>
                    <div title='ICU Bed' class='icon icon-info d-flex flex-row align-items-center gap-2'>
                        <img src="{{ asset('images/icon/003-health-insurance.png') }}" alt="" width="30px">
                        <span>{{ $hospital->icu_bed }}</span>
                    </div>
                    <div title='Oxygen Availibility' class='icon icon-info d-flex flex-row align-items-center gap-2'>
                        <img src="{{ asset('images/icon/004-oxygen.png') }}" alt="" width="30px">
                        <span>{{ $hospital->oxygen_suppply_availability }}</span>
                    </div>
                    <div title='Covid-19 Vaccine Availibility'
                        class='icon icon-info d-flex flex-row align-items-center gap-2'>
                        <img src="{{ asset('images/icon/001-vaccine.png') }}" alt="" width="30px">
                        <span>{{ $hospital->covid_vaccine_availability }}</span>
                    </div>
                    <div title='Ambulance Service' class='icon icon-info d-flex flex-row align-items-center gap-2'>
                        <img src="{{ asset('images/icon/ambulance.png') }}" alt="" width="30px">
                        @if ($hospital->ambulance == null)
                            <span>Not Available</span>
                        @else
                            <span>{{ $hospital->ambulance }}</span>
                        @endif
                    </div>
                </div>
                <div title='Address' class='icon icon-info my-3 d-flex flex-row align-items-center gap-3'>
                    <img src="{{ asset('images/icon/map.png') }}" alt="" width="30px">
                    <p class="card-text">{{ $hospital->address }}</p>
                </div>

                <div class="mt-4">
                    <a href="{{ route('test.create', $hospital->id) }}" class="card-link">Request a Test</a>
                    <a href="{{ route('appointment.create', $hospital->id) }}" class="card-link">Get Appointment</a>
                    @if (auth()->check() && auth()->user()->role_id == 3 && auth()->user()->registered_vac_hospital == $hospital->id)
                        <span class="card-subtitle mx-5">
                            Registered for Vaccination
                        </span>
                    @elseif (auth()->check() && auth()->user()->role_id == 3 && $hospital->covid_vaccine_availability == 'Yes')
                        <a href="{{ route('register_vaccine', $hospital->id) }}" class="card-link">Register for
                            Vaccination</a>
                    @elseif(!auth()->check() && $hospital->covid_vaccine_availability == 'Yes')
                        <span class="card-subtitle mx-3">
                            Login to Register For vaccination
                        </span>
                    @endif
                </div>

                <x-notices-table :entity="$hospital" />

                <h4 class="mt-5 mb-2 mx-1">List of Tests:</h4>
                @if (!$hospital->test_names)
                    <p class="text-center my-4">There are no test avaible in this hospital</p>
                @endif
                <ul class="list-group list-group-flush">
                    @foreach ($hospital->test_names()->orderBy('name')->get() as $test)
                        <li title="View Hospitals for this Test" class="list-group-item px-4">
                            <a href="{{ route('hospital.index') . '?test_name=' . $test->id }}"
                                class="text-decoration-none">
                                <h5>{{ $test->name }}</h5>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <h4 class="mt-5 mb-2 mx-1">List of Available Doctors:</h4>
                @if (!$hospital->doctors)
                    <p class="text-center my-4">There are no doctor avaible in this hospital</p>
                @endif
                <div class="mt-3">
                    @foreach ($hospital->doctors()->orderBy('name')->get() as $doctor)
                        <x-doctor-card :doctor="$doctor" width="80%" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
