<?php

namespace App\Http\Controllers;

use App\Models\Games;
use App\Models\Players;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\EventStatistics;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EventStatisticsStoreRequest;
use App\Http\Requests\EventStatisticsUpdateRequest;

class EventStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', EventStatistics::class);

        $search = $request->get('search', '');

        $allEventStatistics = EventStatistics::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_event_statistics.index',
            compact('allEventStatistics', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', EventStatistics::class);

        $allGames = Games::pluck('location', 'id');
        $allPlayers = Players::pluck('id', 'id');

        return view(
            'app.all_event_statistics.create',
            compact('allGames', 'allPlayers')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        EventStatisticsStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', EventStatistics::class);

        $validated = $request->validated();

        $eventStatistics = EventStatistics::create($validated);

        return redirect()
            ->route('all-event-statistics.edit', $eventStatistics)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        EventStatistics $eventStatistics
    ): View {
        $this->authorize('view', $eventStatistics);

        return view(
            'app.all_event_statistics.show',
            compact('eventStatistics')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        EventStatistics $eventStatistics
    ): View {
        $this->authorize('update', $eventStatistics);

        $allGames = Games::pluck('location', 'id');
        $allPlayers = Players::pluck('id', 'id');

        return view(
            'app.all_event_statistics.edit',
            compact('eventStatistics', 'allGames', 'allPlayers')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EventStatisticsUpdateRequest $request,
        EventStatistics $eventStatistics
    ): RedirectResponse {
        $this->authorize('update', $eventStatistics);

        $validated = $request->validated();

        $eventStatistics->update($validated);

        return redirect()
            ->route('all-event-statistics.edit', $eventStatistics)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        EventStatistics $eventStatistics
    ): RedirectResponse {
        $this->authorize('delete', $eventStatistics);

        $eventStatistics->delete();

        return redirect()
            ->route('all-event-statistics.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
