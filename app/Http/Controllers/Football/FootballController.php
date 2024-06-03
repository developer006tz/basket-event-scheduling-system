<?php

namespace App\Http\Controllers\Football;

use App\Http\Controllers\Controller;
use App\Models\Footbal\FootbalCoach;
use App\Models\Footbal\FootbalGames;
use App\Models\Footbal\FootbalPlayer;
use App\Models\Footbal\FootbalTeam;
use App\Models\Footbal\FootbalTournament;
use App\Models\Footbal\FootbalVenues;
use Illuminate\Http\Request;
use App\Traits\JimmyTraits;

class FootballController extends Controller
{
    use JimmyTraits;
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
            $this->data['coaches'] = FootbalCoach::where('team_id',null)->get();
            $this->data['venues'] = FootbalVenues::select('name','id')->get();
            return view($this->viewPath .'.createTeam', $this->data);
        }else{
           $team  = new FootbalTeam();
           $team->fill($request->all());
           $team->save();
           if ($request->hasFile('badge')) {
            $file = $request->file('badge');
            $filename = time() .'.'. $file->extension();
            $this->upload_file($file,$filename);
            $team->badge = $filename;
            $team->save();
           }
           return redirect($this->viewPath.'/Teams')->with('success','added successfull');
        }
        
    }

    public function UpdateTeam(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['coaches'] = FootbalCoach::where('team_id',null)->get();
            $this->data['venues'] = FootbalVenues::select('name','id')->get();
            $this->data['team'] = FootbalTeam::find($request->team_id);
            return view($this->viewPath .'.updateTeam', $this->data);
        }else{
           $team  = FootbalTeam::find($request->team_id);
           $team->fill($request->all());
           $team->save();
           if ($request->hasFile('badge')) {
            $this->delete_file($team->badge);
            $file = $request->file('badge');
            $filename = time() .'.'. $file->extension();
            $this->upload_file($file,$filename);
            $team->badge = $filename;
            $team->save();
           }
           return redirect($this->viewPath.'/Teams')->with('success','Updated successfull');
        }
        
    }

    public function DeleteTeam(Request $request){
        $team = FootbalTeam::find($request->team_id);
        $this->delete_file($team->badge);
        $team->delete();
        return redirect($this->viewPath.'/Teams')->with('success','deleted successfull');
    }
}
