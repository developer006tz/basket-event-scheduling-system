<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;
use App\Models\Basket\BasketCoach;
use App\Models\Course;
use App\Models\Basket\BasketGames;
use App\Models\Basket\BasketPlayer;
use App\Models\Basket\BasketTeam;
use App\Models\Basket\BasketTournament;
use App\Models\Basket\BasketTournamentPlayerStatistics;
use App\Models\Basket\BasketTournamentStatistics;
use App\Models\Basket\BasketVenues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JimmyTraits;
use Carbon\Carbon;

class BasketController extends Controller
{
    use JimmyTraits;
    protected $data = [];
    private $viewPath = 'basketball';

    public function __construct()
    {
        $this->data['url'] = 'basketball';
    }

    public function BasketballDashboard()
    {
        $this->data['title'] = 'BasketBall';
        $this->data['players'] = BasketPlayer::count();
        $this->data['games'] = BasketGames::all();
        $this->data['teams'] = BasketTeam::count();
        $this->data['tournaments'] = BasketTournament::count();
        $this->data['coaches'] = BasketCoach::count();
        return view($this->viewPath . '.dashboard', $this->data);

    }

    // Teams management  
    public function Teams()
    {
        $this->data['teams'] = BasketTeam::all();
        return view($this->viewPath . '.teams', $this->data);
    }

