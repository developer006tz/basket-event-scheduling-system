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

});

Route::group(['prefix'=> 'basketball','middleware'=>'auth'], function ($basket) {
    $basket->get('/', [BasketController::class, 'BasketballDashboard'])->name('basket');
});

Route::group(['prefix'=> 'netball','middleware'=>'auth'], function ($netball) {
    $netball->get('/', [NetballController::class, 'netballDashboard'])->name('netball');
});

Route::group(['prefix'=> 'courses','middleware'=>'auth'], function ($courses) {
    $courses->get('/', [CourseController::class, 'coursesDashboard'])->name('courses');
});

Route::group(['prefix'=> 'admins','middleware'=>'auth'], function ($admins) {
    $admins->get('/', [UserController::class, 'adminsDashboard'])->name('admins');
});

