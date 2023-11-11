<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\TestName;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rules;

class BaseController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('area_name', 'ASC')->get();
        return view('index', [
            'areas' => $areas,
        ]);
    }

    /*
    / Function used for Testing and Development Purposes
    */
    public function dev()
    {
        $inputs = request()->all();
        $test_names = array_map('intval', $inputs['test_names']);
        $doctors = array_map('intval', $inputs['doctors']);
        return [$test_names, $doctors];
    }

    public function index_test_name()
    {
        $test_names = TestName::orderBy('name', 'ASC')->get();
        return view('test.index', [
            'test_names' => $test_names,
        ]);
    }
    public function index_doctor()
    {
        $doctors = Doctor::orderBy('name', 'ASC')->get();
        return view('doctor.index', [
            'doctors' => $doctors,
        ]);
    }

    public function render_dashboard()
    {
        $user = auth()->user();
        if ($user->role_id == 1) {
            return $this->admin_dashboard($user);
        } elseif ($user->role_id == 2) {
            return $this->hospital_dashboard($user);
        } else {
            return $this->user_dashboard($user);
        }
    }

    public function user_dashboard(User $user)
    {
        return view('dashboard.user-dashboard', [
            'user' => $user,
        ]);
    }
    public function hospital_dashboard(User $user)
    {
        $hospital = $user->hospital;
        $areas = Area::all();
        if (!$hospital) {
            return view('hospital.create', [
                'user' => $user,
                'areas' => $areas,
            ]);
        }
        $allDoctors = Doctor::orderBy('name')->get();
        $doctorIdInHospital = $hospital->doctors()->pluck('doctors.id')->toArray();
        foreach ($allDoctors as $doctor) {
            if (in_array($doctor->id, $doctorIdInHospital)) {
                $doctor->checked = true;
            }
        }

        $test_names = TestName::orderBy('name')->get();
        $testNameIdInHospital = $hospital->test_names()->pluck('test_names.id')->toArray();
        foreach ($test_names as $test_name) {
            if (in_array($test_name->id, $testNameIdInHospital)) {
                $test_name->checked = true;
            }
        }


        return view('dashboard.hospital-dashboard', [
            'user' => $user,
            'hospital' => $hospital,
            'not_verified' => $user->verified_at == null,
            'test_names' => $test_names,
            'doctors' => $allDoctors,
        ]);
    }
    public function admin_dashboard(User $user)
    {
        return view('dashboard.admin-dashboard', [
            'user' => $user,
            'patients' => User::where('role_id', 3)->get(),
            'hospitals' => Hospital::all()
        ]);
    }

    public function approve_hospital(Hospital $hospital)
    {
        $user = auth()->user();
        if ($user->role_id != 1) {
            return abort(403, "Access Restricted");
        }
        $hospital_user = $hospital->user;
        $hospital_user->verified_at = Carbon::now();
        $hospital_user->save();
        return back()->with('success-msg', "$hospital->name approved");
    }

    public function reject_hospital(Hospital $hospital)
    {
        $user = auth()->user();
        if ($user->role_id != 1) {
            return abort(403, "Access Restricted");
        }
        $hospital_user = $hospital->user;
        $hospital_user->verified_at = null;
        $hospital_user->save();
        return back()->with('success-msg', "$hospital->name rejected");
    }

    public function user_update()
    {
        $inputs = request()->validate([
            'email' => ['email', 'nullable'],
            'name' => ['string', 'min:5', 'nullable'],
            'phone_number' => ['nullable', 'digits:11', 'unique:' . User::class],
            'covid_vaccination_status' => ['nullable']
        ]);
        $inputs_filtered = array_filter($inputs, function ($v) {
            return $v != null;
        });


        // return  $inputs_filtered;

        $user = auth()->user();
        $user->update($inputs_filtered);
        return redirect()->route('dashboard')->with('success-msg', 'Informations updated successfully!!');
    }

    public function user_password_update()
    {
        $input = request()->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // return $input;
        $user = auth()->user();
        $user->password = bcrypt($input['password']);
        $user->save();
        return redirect()->route('dashboard')->with('success-msg', 'Password Updated successfully');
    }

    public function unreg_vaccine()
    {
        $user = auth()->user();
        $user->registered_vac_hospital = 0;
        $user->save();
        return redirect()->route('dashboard')->with('success-msg', 'Successfully Unregistered');
    }

    public function reg_vaccine(int $hospital_id)
    {
        $user = auth()->user();
        $user->registered_vac_hospital = $hospital_id;
        $user->save();
        return redirect()->route('dashboard')->with('success-msg', 'Successfully Registered for vaccination');
    }

    public function update_vaccine_info()
    {
        $inputs = request()->validate([
            'vac_patient' => ['string',],
            'vac_dose' => ['string'],
            'dov' => ['date',],
        ]);

        $user = User::find($inputs['vac_patient']);
        $user[$inputs['vac_dose']] = $inputs['dov'] == "" ? " " : date($inputs['dov']);
        $user->save();

        return back()->with('success-msg', 'Vaccine Information updated successfully!!');
    }
}
