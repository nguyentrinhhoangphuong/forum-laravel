<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(User $info)
    {
        $this->authorize('viewDashboard', $info);
        return view('dashboard.index', compact('info'));
    }
}
