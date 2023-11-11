@extends('layouts.app2')
@section('title')
    Dashboard | Covid-19 Hospital
@endsection
@section('content')
    <div class='container-fluid bg-white h-100 w-75 rounded-3 p-4 mt-2'>
        <h2 class="text-center pt-3 mb-3">User Dashboard</h2>
        <h6 class="">Welcome <strong>{{ $user->name }}</strong>, to your dashboard. You can use this dashboard to
            monitor tests, appointments updates and also update personal information.</h6>
        @if (session('success-msg'))
            <div class="alert alert-success col-md-6 mb-3 container-fluid" role="alert">
                {{ session('success-msg') }}
            </div>
        @endif

        <h4 class="mt-5">Personal Information</h4>
        <div class="px-3">
            <div class="d-flex flex-row ">
                <span class="col-md-6">
                    <strong class="me-3">User ID:</strong> {{ $user->username }}
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
                    <strong class="me-3">NID Number:</strong> {{ $user->nid_number }}
                </span>

                <span class="col-md-6">
                    <strong class="me-3">Covid Vaccination Status:</strong>
                    {{ $user->covid_vaccination_status ? 'Vaccinated' : 'Not Vaccinated' }}
                </span>
            </div>
            <a href="#" id='infoUpdateButton' class="mt-3" onclick="showUpdateForm()">Update Personal Info</a><br>
            <a href="#" id='passwordUpdateButton' class="mt-3" onclick="showPasswordForm()">Update Password</a>
        </div>
        <div class='{{ $errors->any() ? '' : 'd-none ' }}' id='infoUpdateForm'>
            <h4 class="mt-5">Update Personal Information</h4>
            <form action="{{ route('user.update') }}" method="post" class="px-3">
                <p>Please only Fill in the fields you want to update. (Leave other Fields blank)</p>
                @csrf
                @method('PATCH')
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <!-- name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="name"
                                class="form-control form-control-lg {{ $errors->get('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ old('name') }}" />
                            <label class="form-label" for="name">Name</label>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mb-2" autofocus />
                    </div>

                    <div class="col-md-6">
                        <!-- email input -->
                        <div class="form-outline mb-4 ms-2">
                            <input type="text" id="email"
                                class="form-control form-control-lg {{ $errors->get('email') ? 'is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" />
                            <label class="form-label" for="email">Email</label>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mb-2" autofocus />
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <!-- phone input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="phone_number"
                                class="form-control form-control-lg {{ $errors->get('phone_number') ? 'is-invalid' : '' }}"
                                name="phone_number" value="{{ old('phone_number') }}" />
                            <label class="form-label" for="phone_number">Phone Number</label>
                        </div>
                        <x-input-error :messages="$errors->get('phone_number')" class="mb-2" autofocus />
                    </div>

                    <div class="col-md-6">
                        <!-- status input -->
                        <select
                            class="form-select mb-4 ms-2 {{ $errors->get('covid_vaccination_status') ? 'is-invalid' : '' }}"
                            aria-label="Select Covid Vaccination Status" name="covid_vaccination_status">
                            <option value="" selected>Select Covid Vaccination Status</option>
                            <option value="1">Vaccinated</option>
                            <option value="0">Not Vaccinated</option>
                        </select>
                        <x-input-error :messages="$errors->get('covid_vaccination_status')" class="mb-2" autofocus />
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update Info</button>
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
        <h2 class="text-center pt-3 mb-3">Vaccination Info</h2>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Current Register Hospital</th>
                    <th scope="col">First Dose</th>
                    <th scope="col">Second Dose</th>
                    <th scope="col">Additinal Dose</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <td>{{ $user->registered_vac_hospital()->name }}</td>
                @if ($user->first_dose != '')
                    <td>{{ date('d-m-Y', strtotime($user->first_dose)) }}</td>
                @else
                    <td>Not Administered</td>
                @endif
                @if ($user->second_dose != '')
                    <td>{{ date('d-m-Y', strtotime($user->second_dose)) }}</td>
                @else
                    <td>Not Administered</td>
                @endif
                @if ($user->additional_dose != '')
                    <td>{{ date('d-m-Y', strtotime($user->additional_dose)) }}</td>
                @else
                    <td>Not Administered</td>
                @endif
                <td><button class="btn btn-danger" onclick="unregisterVac()"
                        @if ($user->registered_vac_hospital()->name == 'Not Registered') disabled @endif>Unregister</button>
                </td>
                </tr>
            </tbody>
        </table>

        <x-test-table :entity="$user" />

        <x-appointment-table :entity="$user" />
    </div>
@endsection
@section('scripts')
    <script>
        function unregisterVac() {
            window.location.href = "{{ route('unregister_vaccine') }}";
        }

        function showUpdateForm() {
            button = document.getElementById('infoUpdateButton');
            button.classList.add('d-none')
            button.classList.remove('mt-3')
            form = document.getElementById('infoUpdateForm');
            form.classList.remove('d-none')
        }

        function showPasswordForm() {
            button = document.getElementById('passwordUpdateButton');
            button.classList.add('d-none')
            button.classList.remove('mt-3')
            form = document.getElementById('passwordUpdateForm');
            form.classList.remove('d-none')
        }
    </script>
@endsection
