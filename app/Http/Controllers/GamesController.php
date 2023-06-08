<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Teams;
use App\Models\Coaches;
use App\Models\Practices;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\GamesStoreRequest;
use App\Http\Requests\GamesUpdateRequest;
use Carbon\Carbon;


class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Games::class);

        $search = $request->get('search', '');

        $allGames = Games::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_games.index', compact('allGames', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Games::class);

        return view('app.all_games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GamesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Games::class);

        $validated = $request->validated();

        $games = Games::create($validated);

        return redirect()
            ->route('all-games.edit', $games)
            ->withSuccess(__('crud.common.created'));
    }

    public function generate_games(Request $request): RedirectResponse
    {
        $this->authorize('create', Games::class);

        // Get all teams
        $teams = Teams::all();

        // Generate bracket structure 
        $bracket = [
            [1 => null, 2 => null],
            [3 => null, 4 => null]
        ];

        // Randomly assign teams to bracket 
        for ($i = 0; $i < count($teams); $i++) {
            $bracket[$i % 2][$i % 2 == 0 ? 1 : 2] = $teams[$i];
        }

        // Set game dates, spacing by 3 days 
        $gameDates = [];
        for ($i = 0; $i < count($bracket) - 1; $i++) {
            $gameDates[] = Carbon::now()->addDays(3 * $i)->format('Y-m-d');
        }

       
        // For each game date, set start time and save to Games table 
        foreach ($gameDates as $date) {
            $homeTeam = $bracket[0][1] ?? $bracket[1][1];
            $awayTeam = $bracket[0][2] ?? $bracket[1][2];

            Games::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'location' => $homeTeam->location,
                'date' => $date,
                'start_time' => Carbon::now()->addHours(rand(1, 5))->format('H:i:s')
            ]);

        }

        // Schedule practices in between game dates for each team 
        foreach ($teams as $team) {
            for ($i = 0; $i < count($gameDates) - 1; $i++) {
                $practiceDate = Carbon::parse($gameDates[$i])->addDay()->format('Y-m-d');
                Practices::create([
                    'team_id' => $team->id,
                    'location' => $team->location,
                    'date' => $practiceDate,
                    'start_time' => '18:00:00',
                    'end_time' => '20:00:00'
                ]);
            }
        }

        // Send notifications for games and practices 
        // ...

        return redirect()
            ->route('all-games.index')
            ->withSuccess(__('crud.common.created'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, Games $games): View
    {
        $this->authorize('view', $games);

        return view('app.all_games.show', compact('games'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Games $games): View
    {
        $this->authorize('update', $games);

        return view('app.all_games.edit', compact('games'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        GamesUpdateRequest $request,
        Games $games
    ): RedirectResponse {
        $this->authorize('update', $games);

        $validated = $request->validated();

        $games->update($validated);

        return redirect()
            ->route('all-games.edit', $games)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Games $games): RedirectResponse
    {
        $this->authorize('delete', $games);

        $games->delete();

        return redirect()
            ->route('all-games.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
