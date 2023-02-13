@extends('layouts.app2')
@section('title')
    Login | Covid-19 Hospital
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
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 bg-white py-3 rounded-6 box-shadow">
                    <form method="POST" action="{{ route('login') }} ">
                        @csrf
                        <div class="text-center">
                            <h3 class="fw-normal mb-5">Sign in</h3>

                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3"
                                class="form-control form-control-lg {{ $errors->any() ? 'is-invalid' : '' }}" name="email"
                                value="{{ old('email') }}" />
                            <label class="form-label" for="form3Example3">Email</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4"
                                class="form-control form-control-lg {{ $errors->any() ? 'is-invalid' : '' }}"
                                name="password" />
                            <label class="form-label" for="form3Example4">Password</label>
                        </div>
                        @if ($errors->any())
                            <div class="text-danger  mb-2 ">
                                Email or Password is Incorrect.
                            </div>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" name="remember" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div>
                            <a href="#!" class="text-body me-1">Forgot password?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    class="link-primary">Register</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection
