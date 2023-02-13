@extends('layouts.app2')
@section('title')
    Get an Appointment | Covid-19 Hospital
@endsection
@section('styles')
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css'>

    <!-- Vanilla Datepicker CSS -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>
@endsection
@section('content')
    <div class='d-flex flex-column align-items-center justify-content-center mt-2'>
        <div class="card mb-2" style="width: 40%;">
            <div class="card-body">
                <a href="{{ route('hospital.show', $hospital->id) }}" class="text-decoration-none">
                    <h3 class="card-title text-center">{{ $hospital->name ?? 'Hospital Name' }} </h3>
                </a>
                <h6 class="card-subtitle mb-4 text-muted text-center">{{ Str::ucfirst('Make an appointment') }}</h6>

                <p>Please Fill-out The Relavent Information</p>
                <form action="{{ route('appointment.store') }}" method="post">
                    @csrf

                    <select class="form-select w-50 mb-4 {{ $errors->get('doctor_id') ? 'is-invalid' : '' }}"
                        aria-label="Select A Test" name="doctor_id">
                        <option value='' selected>Select Doctor</option>
                        @foreach ($hospital->doctors as $doctor)
                            <option value={{ $doctor->id }}>{{ $doctor->name . ' [' . $doctor->specialty . ']' }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('doctor_id')" class="mb-2" autofocus />
                    <x-patient-info />
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Make an Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Vanilla Datepicker JS -->
    <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
    <script>
        /* Bootstrap 5 JS included */
        /* vanillajs-datepicker 1.1.4 JS included */

        const getDatePickerTitle = elem => {
            // From the label or the aria-label
            const label = elem.nextElementSibling;
            let titleText = '';
            if (label && label.tagName === 'LABEL') {
                titleText = label.textContent;
            } else {
                titleText = elem.getAttribute('aria-label') || '';
            }
            return titleText;
        }

        const elems = document.getElementsByClassName('datepicker_input');
        for (const elem of elems) {
            console.log('Flag 1')
            const datepicker = new Datepicker(elem, {
                'format': 'yyyy-mm-dd',
                title: getDatePickerTitle(elem)
            });
        }
    </script>
@endsection
