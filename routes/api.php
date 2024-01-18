<?php

use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\MyPayments\PaymentsController;
use App\Http\Controllers\MyPayments\PaymentsFilesController;
use App\Http\Controllers\Statistics\ChartsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth')->group(function () {

    Route::prefix('payments')->name('payments.')->group(function () {
        Route::post('/set-category', [PaymentsController::class, 'setCategory'])->name('set-category');
    });
    Route::prefix('my-files')->name('my-files.')->group(function () {
        Route::any('/add', [PaymentsFilesController::class, 'add'])->name('add');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::post('/add', [CategoriesController::class, 'add'])->name('add');
        Route::get('/all', [CategoriesController::class, 'all'])->name('all');
    });
    Route::prefix('charts')->name('charts.')->group(function () {
        Route::post('/add', [ChartsController::class, 'add'])->name('add');
        Route::patch('/{chart}/position', [ChartsController::class, 'updatePosition'])->name('update-position');
        Route::patch('/{chart}/size', [ChartsController::class, 'updateSize'])->name('update-size');
    });

});
Route::prefix('charts')->name('charts.')->group(function () {
    Route::prefix('params')->name('params.')->group(function () {

        Route::get('/types', [ChartsController::class, 'types'])->name('types');
        Route::get('/intervals', [ChartsController::class, 'intervals'])->name('intervals');
    });
});
