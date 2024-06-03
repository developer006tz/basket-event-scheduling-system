<?php

namespace App\Http\Controllers\Football;

use App\Http\Controllers\Controller;
use App\Models\Footbal\FootbalCoach;
use App\Models\Footbal\FootbalGames;
use App\Models\Footbal\FootbalPlayer;
use App\Models\Footbal\FootbalTeam;
use App\Models\Footbal\FootbalTournament;
use Illuminate\Http\Request;

class FootballController extends Controller
{
    protected $data = [];
    private $viewPath = 'football';

    public function footballDashboard(){
        $this->data['players'] = FootbalPlayer::count();
        $this->data['games'] = FootbalGames::all();
        $this->data['teams'] = FootbalTeam::count();
        $this->data['tournaments'] = FootbalTournament::count();
        $this->data['coaches'] = FootbalCoach::count();
        return view($this->viewPath . '.dashboard', $this->data);

    }

    // Teams management  
    public function Teams(){
        $this->data['teams'] = FootbalTeam::all();
        return view($this->viewPath . '.teams', $this->data);
    }

    public function CreateTeam(Request $request){
        if ($request->isMethod('GET')) {
            return view($this->viewPath .'.createTeam', $this->data);
        }else{
           echo 'yes';
        }
        
    }
}
