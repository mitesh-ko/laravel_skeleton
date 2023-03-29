<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:' . config('permission-name.dashboard-first_dashboard'), ['only' => ['firstDashboard']]);
    }

    public function firstDashboard()
    {
        return view('dashboard');
    }
}
