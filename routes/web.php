<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Football\FootballController;
use App\Http\Controllers\Netball\NetballController;
use App\Http\Controllers\Basket\BasketController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix'=> 'football','middleware'=>'auth'], function ($football) {
    $football->get('/', [FootballController::class, 'footballDashboard'])->name('home');
    $football->get('Teams', [FootballController::class, 'Teams']);
    $football->any('Team/Create', [FootballController::class, 'CreateTeam']);
    $football->any('Team/Update', [FootballController::class, 'UpdateTeam']);
    $football->get('Team/Delete', [FootballController::class,'DeleteTeam']);

    #tournaments
    $football->get('Tournaments', [FootballController::class,'GetAllTournaments']);
    $football->any('Tournaments/Create', [FootballController::class,'CreateTournament']);
    $football->any('Tournaments/Update', [FootballController::class,'UpdateTournament']);
    $football->get('Tournaments/Delete', [FootballController::class,'DeleteTournament']);

    #coach
    $football->get('Coachers', [FootballController::class,'GetAllCoachers']);
    $football->any('Coacher/Create', [FootballController::class,'CreateCoacher']);
    $football->any('Coacher/Update', [FootballController::class,'UpdateCoacher']);
    $football->get('Coacher/Delete', [FootballController::class,'DeleteCoacher']);

    #players
    $football->get('Players', [FootballController::class,'GetAllPlayers']);
    $football->any('Players/Create', [FootballController::class,'CreatePlayers']);
    $football->any('Players/Update', [FootballController::class,'UpdatePlayers']);
    $football->get('Players/Delete', [FootballController::class,'DeleteCoacher']);

    #games (Fixtures)
    $football->get('Fixtures', [FootballController::class,'GetTeamFixtures']);
    $football->post('Fixtures/Generate', [FootballController::class,'GenerateFixtures']);

    #FootbalTournamentStatistics
    $football->get('Team/Statistics', [FootballController::class,'GetAllTournamentsStatistics']);
    $football->any('Team/Statistics/Create', [FootballController::class,'CreateStatistics']);
    $football->any('Team/Statistics/Update', [FootballController::class,'UpdateStatistics']);
    $football->get('Team/Statistics/Delete', [FootballController::class,'DeleteStatistics']);

    #FootbalTournamentPlayerStatistics
    $football->get('Player/Statistics', [FootballController::class,'GetAllTournamentsPlayerStatistics']);
    $football->any('Player/Statistics/Create', [FootballController::class,'CreatePlayerStatistics']);
    $football->any('Player/Statistics/Update', [FootballController::class,'UpdatePlayerStatistics']);
    $football->get('Player/Statistics/Delete', [FootballController::class,'DeletePlayerStatistics']);
});

Route::group(['prefix'=> 'basketball','middleware'=>'auth'], function ($basket) {
    $basket->get('/', [BasketController::class, 'BasketballDashboard'])->name('basket');
});

Route::group(['prefix'=> 'netball','middleware'=>'auth'], function ($netball) {
    $netball->get('/', [NetballController::class, 'netballDashboard'])->name('netball');
});

Route::group(['prefix'=> 'courses','middleware'=>'auth'], function ($courses) {
    $courses->get('/', [CourseController::class, 'coursesDashboard']);
    $courses->any('create', [CourseController::class, 'coursesCreate']);
    $courses->any('update', [CourseController::class, 'coursesUpdate']);
    $courses->get('delete', [CourseController::class, 'coursesDelete']);
});

Route::group(['prefix'=> 'admins','middleware'=>'auth'], function ($admins) {
    $admins->get('/', [UserController::class, 'adminsDashboard']);
    $admins->any('create', [UserController::class, 'adminsCreate']);
    $admins->any('update', [UserController::class, 'adminsUpdate']);
    $admins->get('delete', [UserController::class, 'adminsDelete']);
});

