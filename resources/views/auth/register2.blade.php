@extends('layouts.app2')
@section('title')
    Register | Covid-19 Hospital
@endsection
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
    <section class="vh-100 login-section">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100 mt-5">
                <div class="col-md-9 col-lg-6 col-xl-5">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-5 offset-xl-1 bg-white py-3 rounded-6 box-shadow">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center">
                            <h3 class="fw-normal mb-5">Register</h3>

                        </div>
                        <!-- name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="name"
                                class="form-control form-control-lg {{ $errors->get('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ old('name') }}" />
                            <label class="form-label" for="name">Name</label>
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mb-2" autofocus />

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3"
                                class="form-control form-control-lg {{ $errors->get('email') ? 'is-invalid' : '' }}"
                                name="email" value="{{ old('email') }}" placeholder="Enter a valid email address" />
                            <label class="form-label" for="form3Example3">Email</label>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mb-2" />

                        <!-- phone_number input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3"
                                class="form-control form-control-lg {{ $errors->get('phone_number') ? 'is-invalid' : '' }}"
                                name="phone_number" value="{{ old('phone_number') }}" />
                            <label class="form-label" for="phone_number">Phone Number</label>
                        </div>
                        <x-input-error :messages="$errors->get('phone_number')" class="mb-2" />

                        <!-- NID_number input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3"
                                class="form-control form-control-lg {{ $errors->get('nid_number') ? 'is-invalid' : '' }}"
                                name="nid_number" value="{{ old('nid_number') }}" />
                            <label class="form-label" for="phone_number">NID/Birth Certificate Number</label>
                        </div>
                        <x-input-error :messages="$errors->get('nid_number')" class="mb-2" />

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4"
                                class="form-control form-control-lg {{ $errors->get('password') ? 'is-invalid' : '' }}"
                                name="password" placeholder="Enter password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mb-2" />

                        <!--Confirm Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="password_confirmation"
                                class="form-control form-control-lg {{ $errors->get('password_confirmation') ? 'is-invalid' : '' }}"
                                name="password_confirmation" placeholder="Enter password" />
                            <label class="form-label" for="password_confirmation">Confirm Password</label>

                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mb-2" autofocus />
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" name="hospital" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Register as a Hospital. (If you are a general user please leave it unchecked)
                                </label>
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have and Account? <a
                                    href="{{ route('login') }}" class="link-primary">Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
