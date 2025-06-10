<?php

namespace App\Http\Controllers\owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardOwnerController extends Controller
{
    public function index()
    {
        return view('owner.dashboard.dashboard',);
    }
}
