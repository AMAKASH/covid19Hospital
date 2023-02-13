@props(['doctor', 'width'])



<div class="card mb-2" style="width: {{ $width ?? '40%' }}">
    <div class="card-body">
        <div title='General Bed' class='icon icon-info d-flex flex-row align-items-center gap-2'>
            <img src="{{ asset('images/icon/doctor.png') }}" alt="" width="25px">
            <a href="{{ route('hospital.index') . '?doctor=' . $doctor->id }}" class="text-decoration-none">
                <h5 class="card-title">{{ $doctor->name ?? 'Hospital Name' }} </h5>
            </a>
        </div>
        <h6 title='Qualification' class="card-subtitle mb-2 mt-1 text-muted">{{ $doctor->qualification }}</h6>

        <div title='Specialty' class='icon icon-info mt-3 d-flex flex-row align-items-center gap-3'>
            <img src="{{ asset('images/icon/stethoscope.png') }}" alt="" width="30px">
            <h6 class="card-text" style="color:#b30a0a;">{{ $doctor->specialty }}</h6>
        </div>

    </div>
</div>
