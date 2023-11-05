<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home_page');
Route::get('/join-now', 'App\Http\Controllers\HomeController@joinNow')->name('join_now');
Route::get('/terms', 'App\Http\Controllers\HomeController@terms')->name('terms_page');
Route::get('/info_security', 'App\Http\Controllers\HomeController@infoSecurity')->name('security_page');
Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('auth.register');
Route::post('/register-submit', 'App\Http\Controllers\AuthController@registerSubmit')->name('auth.register.submit');

Route::middleware('check.logged')->group(function () {
    Route::get('/dashboard/profile', 'App\Http\Controllers\AuthController@profile')->name('profile');
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->name('dashboard');
    Route::get('/dashboard/profile_ajax', 'App\Http\Controllers\AuthController@profileAjax')->name('profile_ajax');
    Route::get('/dashboard/profile_school', 'App\Http\Controllers\AuthController@profileSchool')->name('profile_school');
    Route::post('/dashboard/profile/update', 'App\Http\Controllers\AuthController@profileUpdate')->name('profile_update');
    Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('auth.logout');
    Route::get('/change-class', 'App\Http\Controllers\HomeController@changeClass')->name('change_class');
    Route::post('/change-class', 'App\Http\Controllers\HomeController@changeClassUpdate')->name('change_class_update');
    Route::get('/list-services', 'App\Http\Controllers\HomeController@listServices')->name('list_services');

//    skill lesson
    Route::get('/dashboard/lesson/skill', 'App\Http\Controllers\SkillController@listLessonSkill')->name('lesson.skill');
    Route::get('/dashboard/lesson/ajax', 'App\Http\Controllers\SkillController@lessonAjax')->name('lesson.ajax');
    Route::get('/dashboard/lesson/video/ajax', 'App\Http\Controllers\SkillController@lessonAjaxVideo')->name('video.ajax');

//    Exercise
    Route::get('/dashboard/list-exercise', 'App\Http\Controllers\ExerciseController@listExercise')->name('list.exercise');
    Route::get('/dashboard/week-exercise', 'App\Http\Controllers\ExerciseController@weekExercise')->name('week.exercise');
    Route::get('/dashboard/detail/week-exercise/{id}', 'App\Http\Controllers\ExerciseController@detailWeekExercise')->name('detail-week.exercise');
    Route::get('/dashboard/detail/exercise-done', 'App\Http\Controllers\ExerciseController@exerciseDone')->name('exercise-done');

    Route::get('/example-test', 'App\Http\Controllers\HomeController@listExampleTest')->name('example_test');
    Route::get('/example-details', 'App\Http\Controllers\HomeController@listExampleDetails')->name('example_details');
    Route::get('/exercise-taken-detail/{id}', 'App\Http\Controllers\HomeController@exerciseTakenDetail')->name('exercise_taken_detail');
    Route::post('/kit-active', 'App\Http\Controllers\HomeController@kitActive')->name('kit_active');

    Route::post('/exercise-start-taken', 'App\Http\Controllers\HomeController@actionStartTaken')->name('exercise_start_taken');
    Route::post('/exercise-start-week/{id}', 'App\Http\Controllers\ExerciseController@actionStartWeek')->name('exercise_start_week');
    Route::get('/exercise-test-task/{id}', 'App\Http\Controllers\HomeController@exerciseTestTask')->name('exercise_test_task');

    Route::get('/exercise-twenty-first', 'App\Http\Controllers\ExerciseTypeController@actionType21')->name('exercise_second_type');
    Route::get('/exercise-twenty-second', 'App\Http\Controllers\ExerciseTypeController@actionType22')->name('exercise_second_two');
    Route::get('/exercise-twenty-third', 'App\Http\Controllers\ExerciseTypeController@actionType23')->name('exercise_second_three');
    Route::get('/taken-detail/{id}', 'App\Http\Controllers\HomeController@actionTakenDetail')->name('taken_detail');
    Route::post('/submit/homework', 'App\Http\Controllers\ExerciseController@submitHomework')->name('submit-homework');

//    Route::get('/exercise-one', 'App\Http\Controllers\ExerciseController@exerciseOne')->name('exercise-one');
//    Route::get('/exercise-2', 'App\Http\Controllers\ExerciseController@exercise2')->name('exercise-2');
//    Route::get('/exercise-3', 'App\Http\Controllers\ExerciseController@exercise3')->name('exercise-3');
//    Route::get('/exercise-4', 'App\Http\Controllers\ExerciseController@exercise4')->name('exercise-4');
//    Route::get('/exercise-5', 'App\Http\Controllers\ExerciseController@exercise5')->name('exercise-5');
//    Route::get('/exercise-6', 'App\Http\Controllers\ExerciseController@exercise6')->name('exercise-6');

//    check display_exercise

    Route::get('/display_exercise/{id}', 'App\Http\Controllers\ExerciseController@displayExercise')->name('display-exercise');
    Route::post('/logic/form/baby', 'App\Http\Controllers\ExerciseTypeController@logicFormType10')->name('logic-form-baby');

    Route::post('/capture-type-one', 'App\Http\Controllers\ExerciseTypeController@captureTypeOne')->name('capture_type_one');
    Route::post('/capture-type-form-2', 'App\Http\Controllers\ExerciseTypeController@captureTypeTwo')->name('capture_type_two');
    Route::post('/capture-type-twenty', 'App\Http\Controllers\ExerciseTypeController@captureTypeTwenty')->name('capture_type_twenty');
    Route::post('/capture-twenty-third', 'App\Http\Controllers\ExerciseTypeController@captureTwentyThird')->name('capture_twenty_third');

    Route::post('/capture-exam-3', 'App\Http\Controllers\ExerciseController@captureExam3')->name('capture_exam_3');
});

Route::middleware('not.logged')->group(function () {
    Route::get('/login', 'App\Http\Controllers\AuthController@login')->name('auth.login');
    Route::post('/login', 'App\Http\Controllers\AuthController@loginExecute')->name('auth.loginExecute');
});
