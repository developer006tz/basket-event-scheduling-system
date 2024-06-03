<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   /* public function generate_games(Request $request): RedirectResponse
    {

        // Get all teams
        $teams = Teams::all();

        // Generate all possible matchups between teams
        $matchups = [];
        foreach ($teams as $homeTeam) {
            foreach ($teams as $awayTeam) {
                if ($homeTeam->id != $awayTeam->id) {
                    $matchups[] = [$homeTeam, $awayTeam];
                }
            }
        }

        // Set game dates, spacing by 3 days 
        $gameDates = [];
        for ($i = 0; $i < count($matchups); $i++) {
            $gameDates[] = Carbon::now()->addDays(3 * $i)->format('Y-m-d');
        }

        // For each matchup, schedule two games (home and away)
        foreach ($matchups as $i => $matchup) {
            list($homeTeam, $awayTeam) = $matchup;

            // Schedule home game
            Games::create([
                'home_team_id' => $homeTeam->id,
                'away_team_id' => $awayTeam->id,
                'location' => $homeTeam->location,
                'date' => $gameDates[$i],
                'start_time' => Carbon::now()->addHours(rand(1, 5))->format('H:i:s')
            ]);

            // Schedule away game
            Games::create([
                'home_team_id' => $awayTeam->id,
                'away_team_id' => $homeTeam->id,
                'location' => $awayTeam->location,
                'date' => Carbon::parse($gameDates[$i])->addDays(3)->format('Y-m-d'),
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
    }*/
}
