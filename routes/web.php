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

Route::group(['prefix'=> 'football'], function ($football) {
    $football->get('/', [FootballController::class, 'footballDashboard'])->name('home');
    $football->get('Teams', [FootballController::class, 'Teams']);
    $football->any('Team/Create', [FootballController::class, 'CreateTeam']);
});

Route::group(['prefix'=> 'basketball'], function ($basket) {
    $basket->get('/', [BasketController::class, 'BasketballDashboard'])->name('basket');
});

Route::group(['prefix'=> 'netball'], function ($netball) {
    $netball->get('/', [NetballController::class, 'netballDashboard'])->name('netball');
});

Route::group(['prefix'=> 'courses'], function ($courses) {
    $courses->get('/', [CourseController::class, 'coursesDashboard'])->name('courses');
});

Route::group(['prefix'=> 'admins'], function ($admins) {
    $admins->get('/', [UserController::class, 'adminsDashboard'])->name('admins');
});

