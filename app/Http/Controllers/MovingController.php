<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Master\M_Month as Month;

class MovingController extends Controller
{
    public function index(Request $request) {
        $Months = Month::all();

        return view('moving.index', ['Months' => $Months]);
    }
}
