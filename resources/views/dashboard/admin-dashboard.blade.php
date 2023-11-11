@extends('layouts.app2')
@section('title')
    Admin Dashboard | Covid-19 Hospital
@endsection
@section('styles')
@endsection
@section('content')
    <main class='container-fluid bg-white h-100 w-75 rounded-3 p-4'>
        <h2 class="text-center pt-3 mb-3">Admin Dashboard</h2>
        <h6 class="">Welcome <strong>{{ $user->name }}</strong>, to your dashboard. See vaccine status and Registered
            Hospital Below.
        </h6>

        @if (session('success-msg'))
            <div class="alert alert-success col-md-5 mb-3 " role="alert">
                {{ session('success-msg') }}
            </div>
        @endif

        <h4 class="mt-5">Registered Hospitals</h4>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">License No</th>
                    <th scope="col">Address</th>
                    <th scope="col">Area</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospitals as $hospital)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $hospital->name }}</td>
                        <td>{{ $hospital->license_number }}</td>
                        <td>{{ $hospital->address }}</td>
                        <td>{{ $hospital->area->area_name }}</td>
                        @if ($hospital->user->verified_at == null)
                            <td>Pending Approval</td>
                            <td><a href="{{ route('hospital.approve', $hospital->id) }}" class="btn btn-success">Approve</a>
                            </td>
                        @else
                            <td>Approved</td>
                            <td><a href="{{ route('hospital.reject', $hospital->id) }}" class="btn btn-danger">Reject</a>
                            </td>
                        @endif

                    </tr>
                @endforeach
                @if (count($hospitals) == 0)
                    <tr>
                        <td colspan='5'>
                            <h6 class="text-center">No Hospitals available</h6>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <h4 class="mt-5">Registered Patients Vaccination Status</h4>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Registered Hospital</th>
                    <th scope="col">First Dose</th>
                    <th scope="col">Second Dose</th>
                    <th scope="col">Additinal Dose</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->registered_vac_hospital()->name }}</td>
                        @if ($patient->first_dose != '')
                            <td>{{ date('d-m-Y', strtotime($patient->first_dose)) }}</td>
                        @else
                            <td>Not Administered</td>
                        @endif
                        @if ($patient->second_dose != '')
                            <td>{{ date('d-m-Y', strtotime($patient->second_dose)) }}</td>
                        @else
                            <td>Not Administered</td>
                        @endif
                        @if ($patient->additional_dose != '')
                            <td>{{ date('d-m-Y', strtotime($patient->additional_dose)) }}</td>
                        @else
                            <td>Not Administered</td>
                        @endif
                    </tr>
                @endforeach
                @if (count($patients) == 0)
                    <tr>
                        <td colspan='5'>
                            <h6 class="text-center">No Patients available</h6>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
@section('scripts')
@endsection
