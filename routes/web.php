<?php

use Illuminate\Support\Facades\Route;

Route::get('.env', function()
{
    return response("
░░░░░▄▀▀▀▄░░░░░░░░░░░░░░░░░<br>
▄███▀░◐░░░▌░░░░░░░░░░░░░░░░<br>
░░░░▌░░░░░▐░░░░░░░░░░░░░░░░<br>
░░░░▐░░░░░▐░░░░░░░░░░░░░░░░<br>
░░░░▌░░░░░▐▄▄░░░░░░░░░░░░░░<br>
░░░░▌░░░░▄▀▒▒▀▀▀▀▄░░░░░░░░░<br>
░░░▐░░░░▐▒▒▒▒▒▒▒▒▀▀▄░░░░░░░<br>
░░░▐░░░░▐▄▒▒▒▒▒▒▒▒▒▒▀▄░░░░░<br>
░░░░▀▄░░░░▀▄▒▒▒▒▒▒▒▒▒▒▀▄░░░<br>
░░░░░░▀▄▄▄▄▄█▄▄▄▄▄▄▄▄▄▄▄▀▄░<br>
░░░░░░░░░░░▌▌░▌▌░░░░░░░░░░░<br>
░░░░░░░░░░░▌▌░▌▌░░░░░░░░░░░<br>
░░░░░░░░░▄▄▌▌▄▌▌░░░░░░░░░░░");
});

Route::get('/', function () {
    return view('guest.pages.main');
});
Route::get('/games', function () {
    return view('guest.pages.games');
})->name('games');
Route::get('/addons', function () {
    return view('guest.pages.addons');
})->name('addons');
Route::get('/news', function () {
    return view('guest.pages.news');
})->name('news');

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/profile/{url}', "ProfileController@view");
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

});
