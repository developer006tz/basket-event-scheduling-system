<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Practices;
use App\Models\EventTypes;
use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\NotificationsStoreRequest;
use App\Http\Requests\NotificationsUpdateRequest;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Notifications::class);

        $search = $request->get('search', '');

        $allNotifications = Notifications::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_notifications.index',
            compact('allNotifications', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Notifications::class);

        $allGames = Games::pluck('location', 'id');
        $allPractices = Practices::pluck('location', 'id');
        $allEventTypes = EventTypes::pluck('name', 'id');

        return view(
            'app.all_notifications.create',
            compact('allGames', 'allPractices', 'allEventTypes')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationsStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Notifications::class);

        $validated = $request->validated();

        $notifications = Notifications::create($validated);

        return redirect()
            ->route('all-notifications.edit', $notifications)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Notifications $notifications): View
    {
        $this->authorize('view', $notifications);

        return view('app.all_notifications.show', compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Notifications $notifications): View
    {
        $this->authorize('update', $notifications);

        $allGames = Games::pluck('location', 'id');
        $allPractices = Practices::pluck('location', 'id');
        $allEventTypes = EventTypes::pluck('name', 'id');

        return view(
            'app.all_notifications.edit',
            compact(
                'notifications',
                'allGames',
                'allPractices',
                'allEventTypes'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        NotificationsUpdateRequest $request,
        Notifications $notifications
    ): RedirectResponse {
        $this->authorize('update', $notifications);

        $validated = $request->validated();

        $notifications->update($validated);

        return redirect()
            ->route('all-notifications.edit', $notifications)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Notifications $notifications
    ): RedirectResponse {
        $this->authorize('delete', $notifications);

        $notifications->delete();

        return redirect()
            ->route('all-notifications.index')
            ->withSuccess(__('crud.common.removed'));
    }
}