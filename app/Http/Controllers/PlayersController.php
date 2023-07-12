<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teams;
use App\Models\Players;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PlayersStoreRequest;
use App\Http\Requests\PlayersUpdateRequest;
use Illuminate\Support\Facades\Hash;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Players::class);

        $search = $request->get('search', '');

        $allPlayers = Players::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_players.index', compact('allPlayers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Players::class);

        $users = User::pluck('name', 'id');
        $allTeams = Teams::pluck('name', 'id');
        $roles = Role::get();

        return view('app.all_players.create', compact('users', 'allTeams', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayersStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Players::class);

        $validated = $request->validated();
        $user = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => validatePhoneNumber($validated['phone']),
            'address' => $validated['address'],
            'maritial_status' => $validated['maritial_status'],
        ];
        $user = User::create($user);
        $user->syncRoles(Role::findByName('player'));

        $player = [
            'user_id' => $user->id,
            'team_id' => $validated['team_id'],
            'jersey_number' => $validated['jersey_number'],
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'age' => $validated['age'],

        ];
        $players = Players::create($player);

        return to_route('all-players.index', $players)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Players $players): View
    {
        $this->authorize('view', $players);

        return view('app.all_players.show', compact('players'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Players $players): View
    {
        $this->authorize('update', $players);

        $user = User::find($players->user_id);
        $allTeams = Teams::pluck('name', 'id');


    //    $test = $players->load(['user', 'teams']);
       


        return view(
            'app.all_players.index',
            compact('players', 'user', 'allTeams')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PlayersUpdateRequest $request,
        Players $players
    ): RedirectResponse {
        $this->authorize('update', $players);

        $validated = $request->validated();

        $players->update($validated);

        return redirect()
            ->route('all-players.edit', $players)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Players $players
    ): RedirectResponse {
        $this->authorize('delete', $players);

        $players->delete();

        return redirect()
            ->route('all-players.index')
            ->withSuccess(__('crud.common.removed'));
    }
}