<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index()
    {
        echo "haloo selamat datang";
        echo "<h1>" . Auth::user()->name . "</h1>";
    }
}
