<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coaches;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CoachesStoreRequest;
use App\Http\Requests\CoachesUpdateRequest;

class CoachesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Coaches::class);

        $search = $request->get('search', '');

        $allCoaches = Coaches::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.all_coaches.index', compact('allCoaches', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Coaches::class);

        $users = User::pluck('name', 'id');

        return view('app.all_coaches.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoachesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Coaches::class);

        $validated = $request->validated();

        $coaches = Coaches::create($validated);

        return redirect()
            ->route('all-coaches.edit', $coaches)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Coaches $coaches): View
    {
        $this->authorize('view', $coaches);

        return view('app.all_coaches.show', compact('coaches'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Coaches $coaches): View
    {
        $this->authorize('update', $coaches);

        $users = User::pluck('name', 'id');

        return view('app.all_coaches.edit', compact('coaches', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CoachesUpdateRequest $request,
        Coaches $coaches
    ): RedirectResponse {
        $this->authorize('update', $coaches);

        $validated = $request->validated();

        $coaches->update($validated);

        return redirect()
            ->route('all-coaches.edit', $coaches)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Coaches $coaches
    ): RedirectResponse {
        $this->authorize('delete', $coaches);

        $coaches->delete();

        return redirect()
            ->route('all-coaches.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
