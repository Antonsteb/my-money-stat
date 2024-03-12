<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\MyPayments\PaymentsController;
use App\Http\Controllers\MyPayments\PaymentsFilesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Statistics\StatisticsController;
use App\Http\Resources\ChartResource;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('statistics')->name('statistics.')->group(function () {
        Route::get('/', [StatisticsController::class, 'charts'])->name('charts');
    });
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentsController::class, 'list'])->name('list');
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::any('/', [CategoriesController::class, 'list'])->name('list');
    });

    Route::prefix('my-files')->name('my-files.')->group(function () {
        Route::any('/', [PaymentsFilesController::class, 'list'])->name('list');
    });
});



Route::get('/test', function () {
    $user = \App\Models\User::query()->first();
    $charts = $user->charts()->with('categories')->get();
    dd(json_decode(ChartResource::collection($charts)->toJson()));


});

require __DIR__.'/auth.php';
