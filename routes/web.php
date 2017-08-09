<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function(){
    return redirect('home');
});
Route::get('/list', 'UserListController@index')->name('list');
Route::get('/edit/{id}', 'UserEditController@index')->name('edit');
Route::post('/edit', 'UserEditController@postHandle')->name('editPost');

Route::get('/info/{id}', 'UserInfoController@index')->name('info');
Route::post('/messages/to/{id}', 'UserInfoController@add')->name('sendMessage');
Route::delete('/messages/{id}', 'UserInfoController@delete')->name('deleteMessage');
Route::put('/messages/{id}', 'UserInfoController@update')->name('updateMessage');
Route::get('/inbox', 'UserInfoController@inbox')->name('inbox');

Route::post('/exercises/upload', 'ExercisesController@add')->middleware('role')->name('uploadExercise');
Route::delete('/exercises/{id}', 'ExercisesController@delete')->middleware('role')->name('deleteExercise');
Route::get('/exercises', 'ExercisesController@index')->name('listExercises');
Route::get('/exercises/upload', 'ExercisesController@uploadIndex')->middleware('role')->name('indexExercise');
Route::get('/exercises/download/{id}', 'ExercisesController@download')->name('downloadExercise');
Route::post('/exercises/solution/{id}', 'ExercisesController@studentUpload')->name('uploadSolution');
Route::get('/exercises/solution/{id}', 'ExercisesController@downloadSolution')->middleware('role')->name('downloadSolution');

Route::get('/quiz/upload', 'QuizController@index')->middleware('role')->name('indexQuiz');
Route::post('/quiz/upload', 'QuizController@uploadQuiz')->middleware('role')->name('uploadQuiz');

Route::get('/quiz', 'QuizController@indexAnswer')->name('answerQuiz');
Route::post('/quiz', 'QuizController@uploadAnswer')->name('postQuiz');

