<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\TestName;
use Illuminate\Http\Request;

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
        // auth()->guard('web')->logout();

        // request()->session()->invalidate();

        // request()->session()->regenerateToken();

        // return redirect('/');

        $hospital = Hospital::find(3);
        // return $hospital->test_names()->sync([2, 4, 5]);
        return $hospital->doctors()->sync([1, 3]);
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
}
