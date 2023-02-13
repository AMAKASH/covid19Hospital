<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Hospital;
use App\Models\TestName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{

    public function search()
    {
        $areas = Area::orderBy('area_name', 'ASC')->get();
        $search_area = request('search') ?? 'null';

        $verfied_hospitals = DB::select("SELECT hospitals.id as id,user_id,hospitals.name as name,address,area_name,
        general_bed,icu_bed,oxygen_suppply_availability,
        covid_vaccine_availability FROM hospitals INNER JOIN areas ON
        hospitals.area_id=areas.id INNER JOIN users ON hospitals.user_id=users.id
        WHERE users.verified_at != 'null' AND areas.area_name LIKE '%$search_area%'");
        // return $verfied_hospitals;


        if ($search_area == 'null') {
            $search_area = '';
        }
        return view('search-page', [
            'hospitals' => $verfied_hospitals,
            'search_value' => $search_area,
            'areas' => $areas,
        ]);
    }
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test_name = request('test_name');
        $doctor = request('doctor');

        $verified_hospitals = User::whereRoleId(2)->where('verified_at', '!=', null)->pluck('id');
        $verified_hospitals = Hospital::whereIn('user_id', $verified_hospitals)->orderBy('name', 'ASC');
        // return $verified_hospitals
        $title_text = 'List of All Hospitals';

        if ($test_name) {
            $test_name = TestName::findOrFail($test_name);
            $hospital_by_test_names = $test_name->hospitals->pluck('id');
            $test_name = $test_name->name;
            $verified_hospitals = $verified_hospitals->whereIn('id', $hospital_by_test_names)->get();
            $title_text = "'$test_name' is available on the following hospital(s)";
        } elseif ($doctor) {
            $doctor = Doctor::findOrFail($doctor);
            $hospital_by_doctor = $doctor->hospitals->pluck('id');
            $doctor = $doctor->name;
            $verified_hospitals = $verified_hospitals->whereIn('id', $hospital_by_doctor)->get();
            $title_text = "'$doctor' has chamber in the following hospital(s)";
        } else {
            $verified_hospitals = $verified_hospitals->get();
        }


        return view('hospital.index', [
            'hospitals' => $verified_hospitals,
            'title_text' => $title_text,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (auth()->user()->role_id != 2 || auth()->user()->role_id != $user->role_id) {
            abort(403, 'The Requested resource is not authorised');
        }
        $inputs = $request->validate([
            'area_id' => ['required', 'numeric'],
            'license_number' => ['required'],
            'address' => ['required', 'string'],
            'general_bed' => ['required', 'numeric'],
            'icu_bed' => ['required', 'numeric'],
            'oxygen_suppply_availability' => ['required', 'string'],
            'covid_vaccine_availability' => ['required', 'string'],
        ]);

        $inputs['name'] = $user->name;

        $user->hospital()->create($inputs);
        return redirect()->route('dashboard')->with('success-msg', 'Hospital Registered successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (!$hospital->user->verified_at) {
            abort(403, 'The Requested resource is not authorised');
        }

        return view('hospital.show', [
            'hospital' => $hospital,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hospital $hospital)
    {
        $inputs = $request->validate([
            'general_bed' => ['nullable', 'numeric'],
            'icu_bed' => ['nullable', 'numeric'],
            'oxygen_suppply_availability' => ['nullable'],
            'covid_vaccine_availability' => ['nullable'],
        ]);
        $inputs_filtered = array_filter($inputs, function ($v) {
            return $v != null;
        });

        //return $inputs_filtered;

        $hospital->update($inputs_filtered);

        return back()->with('success-msg', 'Status updated successfully!!');
    }

    public function update_test_doctor(Request $request, Hospital $hospital)
    {
        $inputs = request()->all();
        $test_names = array_map('intval', $inputs['test_names']);
        $doctors = array_map('intval', $inputs['doctors']);
        $hospital->test_names()->sync($test_names);
        $hospital->doctors()->sync($doctors);

        return back()->with('success-msg', 'Test names & Doctors updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        //
    }
}
