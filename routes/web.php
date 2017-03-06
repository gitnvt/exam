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

Auth::routes();

Route::get('/admin', 'backend\DashboardController@getIndex');

Route::get('/subject', 'backend\SubjectController@getIndex');
Route::get('/subject/create', 'backend\SubjectController@getCreate');
Route::post('/subject/create', 'backend\SubjectController@postCreate');

Route::get('/scholastic', 'backend\ScholasticController@getIndex');
Route::get('/scholastic/create', 'backend\ScholasticController@getCreate');
Route::post('/scholastic/create', 'backend\ScholasticController@postCreate');

Route::get('/semester', 'backend\SemesterController@getIndex');
Route::get('/semester/create', 'backend\SemesterController@getCreate');
Route::post('/semester/create', 'backend\SemesterController@postCreate');

Route::get('/question-bank', 'backend\QuestionBankController@getIndex');
Route::get('/question-bank/import/{sub_id?}', 'backend\QuestionBankController@getImport');
Route::post('/question-bank/import', 'backend\QuestionBankController@postImport');

Route::get('/exam', 'backend\ExamController@getIndex');
Route::get('/exam/create', 'backend\ExamController@getCreate');
Route::post('/exam/create', 'backend\ExamController@postCreate');
Route::get('/exam/questions/{examId}/{subjectId}/{method}', 'backend\ExamController@getQuestions');
Route::post('/exam/questions', 'backend\ExamController@postQuestions');

/*== Frontend ==*/
Route::get('/exam/quiz/{exam_id}', 'frontend\ExamController@getQuiz');
Route::post('/exam/quiz/{result_id}', 'frontend\ExamController@postQuiz');
Route::get('/exam/draft-answer/{result_id}/{question_id}/{answer_id}', 'frontend\ExamController@getDraftAnswer');
Route::get('/exam/review/{result_id}', 'frontend\ExamController@getReview');
Route::get('/', 'frontend\ExamController@getSubjects');

