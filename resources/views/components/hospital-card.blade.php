@props(['hospital'])



<div class="card mb-2" style="width: 40%;">
    <div class="card-body">
        <a href="#" class="text-decoration-none">
            <h5 class="card-title">{{ $hospital->name ?? 'Hospital Name' }} </h5>
        </a>
        @if ($hospital->area_name)
            <h6 class="card-subtitle mb-2 text-muted">{{ Str::ucfirst($hospital->area_name) }}</h6>
        @elseif ($hospital->area)
            <h6 class="card-subtitle mb-2 text-muted">{{ Str::ucfirst($hospital->area->area_name) }}</h6>
        @else
            <h6 class="card-subtitle mb-2 text-muted">Area</h6>
        @endif

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
            <div title='Covid-19 Vaccine Availibility' class='icon icon-info d-flex flex-row align-items-center gap-2'>
                <img src="{{ asset('images/icon/001-vaccine.png') }}" alt="" width="30px">
                <span>{{ $hospital->covid_vaccine_availability }}</span>
            </div>
        </div>
        <div title='Address' class='icon icon-info my-3 d-flex flex-row align-items-center gap-3'>
            <img src="{{ asset('images/icon/map.png') }}" alt="" width="30px">
            <p class="card-text">{{ $hospital->address }}</p>
        </div>

        <a href="#" class="card-link">Request a Test</a>
        <a href="#" class="card-link">Get Appointment</a>
    </div>
</div>
