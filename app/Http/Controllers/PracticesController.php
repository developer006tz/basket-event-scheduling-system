<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Models\Practices;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PracticesStoreRequest;
use App\Http\Requests\PracticesUpdateRequest;

class PracticesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Practices::class);

        $search = $request->get('search', '');

        $allPractices = Practices::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_practices.index',
            compact('allPractices', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Practices::class);

        $allTeams = Teams::pluck('name', 'id');

        return view('app.all_practices.create', compact('allTeams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PracticesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Practices::class);

        $validated = $request->validated();

        $practices = Practices::create($validated);

        return redirect()
            ->route('all-practices.edit', $practices)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Practices $practices): View
    {
        $this->authorize('view', $practices);

        return view('app.all_practices.show', compact('practices'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Practices $practices): View
    {
        $this->authorize('update', $practices);

        $allTeams = Teams::pluck('name', 'id');

        return view('app.all_practices.edit', compact('practices', 'allTeams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PracticesUpdateRequest $request,
        Practices $practices
    ): RedirectResponse {
        $this->authorize('update', $practices);

        $validated = $request->validated();

        $practices->update($validated);

        return redirect()
            ->route('all-practices.edit', $practices)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Practices $practices
    ): RedirectResponse {
        $this->authorize('delete', $practices);

        $practices->delete();

        return redirect()
            ->route('all-practices.index')
            ->withSuccess(__('crud.common.removed'));
    }
}