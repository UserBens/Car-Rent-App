<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function adminindex()
    {
        return view('admin.dashboard');
    }
    public function clientindex()
    {
        return view('client.dashboard');
    }
}
