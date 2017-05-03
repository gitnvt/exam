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

Route::group(['middleware' => 'auth'], function () {
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
    Route::get('/question-bank/generate/{nQuestions}', 'backend\QuestionBankController@getGenerate');

    Route::get('/exam', 'backend\ExamController@getIndex');
    Route::get('/exam/create', 'backend\ExamController@getCreate');
    Route::post('/exam/create', 'backend\ExamController@postCreate');
    //Route::get('/exam/questions/{examId}/{subjectId}/{method}', 'backend\ExamController@getQuestions');
    //Route::post('/exam/questions', 'backend\ExamController@postQuestions');
    Route::get('/exam/matrix/{examId}', 'backend\ExamController@getMatrix');
    Route::post('/exam/matrix/{examId}', 'backend\ExamController@postMatrix');
    Route::get('/exam/method/{examId}', 'backend\ExamController@getMethod');
    Route::post('/exam/method/{examId}', 'backend\ExamController@postMethod');
    Route::get('/exam/questions/{examMatrixId}/{bankId}', 'backend\ExamController@getQuestions');
    Route::get('/exam/levels/{subjectId}/{termId}', 'backend\ExamController@getLevels');
    Route::get('/exam/{examId}', 'backend\ExamController@getView');

    Route::get('bank', 'backend\BankController@getIndex');
    Route::get('bank/create', 'backend\BankController@getCreate');
    Route::post('bank/create', 'backend\BankController@postCreate');

    // Import examinee
    Route::get('examinee/import', 'backend\ExamineeController@getImport');
    Route::post('examinee/import', 'backend\ExamineeController@postImport');
    Route::get('examinee/list', 'backend\ExamineeController@getList');
    Route::get('examinee/generate-exam-code', 'backend\ExamineeController@getGenerateExamCode');
    Route::post('examinee/generate-exam-code', 'backend\ExamineeController@postGenerateExamCode');
    Route::get('examinee/{id}', 'backend\ExamineeController@getExamCode');
    Route::get('examinee/preview/{examCode}', 'backend\ExamineeController@getPreview');

    // Display log
    Route::get('/log/system', 'backend\LogController@getSystem');
    Route::get('/log/quiz', 'backend\LogController@getQuiz');
    Route::get('/log/quiz-detail/{userId}/{examCode}', 'backend\LogController@getQuizDetail');

});

/*== Frontend ==*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/exam/quiz/{exam_id}', 'frontend\ExamController@getQuiz');
    Route::post('/exam/quiz/{result_id}', 'frontend\ExamController@postQuiz');
    Route::get('/exam/review/{result_id}', 'frontend\ExamController@getReview');
});

Route::get('/exam/draft-answer/{result_id}/{question_id}/{answer_id}', 'frontend\ExamController@getDraftAnswer');
Route::get('/', 'frontend\ExamController@getSubjects');

