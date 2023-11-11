<div class="d-flex flex-row">
    <div class="col-md-6">
        <!-- name input -->
        <div class="form-outline mb-4">
            <input type="text" id="patient_name"
                class="form-control form-control-lg {{ $errors->get('patient_name') ? 'is-invalid' : '' }}"
                name="patient_name" value="{{ old('patient_name') }}" />
            <label class="form-label" for="patient_name">Patient Name</label>
        </div>
        <x-input-error :messages="$errors->get('patient_name')" class="mb-2" autofocus />
    </div>

    <div class="col-md-6">
        <!-- weight input -->
        <div class="form-outline mb-4 ms-2">
            <input type="text" id="weight"
                class="form-control form-control-lg {{ $errors->get('weight') ? 'is-invalid' : '' }}" name="weight"
                value="{{ old('weight') }}" />
            <label class="form-label" for="weight">Weight(kg) (Optional)</label>
        </div>
        <x-input-error :messages="$errors->get('weight')" class="mb-2" autofocus />
    </div>
</div>

<div class="d-flex flex-row">
    <div class="col-md-6">
        <select class="form-select mb-4" aria-label="Select Blood Group" name="blood_group">
            <option value="" selected>Select Blood Group (Optional)</option>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>
    </div>
    <div class="col-md-6 ms-2">
        <select class="form-select mb-4 {{ $errors->get('gender') ? 'is-invalid' : '' }}" aria-label="Select Gender"
            name="gender">
            <option value="" selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <x-input-error :messages="$errors->get('gender')" class="mb-2" autofocus />
    </div>

</div>
<div class="col-md-6">
    <div class="input-group mb-4">
        <i class="bi bi-calendar-date input-group-text"></i>
        <input type="text" class="datepicker_input form-control {{ $errors->get('dob') ? 'is-invalid' : '' }}"
            name='dob' placeholder="Enter Date of Birth (yyyy-mm-dd)" value="{{ old('dob') }}"
            aria-label="Date of Birth">
    </div>
    <x-input-error :messages="$errors->get('dob')" class="mb-2" autofocus />
</div>
