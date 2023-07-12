<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\CoachesController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\PracticesController;
use App\Http\Controllers\EventTypesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\EventStatisticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::get('all-teams', [TeamsController::class, 'index'])->name(
            'all-teams.index'
        );
        Route::post('all-teams', [TeamsController::class, 'store'])->name(
            'all-teams.store'
        );
        Route::get('all-teams/create', [
            TeamsController::class,
            'create',
        ])->name('all-teams.create');
        Route::get('all-teams/{teams}', [TeamsController::class, 'show'])->name(
            'all-teams.show'
        );
        Route::get('all-teams/{teams}/edit', [
            TeamsController::class,
            'edit',
        ])->name('all-teams.edit');
        Route::put('all-teams/{teams}', [
            TeamsController::class,
            'update',
        ])->name('all-teams.update');
        Route::delete('all-teams/{teams}', [
            TeamsController::class,
            'destroy',
        ])->name('all-teams.destroy');

        Route::get('all-coaches', [CoachesController::class, 'index'])->name(
            'all-coaches.index'
        );
        Route::post('all-coaches', [CoachesController::class, 'store'])->name(
            'all-coaches.store'
        );
        Route::get('all-coaches/create', [
            CoachesController::class,
            'create',
        ])->name('all-coaches.create');
        Route::get('all-coaches/{coaches}', [
            CoachesController::class,
            'show',
        ])->name('all-coaches.show');
        Route::get('all-coaches/{coaches}/edit', [
            CoachesController::class,
            'edit',
        ])->name('all-coaches.edit');
        Route::put('all-coaches/{coaches}', [
            CoachesController::class,
            'update',
        ])->name('all-coaches.update');
        Route::delete('all-coaches/{coaches}', [
            CoachesController::class,
            'destroy',
        ])->name('all-coaches.destroy');

        Route::get('all-players', [PlayersController::class, 'index'])->name(
            'all-players.index'
        );
        Route::post('all-players', [PlayersController::class, 'store'])->name(
            'all-players.store'
        );
        Route::get('all-players/create', [
            PlayersController::class,
            'create',
        ])->name('all-players.create');
        Route::get('all-players/{players}', [
            PlayersController::class,
            'show',
        ])->name('all-players.show');
        Route::get('all-players/{players}/edit', [
            PlayersController::class,
            'edit',
        ])->name('all-players.edit');
        Route::put('all-players/{players}', [
            PlayersController::class,
            'update',
        ])->name('all-players.update');
        Route::delete('all-players/{players}', [
            PlayersController::class,
            'destroy',
        ])->name('all-players.destroy');

        Route::get('all-games', [GamesController::class, 'index'])->name(
            'all-games.index'
        );
        Route::post('all-games', [GamesController::class, 'store'])->name(
            'all-games.store'
        );

    Route::post('all-games', [GamesController::class, 'generate_games'])->name(
        'all-games.generate'
    );
    
        Route::get('all-games/create', [
            GamesController::class,
            'create',
        ])->name('all-games.create');

        Route::get('all-games/{games}', [GamesController::class, 'show'])->name(
            'all-games.show'
        );
        Route::get('all-games/{games}/edit', [
            GamesController::class,
            'edit',
        ])->name('all-games.edit');
        Route::put('all-games/{games}', [
            GamesController::class,
            'update',
        ])->name('all-games.update');
        Route::delete('all-games/{games}', [
            GamesController::class,
            'destroy',
        ])->name('all-games.destroy');

        Route::get('all-practices', [
            PracticesController::class,
            'index',
        ])->name('all-practices.index');
        Route::post('all-practices', [
            PracticesController::class,
            'store',
        ])->name('all-practices.store');
        Route::get('all-practices/create', [
            PracticesController::class,
            'create',
        ])->name('all-practices.create');
        Route::get('all-practices/{practices}', [
            PracticesController::class,
            'show',
        ])->name('all-practices.show');
        Route::get('all-practices/{practices}/edit', [
            PracticesController::class,
            'edit',
        ])->name('all-practices.edit');
        Route::put('all-practices/{practices}', [
            PracticesController::class,
            'update',
        ])->name('all-practices.update');
        Route::delete('all-practices/{practices}', [
            PracticesController::class,
            'destroy',
        ])->name('all-practices.destroy');

        Route::get('all-event-types', [
            EventTypesController::class,
            'index',
        ])->name('all-event-types.index');
        Route::post('all-event-types', [
            EventTypesController::class,
            'store',
        ])->name('all-event-types.store');
        Route::get('all-event-types/create', [
            EventTypesController::class,
            'create',
        ])->name('all-event-types.create');
        Route::get('all-event-types/{eventTypes}', [
            EventTypesController::class,
            'show',
        ])->name('all-event-types.show');
        Route::get('all-event-types/{eventTypes}/edit', [
            EventTypesController::class,
            'edit',
        ])->name('all-event-types.edit');
        Route::put('all-event-types/{eventTypes}', [
            EventTypesController::class,
            'update',
        ])->name('all-event-types.update');
        Route::delete('all-event-types/{eventTypes}', [
            EventTypesController::class,
            'destroy',
        ])->name('all-event-types.destroy');

        Route::get('all-notifications', [
            NotificationsController::class,
            'index',
        ])->name('all-notifications.index');
        Route::post('all-notifications', [
            NotificationsController::class,
            'store',
        ])->name('all-notifications.store');
        Route::get('all-notifications/create', [
            NotificationsController::class,
            'create',
        ])->name('all-notifications.create');
        Route::get('all-notifications/{notifications}', [
            NotificationsController::class,
            'show',
        ])->name('all-notifications.show');
        Route::get('all-notifications/{notifications}/edit', [
            NotificationsController::class,
            'edit',
        ])->name('all-notifications.edit');
        Route::put('all-notifications/{notifications}', [
            NotificationsController::class,
            'update',
        ])->name('all-notifications.update');
        Route::delete('all-notifications/{notifications}', [
            NotificationsController::class,
            'destroy',
        ])->name('all-notifications.destroy');

        Route::get('all-event-statistics', [
            EventStatisticsController::class,
            'index',
        ])->name('all-event-statistics.index');
        Route::post('all-event-statistics', [
            EventStatisticsController::class,
            'store',
        ])->name('all-event-statistics.store');
        Route::get('all-event-statistics/create', [
            EventStatisticsController::class,
            'create',
        ])->name('all-event-statistics.create');
        Route::get('all-event-statistics/{eventStatistics}', [
            EventStatisticsController::class,
            'show',
        ])->name('all-event-statistics.show');
        Route::get('all-event-statistics/{eventStatistics}/edit', [
            EventStatisticsController::class,
            'edit',
        ])->name('all-event-statistics.edit');
        Route::put('all-event-statistics/{eventStatistics}', [
            EventStatisticsController::class,
            'update',
        ])->name('all-event-statistics.update');
        Route::delete('all-event-statistics/{eventStatistics}', [
            EventStatisticsController::class,
            'destroy',
        ])->name('all-event-statistics.destroy');

        Route::get('users', [UserController::class, 'index'])->name(
            'users.index'
        );
        Route::post('users', [UserController::class, 'store'])->name(
            'users.store'
        );
        Route::get('users/create', [UserController::class, 'create'])->name(
            'users.create'
        );
        Route::get('users/{user}', [UserController::class, 'show'])->name(
            'users.show'
        );
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name(
            'users.edit'
        );
        Route::put('users/{user}', [UserController::class, 'update'])->name(
            'users.update'
        );
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name(
            'users.destroy'
        );
    });
