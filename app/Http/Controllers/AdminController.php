<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Rent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function logout()
    {
        Log::newLog('Logout', Auth::user()->name);
        Rent::query()->update(['notification_sent' => false]);
        Auth::logout();
        Session::invalidate();
        Session::regenerate();

        return redirect()->route('login');
    }
}
