<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Hospital $hospital)
    {
        session(['hospital' => $hospital]);
        // return session('hospital');

        return view('appointment.create', [
            'hospital' => $hospital
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = request()->validate([
            'patient_name' => 'required',
            'doctor_id' => 'required',
            'gender' => 'required',
            'dob' => ['required', 'date_format:Y-m-d'],
            'weight' => ['numeric', 'nullable'],
            'blood_group' => ['nullable', 'string'],
        ]);

        $inputs['hospital_id'] = session('hospital')->id;
        $inputs['user_id'] = auth()->user()->id;

        // return $inputs;
        Appointment::create($inputs);
        return redirect(RouteServiceProvider::HOME)
            ->with('success-msg', 'Your Appointment is bring processed. Please visit dashboard for update');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (!auth()->check() || $appointment->hospital->user_id != auth()->user()->id) {
            // echo $test->user_id;
            // echo auth()->user()->id;
            abort(403, 'The Requested resource is not authorised');
        }
        return view('appointment.edit', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (!auth()->check() || $appointment->hospital->user_id != auth()->user()->id) {
            // echo $test->user_id;
            // echo auth()->user()->id;
            abort(403, 'The Requested resource is not authorised');
        }

        $appointment->status = $request->status;
        $appointment->comments = $request->comments;

        $appointment->save();
        return redirect()->route('dashboard')->with('success-msg', 'Appointment updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $test)
    {
        //
    }
}
