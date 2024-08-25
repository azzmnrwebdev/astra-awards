<?php

namespace App\Http\Controllers;

use App\Models\Mosque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function information()
    {
        $userId = Auth::user()->id;
        $information = Mosque::with(['user', 'categoryArea', 'company', 'province'])->where('user_id', $userId)->first();

        return view('pages.information', compact('information'));
    }
}
