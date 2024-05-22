<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Coaches;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TeamsStoreRequest;
use App\Http\Requests\TeamsUpdateRequest;
use Intervention\Image\Facades\Image;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Teams::class);

        $search = $request->get('search', '');

        $allTeams = Teams::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_teams.index', compact('allTeams', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Teams::class);

        $allCoaches = Coaches::join('users', 'users.id', '=', 'coaches.user_id')->pluck('users.name', 'coaches.id');

        return view('app.all_teams.create', compact('allCoaches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Teams::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $teams = Teams::create($validated);

        return redirect()
            ->route('all-teams.index', $teams)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Teams $teams): View
    {
        $this->authorize('view', $teams);

        return view('app.all_teams.show', compact('teams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Teams $teams): View
    {
        $this->authorize('update', $teams);

        $allCoaches = Coaches::join('users', 'users.id', '=', 'coaches.user_id')->pluck('users.name', 'coaches.id');

        return view('app.all_teams.edit', compact('teams', 'allCoaches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TeamsUpdateRequest $request,
        Teams $teams
    ): RedirectResponse {
        $this->authorize('update', $teams);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($teams->image) {
                Storage::delete($teams->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $teams->update($validated);

        return redirect()
            ->route('all-teams.index', $teams)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Teams $teams): RedirectResponse
    {
        $this->authorize('delete', $teams);

        if ($teams->image) {
            Storage::delete($teams->image);
        }

        $teams->delete();

        return redirect()
            ->route('all-teams.index')
            ->withSuccess(__('crud.common.removed'));
    }
}