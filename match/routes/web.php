<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantsController;

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
    return view('welcome');
});


Route::get('etudiants/create', 'EtudiantsController@create')->name('etudiants.create');


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/', 'AdminUsersController@index')->name('index');
            Route::get('/create', 'AdminUsersController@create')->name('create');
            Route::post('/', 'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login', 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit', 'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}', 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}', 'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation', 'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('fillieres')->name('fillieres/')->group(static function() {
            Route::get('/', 'FillieresController@index')->name('index');
            Route::get('/create', 'FillieresController@create')->name('create');
            Route::post('/', 'FillieresController@store')->name('store');
            Route::get('/{filliere}/edit', 'FillieresController@edit')->name('edit');
            Route::post('/bulk-destroy', 'FillieresController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{filliere}', 'FillieresController@update')->name('update');
            Route::delete('/{filliere}', 'FillieresController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('plats')->name('plats/')->group(static function() {
            Route::get('/', 'PlatsController@index')->name('index');
            Route::get('/create', 'PlatsController@create')->name('create');
            Route::post('/', 'PlatsController@store')->name('store');
            Route::get('/{plat}/edit', 'PlatsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'PlatsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{plat}', 'PlatsController@update')->name('update');
            Route::delete('/{plat}', 'PlatsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('couleurs')->name('couleurs/')->group(static function() {
            Route::get('/', 'CouleursController@index')->name('index');
            Route::get('/create', 'CouleursController@create')->name('create');
            Route::post('/', 'CouleursController@store')->name('store');
            Route::get('/{couleur}/edit', 'CouleursController@edit')->name('edit');
            Route::post('/bulk-destroy', 'CouleursController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{couleur}', 'CouleursController@update')->name('update');
            Route::delete('/{couleur}', 'CouleursController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('animals')->name('animals/')->group(static function() {
            Route::get('/', 'AnimalsController@index')->name('index');
            Route::get('/create', 'AnimalsController@create')->name('create');
            Route::post('/', 'AnimalsController@store')->name('store');
            Route::get('/{animal}/edit', 'AnimalsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'AnimalsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{animal}', 'AnimalsController@update')->name('update');
            Route::delete('/{animal}', 'AnimalsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('parrains')->name('parrains/')->group(static function() {
            Route::get('/', 'ParrainsController@index')->name('index');
            Route::get('/create', 'ParrainsController@create')->name('create');
            Route::post('/', 'ParrainsController@store')->name('store');
            Route::get('/{animal}/edit', 'ParrainsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ParrainsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{animal}', 'ParrainsController@update')->name('update');
            Route::delete('/{animal}', 'ParrainsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('etudiants')->name('etudiants/')->group(static function() {
            Route::get('/', 'EtudiantsController@index')->name('index');
            Route::get('/{etudiant}/edit', 'EtudiantsController@edit')->name('edit');
            Route::post('/bulk-destroy', 'EtudiantsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{etudiant}', 'EtudiantsController@update')->name('update');
            Route::delete('/{etudiant}', 'EtudiantsController@destroy')->name('destroy');
            Route::get('/create', 'EtudiantsController@create')->name('create');
            Route::post('/', 'EtudiantsController@store')->name('store');
        });
    });
});


Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('match')->name('match/')->group(static function() {
            Route::get('/index', 'MatchController@index')->name('index');
            Route::get('/match', 'MatchController@match')->name('match');
            Route::get('/matchup', 'MatchController@matchup')->name('matchup');
            Route::get('/download', 'MatchController@download')->name('download');
        });
    });
});