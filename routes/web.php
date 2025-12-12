<?php

use Illuminate\Support\Facades\Route;
use Vista\Http\Controllers\VistaDashboardController;

/*
|--------------------------------------------------------------------------
| Vista Routes
|--------------------------------------------------------------------------
|
| These routes expose the Vista dashboard and its internal API. The path
| and middleware are configurable via `config/vista.php`.
|
*/

Route::group([
    'domain' => config('vista.domain'),
    'prefix' => config('vista.path'),
    'middleware' => config('vista.middleware', ['web']),
], function () {
    Route::get('/', [VistaDashboardController::class, 'index']);
    Route::get('/api/tasks', [VistaDashboardController::class, 'tasks']);
    Route::post('/api/tasks/{id}/run', [VistaDashboardController::class, 'run']);
    Route::post('/api/tasks/{id}/enable', [VistaDashboardController::class, 'enable']);
    Route::post('/api/tasks/{id}/disable', [VistaDashboardController::class, 'disable']);
    Route::post('/api/tasks/{id}/retry', [VistaDashboardController::class, 'retry']);
});
