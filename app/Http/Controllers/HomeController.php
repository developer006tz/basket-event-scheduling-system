<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coaches;
use App\Models\Players;
use App\Models\Teams;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $coaches = Coaches::all();
        $players = Players::all();
        $teams = Teams::all();
        return view('home',compact('users','coaches','players','teams'));
    }
}
