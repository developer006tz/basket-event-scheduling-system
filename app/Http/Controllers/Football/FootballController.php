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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FootballController extends Controller
{
    use JimmyTraits;
    protected $data = [];
    private $viewPath = 'football';

    public function __construct()
    {
        $this->data['url'] = 'football';
    }

    public function footballDashboard()
    {
        $this->data['title'] = 'Football';
        $this->data['players'] = FootbalPlayer::count();
        $this->data['games'] = FootbalGames::all();
        $this->data['teams'] = FootbalTeam::count();
        $this->data['tournaments'] = FootbalTournament::count();
        $this->data['coaches'] = FootbalCoach::count();
        return view($this->viewPath . '.dashboard', $this->data);

    }

    // Teams management  
    public function Teams()
    {
        $this->data['teams'] = FootbalTeam::all();
        return view($this->viewPath . '.teams', $this->data);
    }

    public function CreateTeam(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['coaches'] = FootbalCoach::where('team_id', null)->get();
            $this->data['venues'] = FootbalVenues::select('name', 'id')->get();
            return view($this->viewPath . '.createTeam', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'short_name' => 'nullable|string|max:255',
                'coach_id' => 'nullable|exists:FootbalCoach,id',
                'badge' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'venue_id' => 'required|exists:FootbalVenues,id',
            ], [
                'name.required' => 'The team name is required.',
                'short_name.string' => 'The team short name must be a string.',
                'coach_id.exists' => 'The selected coach is invalid.',
                'badge.image' => 'The team badge must be an image.',
                'badge.mimes' => 'The team badge must be a file of type: jpeg, png, jpg, gif, webp.',
                'venue_id.required' => 'The team venue is required.',
                'venue_id.exists' => 'The selected venue is invalid.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $team = new FootbalTeam();
            $team->fill($request->all());
            $team->save();

            if (!empty($request->input('coach_id'))) {
                $coach = FootbalCoach::find($request->input('coach_id'));
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
            $this->data['coaches'] = FootbalCoach::where('team_id', null)->get();
            $this->data['venues'] = FootbalVenues::select('name', 'id')->get();
            $this->data['team'] = FootbalTeam::find($request->team_id);
            return view($this->viewPath . '.updateTeam', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'short_name' => 'nullable|string|max:255',
                'coach_id' => 'nullable|exists:FootbalCoach,id',
                'badge' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'venue_id' => 'required|exists:FootbalVenues,id',
            ], [
                'name.required' => 'The team name is required.',
                'short_name.string' => 'The team short name must be a string.',
                'coach_id.exists' => 'The selected coach is invalid.',
                'badge.image' => 'The team badge must be an image.',
                'badge.mimes' => 'The team badge must be a file of type: jpeg, png, jpg, gif, webp.',
                'venue_id.required' => 'The team venue is required.',
                'venue_id.exists' => 'The selected venue is invalid.',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $team = FootbalTeam::find($request->team_id);
            $team->fill($request->all());
            $team->save();
            if (!empty($request->input('coach_id'))) {
                $coach = FootbalCoach::find($request->input('coach_id'));
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
        $team = FootbalTeam::find($request->team_id);
        $this->delete_file($team->badge);
        $team->delete();
        return redirect($this->viewPath . '/Teams')->with('success', 'deleted successfull');
    }

    #tournaments
    public function GetAllTournaments()
    {
        $this->data['tournaments'] = FootbalTournament::all();
        return view($this->viewPath . '.tournaments', $this->data);
    }

    public function CreateTournament(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createTournament', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'name.required' => 'The tournament name is required.',
                'year.required' => 'Please specify the year of the tournament.',
                'start_date.required' => 'The start date is required.',
                'end_date.required' => 'The end date is required and must be after or on the start date.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $tournament = new FootbalTournament();
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament created successfully');
        }
    }

    public function UpdateTournament(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournament'] = FootbalTournament::find($request->tournament_id);
            return view($this->viewPath . '.updateTournament', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:1900|max:' . date('Y'),
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date'
            ], [
                'name.required' => 'The tournament name is required.',
                'year.required' => 'Please specify the year of the tournament.',
                'start_date.required' => 'The start date is required.',
                'end_date.required' => 'The end date is required and must be after or on the start date.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $tournament = FootbalTournament::find($request->tournament_id);
            $tournament->fill($request->all());
            $tournament->save();
            return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament updated successfully');
        }
    }

    public function DeleteTournament(Request $request)
    {
        $tournament = FootbalTournament::find($request->tournament_id);
        $tournament->delete();
        return redirect($this->viewPath . '/Tournaments')->with('success', 'Tournament deleted successfully');
    }

    #coachers
    public function GetAllCoachers()
    {
        $this->data['coaches'] = FootbalCoach::all();
        return view($this->viewPath . '.coachers', $this->data);
    }

    public function CreateCoacher(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['teams'] = FootbalTeam::where('coach_id', null)->select('name', 'id')->get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createCoacher', $this->data);
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:FootbalCoach,email',
                'phone' => 'required|string|max:20',
                'course_id' => 'nullable|exists:courses,id',
                'team_id' => 'nullable|exists:FootbalTeam,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ], [
                'name.required' => 'The coach name is required.',
                'email.required' => 'The email is required and must be unique.',
                'phone.required' => 'The phone number is required.',
                'course_id.exists' => 'The selected course is invalid.',
                'team_id.exists' => 'The selected team is invalid.',
                'image.image' => 'The coach image must be an image.',
                'image.mimes' => 'The coach image must be a file of type: jpeg, png, jpg, gif, webp.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $coach = new FootbalCoach();
            $coach->fill($request->all());
            $coach->save();
            if (!empty($request->input('team_id'))) {
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

    public function UpdateCoacher(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['coach'] = FootbalCoach::find($request->coach_id);
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updateCoacher', $this->data);
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:FootbalCoach,email,' . $request->coach_id,
                'phone' => 'required|string|max:20',
                'course_id' => 'nullable|exists:courses,id',
                'team_id' => 'nullable|exists:FootbalTeam,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ], [
                'name.required' => 'The coach name is required.',
                'email.required' => 'The email is required and must be unique.',
                'phone.required' => 'The phone number is required.',
                'course_id.exists' => 'The selected course is invalid.',
                'team_id.exists' => 'The selected team is invalid.',
                'image.image' => 'The coach image must be an image.',
                'image.mimes' => 'The coach image must be a file of type: jpeg, png, jpg, gif, webp.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $coach = FootbalCoach::find($request->coach_id);
            $coach->fill($request->all());
            $coach->save();
            if (!empty($request->input('team_id'))) {
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

    public function DeleteCoacher(Request $request)
    {
        $coach = FootbalCoach::find($request->coach_id);
        $this->delete_file($coach->image);
        $coach->delete();
        return redirect($this->viewPath . '/Coachers')->with('success', 'Coach deleted successfully');
    }

    // Players management  
    public function GetAllPlayers()
    {
        $this->data['players'] = FootbalPlayer::with(['course','team'])->get();
        return view($this->viewPath . '.players', $this->data);
    }

    public function CreatePlayers(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.createPlayer', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:FootbalPlayer,email',
                'phone' => 'required|string|max:20',
                'age' => 'required|integer|min:1|max:100',
                'team_id' => 'nullable|exists:FootbalTeam,id',
                'course_id' => 'nullable|exists:courses,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'password' => 'required|string|min:8',
            ], [
                'name.required' => 'Player name is required.',
                'email.required' => 'Email is required and must be unique.',
                'phone.required' => 'Phone number is required.',
                'age.required' => 'Age is required.',
                'password.required' => 'Password is required.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
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
            return redirect($this->viewPath . '/Players')->with('success', 'Player created successfully');
        }
    }

    public function UpdatePlayers(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['player'] = FootbalPlayer::find($request->player_id);
            $this->data['teams'] = FootbalTeam::get();
            $this->data['courses'] = Course::get();
            return view($this->viewPath . '.updatePlayer', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:FootbalPlayer,email,' . $request->player_id,
                'phone' => 'required|string|max:20',
                'age' => 'required|integer|min:1|max:100',
                'team_id' => 'nullable|exists:FootbalTeam,id',
                'course_id' => 'nullable|exists:courses,id',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'password' => 'nullable|string|min:8',
            ], [
                'name.required' => 'Player name is required.',
                'email.required' => 'Email is required and must be unique.',
                'phone.required' => 'Phone number is required.',
                'age.required' => 'Age is required.',
                'password.min' => 'Password must be at least 8 characters.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

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
            return redirect($this->viewPath . '/Players')->with('success', 'Player updated successfully');
        }
    }

    public function DeletePlayers(Request $request)
    {
        $player = FootbalPlayer::find(trim($request->player_id));
        $this->delete_file($player?->photo);
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
        $this->data['statistics'] = FootbalTournamentStatistics::with(['tournament', 'team', 'game'])->get();
        return view($this->viewPath . '.statistics', $this->data);
    }

    public function CreateStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['teams'] = FootbalTeam::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.createStatistics', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'tournament_id' => 'required|exists:FootbalTournament,id',
                'team_id' => 'required|exists:FootbalTeam,id',
                'game_id' => 'required|exists:FootbalGames,id',
                'goals_scored' => 'nullable|integer|min:0',
                'goals_conceded' => 'nullable|integer|min:0',
                'game_status' => 'nullable|in:scheduled,ongoing,completed,canceled',
            ], [
                'tournament_id.required' => 'Tournament is required.',
                'team_id.required' => 'Team is required.',
                'game_id.required' => 'Game is required.',
                'goals_scored.integer' => 'Goals scored must be an integer.',
                'goals_conceded.integer' => 'Goals conceded must be an integer.',
                'game_status.in' => 'Game status must be one of: scheduled, ongoing, completed, canceled.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $statistics = new FootbalTournamentStatistics();
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics created successfully');
        }
    }

    public function UpdateStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['statistics'] = FootbalTournamentStatistics::find($request->statistics_id);
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['teams'] = FootbalTeam::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.updateStatistics', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'tournament_id' => 'required|exists:FootbalTournament,id',
                'team_id' => 'required|exists:FootbalTeam,id',
                'game_id' => 'required|exists:FootbalGames,id',
                'goals_scored' => 'nullable|integer|min:0',
                'goals_conceded' => 'nullable|integer|min:0',
                'game_status' => 'nullable|in:scheduled,ongoing,completed,canceled',
            ], [
                'tournament_id.required' => 'Tournament is required.',
                'team_id.required' => 'Team is required.',
                'game_id.required' => 'Game is required.',
                'goals_scored.integer' => 'Goals scored must be an integer.',
                'goals_conceded.integer' => 'Goals conceded must be an integer.',
                'game_status.in' => 'Game status must be one of: scheduled, ongoing, completed, canceled.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $statistics = FootbalTournamentStatistics::find($request->statistics_id);
            $statistics->fill($request->all());
            $statistics->save();
            return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics updated successfully');
        }
    }

    public function DeleteStatistics(Request $request)
    {
        $statistics = FootbalTournamentStatistics::find($request->statistics_id);
        $statistics->delete();
        return redirect($this->viewPath . '/Team/Statistics')->with('success', 'Statistics deleted successfully');
    }

    // Player Statistics management  
    public function GetAllTournamentsPlayerStatistics()
    {
        $this->data['playerStatistics'] = FootbalTournamentPlayerStatistics::with(['tournament', 'player', 'game'])->get();
        return view($this->viewPath . '.playerStatistics', $this->data);
    }

    public function CreatePlayerStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['players'] = FootbalPlayer::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.createPlayerStatistics', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'tournament_id' => 'required|exists:FootbalTournament,id',
                'player_id' => 'required|exists:FootbalPlayer,id',
                'game_id' => 'required|exists:FootbalGames,id',
                'goals' => 'required|integer|min:0',
                'assist' => 'required|integer|min:0',
                'yellow_card' => 'required|integer|min:0',
                'red_card' => 'required|integer|min:0',
            ], [
                'tournament_id.required' => 'Tournament is required.',
                'player_id.required' => 'Player is required.',
                'game_id.required' => 'Game is required.',
                'goals.required' => 'Goals are required.',
                'assist.required' => 'Assists are required.',
                'yellow_card.required' => 'Yellow cards are required.',
                'red_card.required' => 'Red cards are required.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $playerStatistics = new FootbalTournamentPlayerStatistics();
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics created successfully');
        }
    }

    public function UpdatePlayerStatistics(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['playerStatistics'] = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
            $this->data['tournaments'] = FootbalTournament::all();
            $this->data['players'] = FootbalPlayer::all();
            $this->data['games'] = FootbalGames::all();
            return view($this->viewPath . '.updatePlayerStatistics', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'tournament_id' => 'required|exists:FootbalTournament,id',
                'player_id' => 'required|exists:FootbalPlayer,id',
                'game_id' => 'required|exists:FootbalGames,id',
                'goals' => 'required|integer|min:0',
                'assist' => 'required|integer|min:0',
                'yellow_card' => 'required|integer|min:0',
                'red_card' => 'required|integer|min:0',
            ], [
                'tournament_id.required' => 'Tournament is required.',
                'player_id.required' => 'Player is required.',
                'game_id.required' => 'Game is required.',
                'goals.required' => 'Goals are required.',
                'assist.required' => 'Assists are required.',
                'yellow_card.required' => 'Yellow cards are required.',
                'red_card.required' => 'Red cards are required.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $playerStatistics = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
            $playerStatistics->fill($request->all());
            $playerStatistics->save();
            return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics updated successfully');
        }
    }

    public function DeletePlayerStatistics(Request $request)
    {
        $playerStatistics = FootbalTournamentPlayerStatistics::find($request->playerStatistics_id);
        $playerStatistics->delete();
        return redirect($this->viewPath . '/Player/Statistics')->with('success', 'Player Statistics deleted successfully');
    }

    // Venues management  
    public function getAllStadium()
    {
        $this->data['stadiums'] = FootbalVenues::all();
        return view($this->viewPath . '.stadiums', $this->data);
    }

    public function CreateStadium(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view($this->viewPath . '.createStadium', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'capacity' => 'required|integer|min:1',
                'status' => 'required|in:active,maintenance,unused',
            ], [
                'name.required' => 'Stadium name is required.',
                'capacity.required' => 'Stadium Capacity is required.',
                'capacity.integer' => 'Capacity must be an integer.',
                'status.required' => 'Status is required.',
                'status.in' => 'Status must be one of: active, maintenance, unused.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $stadium = new FootbalVenues();
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium created successfully');
        }
    }

    public function UpdateStadium(Request $request)
    {
        if ($request->isMethod('GET')) {
            $this->data['stadium'] = FootbalVenues::find($request->stadium_id);
            return view($this->viewPath . '.updateStadium', $this->data);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'capacity' => 'nullable|integer|min:1',
                'status' => 'required|in:active,maintenance,unused',
            ], [
                'name.required' => 'Stadium name is required.',
                'capacity.integer' => 'Capacity must be an integer.',
                'status.required' => 'Status is required.',
                'status.in' => 'Status must be one of: active, maintenance, unused.',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $stadium = FootbalVenues::find($request->stadium_id);
            $stadium->fill($request->all());
            $stadium->save();
            return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium updated successfully');
        }
    }

    public function DeleteStadium(Request $request)
    {
        $stadium = FootbalVenues::find($request->stadium_id);
        $stadium->delete();
        return redirect($this->viewPath . '/Stadium')->with('success', 'Stadium deleted successfully');
    }
}
