<?php

namespace App\Http\Controllers\Football;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Footbal\FootbalCoach;
use App\Models\Footbal\FootbalGames;
use App\Models\Footbal\FootbalPlayer;
use App\Models\Footbal\FootbalTeam;
use App\Models\Footbal\FootbalTournament;
use App\Models\Footbal\FootbalVenues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
           if(!empty($request->input('coach_id'))) {
            $coach = FootbalCoach::find($request->input('coach_id'));
            $coach->team_id = $team->id;
            $coach->save();
        }
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

    #tournaments
    public function GetAllTournaments(){
        $this->data['tournaments'] = FootbalTournament::all();
        return view($this->viewPath . '.tournaments', $this->data);
    }

    public function CreateTournament(Request $request){
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createTournament');
        } else {
            // dd($request->all());
            $tournament = new FootbalTournament();
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament created successfully');
        }
    }

    public function UpdateTournament(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['tournament'] = FootbalTournament::find($request->tournament_id);
            return view($this->viewPath . '.updateTournament', $this->data);
        } else {
            $tournament = FootbalTournament::find($request->tournament_id);
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament updated successfully');
        }
    }

    public function DeleteTournament(Request $request){
        $tournament = FootbalTournament::find($request->tournament_id);
        $tournament->delete();
        return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament deleted successfully');
    }

    #coachers
    public function GetAllCoachers(){
        $this->data['coaches'] = FootbalCoach::all();
        return view($this->viewPath . '.coachers', $this->data);
    }

    public function CreateCoacher(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['teams'] = FootbalTeam::where('coach_id',null)->select('name','id')->get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createCoacher',$this->data);
        } else {
            $coach = new FootbalCoach();
            $coach->fill($request->all());
            $coach->save();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->extension();
                $this->upload_file($file, $filename);
                $coach->image = $filename;
                $coach->save();
            }
            return redirect($this->viewPath . '/Coachers')->with('success', 'Coach created successfully');
        }
    }

    public function UpdateCoacher(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['coach'] = FootbalCoach::find($request->coach_id);
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updateCoacher', $this->data);
        } else {
            $coach = FootbalCoach::find($request->coach_id);
            $coach->fill($request->all());
            $coach->save();
            if(!empty($request->input('team_id'))) {
                $team = FootbalTeam::find($request->input('team_id'));
                $team->coach_id = $coach->id;
                $team->save();
            }
            if ($request->hasFile('image')) {
                $this->delete_file($coach->image);
                $file = $request->file('image');
                $filename = time() . '.' . $file->extension();
                $file->move(public_path('images'), $filename);
                $coach->image = $filename;
                $coach->save();
            }
            return redirect($this->viewPath . '/Coachers')->with('success', 'Coach updated successfully');
        }
    }

    public function DeleteCoacher(Request $request){
        $coach = FootbalCoach::find($request->coach_id);
        $this->delete_file($coach->image);
        $coach->delete();
        return redirect($this->viewPath . '/Coachers')->with('success', 'Coach deleted successfully');
    }

    // Players management  
    public function GetAllPlayers(){
        $this->data['players'] = FootbalPlayer::all();
        return view($this->viewPath . '.players', $this->data);
    }

    public function CreatePlayers(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createPlayer',$this->data);
        } else {
            $player = new FootbalPlayer();
            $player->fill($request->all());
            if ($request->filled('password')) {
                $player->password = Hash::make($request->password);
            }
            $player->save();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = time() . '.' . $file->extension();
                $file->move(public_path('images'), $filename);
                $player->photo = $filename;
                $player->save();
            }
            return redirect($this->viewPath.'/Players')->with('success', 'Player created successfully');
        }
    }

    public function UpdatePlayers(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['player'] = FootbalPlayer::find($request->player_id);
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updatePlayer', $this->data);
        } else {
            $player = FootbalPlayer::find($request->player_id);
            $player->fill($request->all());
            if ($request->filled('password')) {
                $player->password = Hash::make($request->password);
            }
            $player->save();
            if ($request->hasFile('photo')) {
                $this->delete_file($player->photo);
                $file = $request->file('photo');
                $filename = time() . '.' . $file->extension();
                $file->move(public_path('images'), $filename);
                $player->photo = $filename;
                $player->save();
            }
            return redirect($this->viewPath.'/Players')->with('success', 'Player updated successfully');
        }
    }

    public function DeletePlayers(Request $request){
        $player = FootbalPlayer::find($request->player_id);
        $this->delete_file($player->photo);
        $player->delete();
        return redirect($this->viewPath.'/Players')->with('success', 'Player deleted successfully');
    }
}
