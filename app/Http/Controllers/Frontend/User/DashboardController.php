<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.user.dashboard')
            ->withUser(access()->user());
    }
}
