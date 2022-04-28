<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Job;
use App\Models\Favorite;


class ProfileController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with(['job', 'job.company',])->where('user_id', '=', Auth::id())->get();
    
        return view('profile.index', [
            'favorites' => $favorites,
            'user' => Auth::user(),
        ]);
    }

    

    
}
