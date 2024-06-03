<?php

namespace App\Http\Controllers\Football;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Footbal\FootbalCoach;
use App\Models\Footbal\FootbalGames;
use App\Models\Footbal\FootbalPlayer;
use App\Models\Footbal\FootbalTeam;
use App\Models\Footbal\FootbalTournament;
use App\Models\Footbal\FootbalTournamentPlayerStatistics;
use App\Models\Footbal\FootbalTournamentStatistics;
use App\Models\Footbal\FootbalVenues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JimmyTraits;
use Carbon\Carbon;

class FootballController extends Controller
{
    use JimmyTraits;
    protected $data = [];
    private $viewPath = 'football';

    public function __construct(){
        $this->data['url'] = 'football';
    }

    public function footballDashboard(){
        $this->data['title'] = 'Football';
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
           
           if(!empty($request->input('coach_id'))) {
            $coach = FootbalCoach::find($request->input('coach_id'));
            $coach->team_id = $team->id;
            $coach->save();
           }
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
            return view($this->viewPath . '.createTournament',$this->data);
        } else {
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
            if(!empty($request->input('team_id'))) {
                $team = FootbalTeam::find($request->input('team_id'));
                $team->coach_id = $coach->id;
                $team->save();
            }
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

      // Fixtures management  
    public function GetTeamFixtures(){
        $this->data['tournaments'] = FootbalTournament::with('games')->get();
        return view($this->viewPath . '.fixtures', $this->data);
    }

    public function GenerateFixtures(Request $request){
        $tournament_id = $request->tournament_id;
        $teams = FootbalTeam::all();
        // Algorithm to generate fixtures
        $fixtures = $this->generateRoundRobinFixtures($teams, $tournament_id);
        foreach ($fixtures as $fixture) {
            FootbalGames::create($fixture);
        }
        return redirect('football/Fixtures')->with('success', 'Fixtures generated successfully');
    }

    private function generateRoundRobinFixtures($teams, $tournament_id) {
        $fixtures = [];
        $teamCount = count($teams);
        $teams = $teams->toArray(); // Convert collection to array
        $gameDays = [];
        $usedSlots = [];

        for ($round = 0; $round < $teamCount - 1; $round++) {
            $dayOffset = $round * 2; // Spreading games every 2 days
            for ($match = 0; $match < $teamCount / 2; $match++) {
                $home = ($round + $match) % ($teamCount - 1);
                $away = ($teamCount - 1 - $match + $round) % ($teamCount - 1);

                if ($match == 0) {
                    $away = $teamCount - 1;
                }

                if ($teams[$home]['id'] != $teams[$away]['id']) {
                    // Home game
                    $homeTime = $this->findAvailableTimeSlot($teams[$home]['venue_id'], $dayOffset, $usedSlots);
                    $fixtures[] = [
                        'home_team_id' => $teams[$home]['id'],
                        'away_team_id' => $teams[$away]['id'],
                        'tournament_id' => $tournament_id,
                        'date' => $homeTime->toDateString(),
                        'start_time' => $homeTime->format('H:i:s'),
                        'venue_id' => $teams[$home]['venue_id'],
                    ];
                    $usedSlots[$teams[$home]['venue_id']][$homeTime->toDateString()][$homeTime->format('H:i:s')] = true;

                    // Away game
                    $awayTime = $this->findAvailableTimeSlot($teams[$away]['venue_id'], $dayOffset, $usedSlots);
                    $fixtures[] = [
                        'home_team_id' => $teams[$away]['id'],
                        'away_team_id' => $teams[$home]['id'],
                        'tournament_id' => $tournament_id,
                        'date' => $awayTime->toDateString(),
                        'start_time' => $awayTime->format('H:i:s'),
                        'venue_id' => $teams[$away]['venue_id'],
                    ];
                    $usedSlots[$teams[$away]['venue_id']][$awayTime->toDateString()][$awayTime->format('H:i:s')] = true;
                }
            }
        }

        return $fixtures;
    }

    private function findAvailableTimeSlot($venue_id, $dayOffset, &$usedSlots) {
        $date = now()->addDays($dayOffset);
        $startTime = Carbon::createFromTimeString("10:00:00");
        $endTime = Carbon::createFromTimeString("16:00:00");

        while ($startTime->lessThanOrEqualTo($endTime)) {
            if (empty($usedSlots[$venue_id][$date->toDateString()][$startTime->format('H:i:s')])) {
                return $startTime;
            }
            $startTime->addHour();
        }
        // If no slots are available, increment the day and reset the time
        return $this->findAvailableTimeSlot($venue_id, $dayOffset + 1, $usedSlots);
    }


    // Tournament Statistics management  
    public function GetAllTournamentsStatistics(){
        $this->data['statistics'] = FootbalTournamentStatistics::with(['tournament', 'team', 'game'])->get();
        return view($this->viewPath . '.statistics', $this->data);
    }

    public function CreateStatistics(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['teams'] = FootbalTeam::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.createStatistics', $this->data);
        } else {
            $statistics = new FootbalTournamentStatistics();
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath.'/Team/Statistics')->with('success', 'Statistics created successfully');
        }
    }

    public function UpdateStatistics(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['statistics'] = FootbalTournamentStatistics::find($request->statistics_id);
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['teams'] = FootbalTeam::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.updateStatistics', $this->data);
        } else {
            $statistics = FootbalTournamentStatistics::find($request->statistics_id);
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath.'/Team/Statistics')->with('success', 'Statistics updated successfully');
        }
    }

    public function DeleteStatistics(Request $request){
        $statistics = FootbalTournamentStatistics::find($request->statistics_id);
        $statistics->delete();
        return redirect($this->viewPath.'/Team/Statistics')->with('success', 'Statistics deleted successfully');
    }

    // Player Statistics management  
    public function GetAllTournamentsPlayerStatistics(){
        $this->data['playerStatistics'] = FootbalTournamentPlayerStatistics::with(['tournament', 'player', 'game'])->get();
        return view($this->viewPath . '.playerStatistics', $this->data);
    }

    public function CreatePlayerStatistics(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['players'] = FootbalPlayer::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.createPlayerStatistics', $this->data);
        } else {
            $playerStatistics = new FootbalTournamentPlayerStatistics();
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath.'/Player/Statistics')->with('success', 'Player Statistics created successfully');
        }
    }

    public function UpdatePlayerStatistics(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['playerStatistics'] = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['players'] = FootbalPlayer::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.updatePlayerStatistics', $this->data);
        } else {
            $playerStatistics = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath.'/Player/Statistics')->with('success', 'Player Statistics updated successfully');
        }
    }

    public function DeletePlayerStatistics(Request $request){
        $playerStatistics = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
        $playerStatistics->delete();
        return redirect($this->viewPath.'/Player/Statistics')->with('success', 'Player Statistics deleted successfully');
    }

     // Venues management  
     public function getAllStadium(){
        $this->data['stadiums'] = FootbalVenues::all();
        return view($this->viewPath . '.stadiums', $this->data);
    }

    public function CreateStadium(Request $request){
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createStadium', $this->data);
        } else {
            $stadium = new FootbalVenues();
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath.'/Stadium')->with('success', 'Stadium created successfully');
        }
    }

    public function UpdateStadium(Request $request){
        if ($request->isMethod('GET')) {
            $this->data['stadium'] = FootbalVenues::find($request->stadium_id);
            return view($this->viewPath . '.updateStadium', $this->data);
        } else {
            $stadium = FootbalVenues::find($request->stadium_id);
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath.'/Stadium')->with('success', 'Stadium updated successfully');
        }
    }

    public function DeleteStadium(Request $request){
        $stadium = FootbalVenues::find($request->stadium_id);
        $stadium->delete();
        return redirect($this->viewPath.'/Stadium')->with('success', 'Stadium deleted successfully');
    }
}
