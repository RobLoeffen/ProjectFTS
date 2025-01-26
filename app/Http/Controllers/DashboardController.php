<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $festivals = Festival::all();
        $users = User::all();
        return view('dashboard', compact('festivals', 'users'));
    }
}