    public function CreateTeam(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['coaches'] = BasketCoach::where('team_id', null)->get();
            $this->data['venues'] = BasketVenues::select('name', 'id')->get();
            return view($this->viewPath . '.createTeam', $this->data);
        } else {
            $team = new BasketTeam();
            $team->fill($request->all());
            $team->save();

            if (!empty($request->input('coach_id'))) {
                $coach = BasketCoach::find($request->input('coach_id'));
                $coach->team_id = $team->id;
                $coach->save();
            }
            if ($request->hasFile('badge')) {
                $file = $request->file('badge');
                $filename = time() . '.' . $file->extension();
                $this->upload_file($file, $filename);
                $team->badge = $filename;
                $team->save();
            }
            return redirect($this->viewPath . '/Teams')->with('success', 'added successfull');
        }

    }

    public function UpdateTeam(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['coaches'] = BasketCoach::where('team_id', null)->get();
            $this->data['venues'] = BasketVenues::select('name', 'id')->get();
            $this->data['team'] = BasketTeam::find($request->team_id);
            return view($this->viewPath . '.updateTeam', $this->data);
        } else {
            $team = BasketTeam::find($request->team_id);
            $team->fill($request->all());
            $team->save();
            if (!empty($request->input('coach_id'))) {
                $coach = BasketCoach::find($request->input('coach_id'));
                $coach->team_id = $team->id;
                $coach->save();
            }
            if ($request->hasFile('badge')) {
                $this->delete_file($team->badge);
                $file = $request->file('badge');
                $filename = time() . '.' . $file->extension();
                $this->upload_file($file, $filename);
                $team->badge = $filename;
                $team->save();
            }
            return redirect($this->viewPath . '/Teams')->with('success', 'Updated successfull');
        }

    }

    public function DeleteTeam(Request $request)
    {
        $team = BasketTeam::find($request->team_id);
        $this->delete_file($team->badge);
        $team->delete();
        return redirect($this->viewPath . '/Teams')->with('success', 'deleted successfull');
    }

    #tournaments
    public function GetAllTournaments()
    {
        $this->data['tournaments'] = BasketTournament::all();
        return view($this->viewPath . '.tournaments', $this->data);
    }

    public function CreateTournament(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createTournament', $this->data);
        } else {
            $tournament = new BasketTournament();
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament created successfully');
        }
    }

    public function UpdateTournament(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournament'] = BasketTournament::find($request->tournament_id);
            return view($this->viewPath . '.updateTournament', $this->data);
        } else {
            $tournament = BasketTournament::find($request->tournament_id);
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament updated successfully');
        }
    }

    public function DeleteTournament(Request $request)
    {
        $tournament = BasketTournament::find($request->tournament_id);
        $tournament->delete();
        return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament deleted successfully');
    }

    #coachers
    public function GetAllCoachers()
    {
        $this->data['coaches'] = BasketCoach::all();
        return view($this->viewPath . '.coachers', $this->data);
    }

    public function CreateCoacher(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['teams'] = BasketTeam::where('coach_id', null)->select('name', 'id')->get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createCoacher', $this->data);
        } else {
            $coach = new BasketCoach();
            $coach->fill($request->all());
            $coach->save();
            if (!empty($request->input('team_id'))) {
                $team = BasketTeam::find($request->input('team_id'));
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

    public function UpdateCoacher(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['coach'] = BasketCoach::find($request->coach_id);
            $this->data['teams'] = BasketTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updateCoacher', $this->data);
        } else {
            $coach = BasketCoach::find($request->coach_id);
            $coach->fill($request->all());
            $coach->save();
            if (!empty($request->input('team_id'))) {
                $team = BasketTeam::find($request->input('team_id'));
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

    public function DeleteCoacher(Request $request)
    {
        $coach = BasketCoach::find($request->coach_id);
        $this->delete_file($coach->image);
        $coach->delete();
        return redirect($this->viewPath . '/Coachers')->with('success', 'Coach deleted successfully');
    }

    // Players management  
    public function GetAllPlayers()
    {
        $this->data['players'] = BasketPlayer::all();
        return view($this->viewPath . '.players', $this->data);
    }

    public function CreatePlayers(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['teams'] = BasketTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createPlayer', $this->data);
        } else {
            $player = new BasketPlayer();
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
            return redirect($this->viewPath . '/Players')->with('success', 'Player created successfully');
        }
    }

    public function UpdatePlayers(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['player'] = BasketPlayer::find($request->player_id);
            $this->data['teams'] = BasketTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updatePlayer', $this->data);
        } else {
            $player = BasketPlayer::find($request->player_id);
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
            return redirect($this->viewPath . '/Players')->with('success', 'Player updated successfully');
        }
    }

    public function DeletePlayers(Request $request)
    {
        $player = BasketPlayer::find($request->player_id);
        $this->delete_file($player->photo);
        $player->delete();
        return redirect($this->viewPath . '/Players')->with('success', 'Player deleted successfully');
    }

    // Fixtures management  
    public function GetTeamFixtures()
    {
        $this->data['tournaments'] = FootbalTournament::with('games')->get();
        return view($this->viewPath . '.fixtures', $this->data);
    }

    public function GenerateFixtures(Request $request)
    {
        $tournament_id = $request->tournament_id;
        $teams = FootbalTeam::all();
        $fixtures = $this->generateRoundRobinFixtures($teams, $tournament_id);
        foreach ($fixtures as $fixture) {
            FootbalGames::create($fixture);
        }
        return redirect($this->viewPath . '/Fixtures')->with('success', 'Fixtures generated successfully');
    }

    private function generateRoundRobinFixtures($teams, $tournament_id)
    {
        $fixtures = [];
        $teamCount = count($teams);
        $teams = $teams->toArray(); // Convert collection to array
        $usedSlots = $this->getUsedSlots(); // Retrieve used slots from database

        for ($round = 0; $round < $teamCount - 1; $round++) {
            for ($match = 0; $match < $teamCount / 2; $match++) {
                $home = ($round + $match) % ($teamCount - 1);
                $away = ($teamCount - 1 - $match + $round) % ($teamCount - 1);

                if ($match == 0) {
                    $away = $teamCount - 1;
                }

                // Ensure the same team is not playing against itself
                if ($teams[$home]['id'] != $teams[$away]['id']) {
                    // Schedule for both home and away matches
                    $homeTime = $this->findAvailableTimeSlot($teams[$home]['venue_id'], $usedSlots);
                    $fixtures[] = $this->createFixtureArray($teams[$home]['id'], $teams[$away]['id'], $tournament_id, $homeTime, $teams[$home]['venue_id']);
                    $awayTime = $this->findAvailableTimeSlot($teams[$away]['venue_id'], $usedSlots);
                    $fixtures[] = $this->createFixtureArray($teams[$away]['id'], $teams[$home]['id'], $tournament_id, $awayTime, $teams[$away]['venue_id']);
                }
            }
        }

        return $fixtures;
    }

    private function getUsedSlots()
    {
        $games = FootbalGames::all(['venue_id', 'date', 'start_time']);
        $slots = [];

        foreach ($games as $game) {
            $venue_id = (string) $game->venue_id;  // Cast to string to ensure it's a valid array key
            $date = $game->date instanceof Carbon ? $game->date->toDateString() : $game->date;

            $start_time = $game->start_time instanceof Carbon ? $game->start_time->format('H:i:s') : $game->start_time;

            $slots[$venue_id][$date][$start_time] = true;
        }

        return $slots;
    }



    private function findAvailableTimeSlot($venue_id, &$usedSlots)
    {
        $date = Carbon::today();
        $startTime = Carbon::createFromTime(10, 0, 0); // Starting at 10:00 AM
        $endTime = Carbon::createFromTime(16, 0, 0); // Up to 4:00 PM

        while (true) {
            $timeKey = $startTime->format('H:i:s');
            if (empty($usedSlots[$venue_id][$date->toDateString()][$timeKey])) {
                $usedSlots[$venue_id][$date->toDateString()][$timeKey] = true; // Mark this slot as used
                return Carbon::create($date->year, $date->month, $date->day, $startTime->hour, $startTime->minute, $startTime->second);
            }
            $startTime->addHour();
            if ($startTime->greaterThan($endTime)) {
                $startTime->setHour(10);
                $date->addDay(); // Move to the next day if time exceeds 4 PM
            }
        }
    }

    private function createFixtureArray($homeTeamId, $awayTeamId, $tournamentId, $dateTime, $venueId)
    {
        return [
            'home_team_id' => $homeTeamId,
            'away_team_id' => $awayTeamId,
            'tournament_id' => $tournamentId,
            'date' => $dateTime->toDateString(),
            'start_time' => $dateTime->format('H:i:s'),
            'venue_id' => $venueId,
        ];
    }


    // Tournament Statistics management  
    public function GetAllTournamentsStatistics()
    {
        $this->data['statistics'] = BasketTournamentStatistics::with(['tournament', 'team', 'game'])->get();
        return view($this->viewPath . '.statistics', $this->data);
    }

    public function CreateStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = BasketTournament::all();
            $this->data['teams'] = BasketTeam::all();
            $this->data['games'] = BasketGames::all();
            return view($this->viewPath . '.createStatistics', $this->data);
        } else {
            $statistics = new BasketTournamentStatistics();
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics created successfully');
        }
    }

    public function UpdateStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['statistics'] = BasketTournamentStatistics::find($request->statistics_id);
            $this->data['tournaments'] = BasketTournament::all();
            $this->data['teams'] = BasketTeam::all();
            $this->data['games'] = BasketGames::all();
            return view($this->viewPath . '.updateStatistics', $this->data);
        } else {
            $statistics = BasketTournamentStatistics::find($request->statistics_id);
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics updated successfully');
        }
    }

    public function DeleteStatistics(Request $request)
    {
        $statistics = BasketTournamentStatistics::find($request->statistics_id);
        $statistics->delete();
        return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics deleted successfully');
    }

    // Player Statistics management  
    public function GetAllTournamentsPlayerStatistics()
    {
        $this->data['playerStatistics'] = BasketTournamentPlayerStatistics::with(['tournament', 'player', 'game'])->get();
        return view($this->viewPath . '.playerStatistics', $this->data);
    }

    public function CreatePlayerStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = BasketTournament::all();
            $this->data['players'] = BasketPlayer::all();
            $this->data['games'] = BasketGames::all();
            return view($this->viewPath . '.createPlayerStatistics', $this->data);
        } else {
            $playerStatistics = new BasketTournamentPlayerStatistics();
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics created successfully');
        }
    }

    public function UpdatePlayerStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['playerStatistics'] = BasketTournamentPlayerStatistics::find($request->playerStatistics_id);
            $this->data['tournaments'] = BasketTournament::all();
            $this->data['players'] = BasketPlayer::all();
            $this->data['games'] = BasketGames::all();
            return view($this->viewPath . '.updatePlayerStatistics', $this->data);
        } else {
            $playerStatistics = BasketTournamentPlayerStatistics::find($request->playerStatistics_id);
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics updated successfully');
        }
    }

    public function DeletePlayerStatistics(Request $request)
    {
        $playerStatistics = BasketTournamentPlayerStatistics::find($request->playerStatistics_id);
        $playerStatistics->delete();
        return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics deleted successfully');
    }

    // Venues management  
    public function getAllStadium()
    {
        $this->data['stadiums'] = BasketVenues::all();
        return view($this->viewPath . '.stadiums', $this->data);
    }

    public function CreateStadium(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createStadium', $this->data);
        } else {
            $stadium = new BasketVenues();
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium created successfully');
        }
    }

    public function UpdateStadium(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['stadium'] = BasketVenues::find($request->stadium_id);
            return view($this->viewPath . '.updateStadium', $this->data);
        } else {
            $stadium = BasketVenues::find($request->stadium_id);
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium updated successfully');
        }
    }

    public function DeleteStadium(Request $request)
    {
        $stadium = BasketVenues::find($request->stadium_id);
        $stadium->delete();
        return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium deleted successfully');
    }

}
