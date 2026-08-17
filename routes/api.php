<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'config-status'], function () {
    Route::post('/update-position', 'GitScrum\Http\Controllers\Web\ConfigStatusController@updatePosition')->name('api.configStatus.position.update');
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('issues', [GitScrum\Http\Controllers\Api\IssueController::class, 'index'])->name('api.v1.issues.index');
    Route::get('issues/{issue:slug}', [GitScrum\Http\Controllers\Api\IssueController::class, 'show'])->name('api.v1.issues.show');
    Route::post('issues', [GitScrum\Http\Controllers\Api\IssueController::class, 'store'])->name('api.v1.issues.store');
    Route::put('issues/{issue:slug}', [GitScrum\Http\Controllers\Api\IssueController::class, 'update'])->name('api.v1.issues.update');
});
