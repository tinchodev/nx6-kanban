<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
    return redirect()->route('auth.login');
})->name('home');

Route::get('/dashboard', 'GitScrum\Http\Controllers\Web\UserController@dashboard')->name('user.dashboard')->middleware('user.authenticated', 'product-backlog');
Route::get('/profile/{username}', 'GitScrum\Http\Controllers\Web\UserController@show')->name('user.profile')->middleware('user.authenticated');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/register', 'GitScrum\Http\Controllers\Web\AuthController@register')->name('auth.register');
    Route::get('/login', 'GitScrum\Http\Controllers\Web\AuthController@login')->name('auth.login');
    Route::get('/dologin', 'GitScrum\Http\Controllers\Web\AuthController@dologin')->name('auth.dologin');
    Route::get('/provider/{provider}', 'GitScrum\Http\Controllers\Web\AuthController@redirectToProvider')->name('auth.provider');
    Route::get('/provider/{provider}/callback', 'GitScrum\Http\Controllers\Web\AuthController@handleProviderCallback');
    Route::post('/provider/gitea/token', 'GitScrum\Http\Controllers\Web\AuthGiteaController@handleProviderCallback')->name('auth.gitea');
    Route::get('/logout', 'GitScrum\Http\Controllers\Web\AuthController@logout')->name('auth.logout');
});

Route::group(['prefix' => 'product-backlogs', 'middleware' => ['user.authenticated']], function () {
    Route::get('/list/{mode?}', 'GitScrum\Http\Controllers\Web\ProductBacklogController@index')->name('product_backlogs.index');
    Route::get('/show/{slug}', 'GitScrum\Http\Controllers\Web\ProductBacklogController@show')->name('product_backlogs.show');
    Route::get('/create', 'GitScrum\Http\Controllers\Web\ProductBacklogController@create')->name('product_backlogs.create');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\ProductBacklogController@store')->name('product_backlogs.store');
    Route::get('/edit/{slug}', 'GitScrum\Http\Controllers\Web\ProductBacklogController@edit')->name('product_backlogs.edit');
    Route::post('/update/{slug}', 'GitScrum\Http\Controllers\Web\ProductBacklogController@update')->name('product_backlogs.update');
});

Route::group(['prefix' => 'sprints', 'middleware' => ['user.authenticated', 'sprint.expired', 'global.activities']], function () {
    Route::get('/planning/{slug}/issues', 'GitScrum\Http\Controllers\Web\IssueController@index')->name('issues.index');
    Route::get('/list/{mode?}/{slug_product_backlog?}', 'GitScrum\Http\Controllers\Web\SprintController@index')->name('sprints.index');
    Route::get('/show/{slug}', 'GitScrum\Http\Controllers\Web\SprintController@show')->name('sprints.show');
    Route::get('/create/{slug_product_backlog?}', 'GitScrum\Http\Controllers\Web\SprintController@create')->name('sprints.create');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\SprintController@store')->name('sprints.store');
    Route::get('/edit/{slug}', 'GitScrum\Http\Controllers\Web\SprintController@edit')->name('sprints.edit');
    Route::post('/update/{slug}', 'GitScrum\Http\Controllers\Web\SprintController@update')->name('sprints.update');
    Route::delete('/destroy', 'GitScrum\Http\Controllers\Web\SprintController@destroy')->name('sprints.destroy');
    Route::any('/status-update/{slug?}/{status?}', 'GitScrum\Http\Controllers\Web\SprintController@statusUpdate')->name('sprints.status.update');
});

Route::group(['prefix' => 'user-stories', 'middleware' => ['user.authenticated']], function () {
    Route::get('/list', 'GitScrum\Http\Controllers\Web\UserStoryController@index')->name('user_stories.index');
    Route::get('/show/{slug}', 'GitScrum\Http\Controllers\Web\UserStoryController@show')->name('user_stories.show');
    Route::get('/create/{slug_product_backlog?}', 'GitScrum\Http\Controllers\Web\UserStoryController@create')->name('user_stories.create');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\UserStoryController@store')->name('user_stories.store');
    Route::get('/edit/{slug}', 'GitScrum\Http\Controllers\Web\UserStoryController@edit')->name('user_stories.edit');
    Route::delete('/destroy', 'GitScrum\Http\Controllers\Web\UserStoryController@destroy')->name('user_stories.destroy');
    Route::post('/update/{slug}', 'GitScrum\Http\Controllers\Web\UserStoryController@update')->name('user_stories.update');
});

