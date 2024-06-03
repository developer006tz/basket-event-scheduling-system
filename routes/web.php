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

     #VENUES (stadium)
     $football->get('Stadium', [FootballController::class,'getAllStadium']);
     $football->any('Stadium/Create', [FootballController::class,'CreateStadium']);
     $football->any('Stadium/Update', [FootballController::class,'UpdateStadium']);
     $football->any('Stadium/Delete', [FootballController::class,'DeleteStadium']);
});
#TODO NETBALL
Route::group(['prefix'=> 'netball','middleware'=>'auth'], function ($netball) {
    $netball->get('/', [NetballController::class, 'NetballDashboard']);
    $netball->get('Teams', [NetballController::class, 'Teams']);
    $netball->any('Team/Create', [NetballController::class, 'CreateTeam']);
    $netball->any('Team/Update', [NetballController::class, 'UpdateTeam']);
    $netball->get('Team/Delete', [NetballController::class,'DeleteTeam']);

    #tournaments
    $netball->get('Tournaments', [NetballController::class,'GetAllTournaments']);
    $netball->any('Tournaments/Create', [NetballController::class,'CreateTournament']);
    $netball->any('Tournaments/Update', [NetballController::class,'UpdateTournament']);
    $netball->get('Tournaments/Delete', [NetballController::class,'DeleteTournament']);

    #coach
    $netball->get('Coachers', [NetballController::class,'GetAllCoachers']);
    $netball->any('Coacher/Create', [NetballController::class,'CreateCoacher']);
    $netball->any('Coacher/Update', [NetballController::class,'UpdateCoacher']);
    $netball->get('Coacher/Delete', [NetballController::class,'DeleteCoacher']);

    #players
    $netball->get('Players', [NetballController::class,'GetAllPlayers']);
    $netball->any('Players/Create', [NetballController::class,'CreatePlayers']);
    $netball->any('Players/Update', [NetballController::class,'UpdatePlayers']);
    $netball->get('Players/Delete', [NetballController::class,'DeleteCoacher']);

    #games (Fixtures)
    $netball->get('Fixtures', [NetballController::class,'GetTeamFixtures']);
    $netball->post('Fixtures/Generate', [NetballController::class,'GenerateFixtures']);

    #FootbalTournamentStatistics
    $netball->get('Team/Statistics', [NetballController::class,'GetAllTournamentsStatistics']);
    $netball->any('Team/Statistics/Create', [NetballController::class,'CreateStatistics']);
    $netball->any('Team/Statistics/Update', [NetballController::class,'UpdateStatistics']);
    $netball->get('Team/Statistics/Delete', [NetballController::class,'DeleteStatistics']);

    #FootbalTournamentPlayerStatistics
    $netball->get('Player/Statistics', [NetballController::class,'GetAllTournamentsPlayerStatistics']);
    $netball->any('Player/Statistics/Create', [NetballController::class,'CreatePlayerStatistics']);
    $netball->any('Player/Statistics/Update', [NetballController::class,'UpdatePlayerStatistics']);
    $netball->get('Player/Statistics/Delete', [NetballController::class,'DeletePlayerStatistics']);

    #VENUES (stadium)
    $netball->get('Stadium', [NetballController::class,'getAllStadium']);
    $netball->any('Stadium/Create', [NetballController::class,'CreateStadium']);
    $netball->any('Stadium/Update', [NetballController::class,'UpdateStadium']);
    $netball->any('Stadium/Delete', [NetballController::class,'DeleteStadium']);
});

#TODO BASKETBALL
Route::group(['prefix'=> 'basketball','middleware'=>'auth'], function ($basketball) {
    $basketball->get('/', [BasketController::class, 'BasketballDashboard']);
    $basketball->get('Teams', [BasketController::class, 'Teams']);
    $basketball->any('Team/Create', [BasketController::class, 'CreateTeam']);
    $basketball->any('Team/Update', [BasketController::class, 'UpdateTeam']);
    $basketball->get('Team/Delete', [BasketController::class,'DeleteTeam']);

    #tournaments
    $basketball->get('Tournaments', [BasketController::class,'GetAllTournaments']);
    $basketball->any('Tournaments/Create', [BasketController::class,'CreateTournament']);
    $basketball->any('Tournaments/Update', [BasketController::class,'UpdateTournament']);
    $basketball->get('Tournaments/Delete', [BasketController::class,'DeleteTournament']);

    #coach
    $basketball->get('Coachers', [BasketController::class,'GetAllCoachers']);
    $basketball->any('Coacher/Create', [BasketController::class,'CreateCoacher']);
    $basketball->any('Coacher/Update', [BasketController::class,'UpdateCoacher']);
    $basketball->get('Coacher/Delete', [BasketController::class,'DeleteCoacher']);

    #players
    $basketball->get('Players', [BasketController::class,'GetAllPlayers']);
    $basketball->any('Players/Create', [BasketController::class,'CreatePlayers']);
    $basketball->any('Players/Update', [BasketController::class,'UpdatePlayers']);
    $basketball->get('Players/Delete', [BasketController::class,'DeleteCoacher']);

    #games (Fixtures)
    $basketball->get('Fixtures', [BasketController::class,'GetTeamFixtures']);
    $basketball->post('Fixtures/Generate', [BasketController::class,'GenerateFixtures']);

    #FootbalTournamentStatistics
    $basketball->get('Team/Statistics', [BasketController::class,'GetAllTournamentsStatistics']);
    $basketball->any('Team/Statistics/Create', [BasketController::class,'CreateStatistics']);
    $basketball->any('Team/Statistics/Update', [BasketController::class,'UpdateStatistics']);
    $basketball->get('Team/Statistics/Delete', [BasketController::class,'DeleteStatistics']);

    #FootbalTournamentPlayerStatistics
    $basketball->get('Player/Statistics', [BasketController::class,'GetAllTournamentsPlayerStatistics']);
    $basketball->any('Player/Statistics/Create', [BasketController::class,'CreatePlayerStatistics']);
    $basketball->any('Player/Statistics/Update', [BasketController::class,'UpdatePlayerStatistics']);
    $basketball->get('Player/Statistics/Delete', [BasketController::class,'DeletePlayerStatistics']);

    #VENUES (stadium)
    $basketball->get('Stadium', [BasketController::class,'getAllStadium']);
    $basketball->any('Stadium/Create', [BasketController::class,'CreateStadium']);
    $basketball->any('Stadium/Update', [BasketController::class,'UpdateStadium']);
    $basketball->any('Stadium/Delete', [BasketController::class,'DeleteStadium']);
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
    $admins->get('profile', [UserController::class,'adminProfile']);
});

