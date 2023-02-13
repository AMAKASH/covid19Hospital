<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Test;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class TestController extends Controller
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

        return view('test.create', [
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
            'test_name_id' => 'required',
            'gender' => 'required',
            'dob' => ['required', 'date_format:Y-m-d'],
            'weight' => ['numeric', 'nullable'],
            'blood_group' => ['nullable', 'string'],
        ]);

        $inputs['hospital_id'] = session('hospital')->id;
        $inputs['user_id'] = auth()->user()->id;

        // return $inputs;
        Test::create($inputs);
        return redirect(RouteServiceProvider::HOME)
            ->with('success-msg', 'Your Request is bring processed. Please visit dashboard for update');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (!auth()->check() || $test->hospital->user_id != auth()->user()->id) {
            // echo $test->user_id;
            // echo auth()->user()->id;
            abort(403, 'The Requested resource is not authorised');
        }
        return view('test.edit', [
            'test' => $test,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (!auth()->check() || $test->hospital->user_id != auth()->user()->id) {
            // echo $test->user_id;
            // echo auth()->user()->id;
            abort(403, 'The Requested resource is not authorised');
        }
        $request->validate([
            'report' => 'nullable|mimes:pdf|max:6000'
        ]);

        $test->comments = $request->comments;
        $test->status = $request->status;

        if ($request->file()) {
            $filePath = $request->file('report')->store('reports');
            $test->test_report_path = $filePath;
        }

        $test->save();
        return redirect()->route('dashboard')->with('success-msg', ' Test updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }

    public function download(Test $test)
    {
        if (auth()->check() && auth()->user()->role_id == 1);
        elseif (auth()->check() && $test->user_id == auth()->user()->id);
        elseif (!auth()->check() || $test->hospital->user_id != auth()->user()->id) {
            // echo $test->user_id;
            // echo auth()->user()->id;
            abort(403, 'The Requested resource is not authorised');
        }

        $filePath = storage_path('app/' . $test->test_report_path);
        // return $filePath;
        $headers = ['Content-Type: application/pdf'];
        $fileName =  $test->testName->name . '_' . $test->patient_name . '_' . now() . '.pdf';

        return response()->download($filePath, $fileName, $headers);
    }
}
