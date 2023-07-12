<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\EventTypes;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EventTypesStoreRequest;
use App\Http\Requests\EventTypesUpdateRequest;


class EventTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', EventTypes::class);

        $search = $request->get('search', '');

        $allEventTypes = EventTypes::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_event_types.index',
            compact('allEventTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', EventTypes::class);

        return view('app.all_event_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventTypesStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', EventTypes::class);

        $validated = $request->validated();

        $eventTypes = EventTypes::create($validated);

        return redirect()
            ->route('all-event-types.edit', $eventTypes)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, EventTypes $eventTypes): View
    {
        $this->authorize('view', $eventTypes);

        return view('app.all_event_types.show', compact('eventTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, EventTypes $eventTypes): View
    {
        $this->authorize('update', $eventTypes);

        return view('app.all_event_types.edit', compact('eventTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EventTypesUpdateRequest $request,
        EventTypes $eventTypes
    ): RedirectResponse {
        $this->authorize('update', $eventTypes);

        $validated = $request->validated();

        $eventTypes->update($validated);

        return redirect()
            ->route('all-event-types.edit', $eventTypes)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        EventTypes $eventTypes
    ): RedirectResponse {
        $this->authorize('delete', $eventTypes);

        $eventTypes->delete();

        return redirect()
            ->route('all-event-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