Route::group(['prefix' => 'issues', 'middleware' => ['user.authenticated', 'issue']], function () {
    Route::get('/show/{slug}', 'GitScrum\Http\Controllers\Web\IssueController@show')->name('issues.show');
    Route::get('/create/{scope}/{slug}/{parent_id?}', 'GitScrum\Http\Controllers\Web\IssueController@create')->name('issues.create');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\IssueController@store')->name('issues.store');
    Route::get('/edit/{slug}', 'GitScrum\Http\Controllers\Web\IssueController@edit')->name('issues.edit');
    Route::post('/update/{slug}', 'GitScrum\Http\Controllers\Web\IssueController@update')->name('issues.update');
    Route::delete('/destroy', 'GitScrum\Http\Controllers\Web\IssueController@destroy')->name('issues.destroy');
    Route::any('/status-update/{slug?}/{status?}', 'GitScrum\Http\Controllers\Web\IssueController@statusUpdate')->name('issues.status.update');
});

Route::group(['prefix' => 'user-issue', 'middleware' => ['user.authenticated']], function () {
    Route::get('/list/{username}/{slug_type?}/{mode?}', 'GitScrum\Http\Controllers\Web\UserIssueController@index')->name('user_issue.index');
    Route::post('/update/{slug}', 'GitScrum\Http\Controllers\Web\UserIssueController@update')->name('user_issue.update');
});

Route::group(['prefix' => 'issue-types', 'middleware' => ['user.authenticated']], function () {
    Route::get('/sprint/{slug_sprint}/{slug_type?}', 'GitScrum\Http\Controllers\Web\IssueTypeController@index')->name('issue_types.index');
});

Route::group(['prefix' => 'commits', 'middleware' => ['user.authenticated']], function () {
    Route::get('/show/{sha}', 'GitScrum\Http\Controllers\Web\CommitController@show')->name('commits.show');
});

Route::group(['prefix' => 'notes', 'middleware' => ['user.authenticated']], function () {
    Route::get('/--------', 'GitScrum\Http\Controllers\Web\NoteController@store')->name('notes.show');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\NoteController@store')->name('notes.store');
    Route::get('/update/{slug}', 'GitScrum\Http\Controllers\Web\NoteController@update')->name('notes.update');
    Route::get('/destroy/{id}', 'GitScrum\Http\Controllers\Web\NoteController@destroy')->name('notes.destroy');
});

Route::group(['prefix' => 'comments', 'middleware' => ['user.authenticated']], function () {
    Route::get('/--------', 'GitScrum\Http\Controllers\Web\CommentController@store')->name('comments.show');
    Route::get('/edit/{id}', 'GitScrum\Http\Controllers\Web\CommentController@edit')->name('comments.edit');
    Route::post('/update/{id}', 'GitScrum\Http\Controllers\Web\CommentController@update')->name('comments.update');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\CommentController@store')->name('comments.store');
    Route::get('/destroy/{id}', 'GitScrum\Http\Controllers\Web\CommentController@destroy')->name('comments.destroy');
});

Route::group(['prefix' => 'labels', 'middleware' => ['user.authenticated']], function () {
    Route::get('/--------', 'GitScrum\Http\Controllers\Web\LabelController@store')->name('labels.show');
    Route::get('/{model}/{slug_label?}', 'GitScrum\Http\Controllers\Web\LabelController@index')->name('labels.index');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\LabelController@store')->name('labels.store');
});

Route::group(['prefix' => 'favorites', 'middleware' => ['user.authenticated']], function () {
    Route::get('/store/{type}/{id}', 'GitScrum\Http\Controllers\Web\FavoriteController@store')->name('favorites.store');
    Route::get('/destroy/{type}/{id}', 'GitScrum\Http\Controllers\Web\FavoriteController@destroy')->name('favorites.destroy');
});

Route::group(['prefix' => 'attachments'], function () {
    Route::get('/--------', 'GitScrum\Http\Controllers\Web\AttachmentController@store')->name('attachments.show');
    Route::post('/store', 'GitScrum\Http\Controllers\Web\AttachmentController@store')->name('attachments.store');
});

Route::group(['prefix' => 'teams', 'middleware' => ['user.authenticated']], function () {
    Route::get('/members', 'GitScrum\Http\Controllers\Web\TeamController@index')->name('team.index');
});

Route::group(['prefix' => 'wizard', 'middleware' => ['user.authenticated']], function () {
    Route::get('/install', 'GitScrum\Http\Controllers\Web\WizardController@install')->name('wizard.install');
    Route::get('/step1', 'GitScrum\Http\Controllers\Web\WizardController@step1')->name('wizard.step1');
    Route::any('/step2', 'GitScrum\Http\Controllers\Web\WizardController@step2')->name('wizard.step2');
    Route::get('/step3', 'GitScrum\Http\Controllers\Web\WizardController@step3')->name('wizard.step3');
});

Route::put('/slack', 'GitScrum\Http\Controllers\Web\SlackUserController@update')->name('slack.update')->middleware('user.authenticated');
