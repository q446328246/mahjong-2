<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
//         $this->middleware('auth:admin');
    }


    public function index(Request $request) {
        $User = Auth::user();
        return view('admin.index',['User' => $User]);
    }
}
