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

// User Auth

Route::get('/auth/google', 'UserController@redirectToGoogle');
Route::get('/auth/google/callback', 'UserController@handleGoogleCallback');

Route::get('/logout', 'HomeController@logout');

Route::get('/', 'HomeController@index');
Route::get('/about-us', 'HomeController@aboutUs');
Route::get('/contact-us', 'HomeController@contactUs');

// Blog
Route::group(['prefix' => '/blog',], function () {
    Route::get('/', 'TopicController@AllGetForClient');
    Route::get('/{category}', 'TopicController@ByCategoryGet');
    Route::get('/{category}/{id}', 'TopicController@SingleGet');
});

Route::get('/sign-up', 'UserController@SignUpGet');
Route::post('/sign-up', 'UserController@SignUpPost');
Route::post('/signin', 'UserController@SignIn');
Route::post('/search', 'SearchController@search');
Route::get('/course', 'HomeController@groups');
Route::get('/course/{name}', 'HomeController@courses');
Route::get('/course/{group_name}/{course_name}', 'HomeController@course');


Route::get('/user/category_posts/{category_name}', 'UserController@category_posts');

Route::group(['prefix' => '/user', 'middleware' => 'student'], function () {
    Route::get('/profile', 'UserController@Profile');

    Route::get('/courses', 'UserController@Courses');
    Route::get('/course/{course_id}/add-to-basket', 'UserController@AddToBasket');
    
    Route::get('/exams', 'UserController@Exams');
    Route::get('/account', 'UserController@get_account');
    Route::post('/account_edited', 'UserController@account_edited');

    // Exam
    Route::group(['prefix' => '/exams'], function () 
    {
        Route::group(['prefix' => '/{exam_id}'], function () 
        {
            Route::get('/start', 'ExamController@Start');
            Route::get('/stages', 'StageController@GetAllByExamForClient');
            Route::get('/stages/{stage_number}', 'StageController@GetByNumberForClient');
            Route::get('/stages/{stage_number}/lesson', 'LessonController@GetByStageForClient');
            Route::get('/stages/{stage_number}/question', 'ExamController@QuestionGet');
            Route::post('/stages/{stage_number}/question', 'ExamController@QuestionPost');
        });
        Route::get('/', 'UserController@Exams');
    });
});

Route::get('/admin/login', 'AdminController@getLogin');
Route::post('/admin/login', 'AdminController@login');

Route::group(['prefix' => '/admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'AdminController@Index');
    Route::get('/addAdmin', 'AdminController@getAddAdmin');
    Route::post('/addAdmin', 'AdminController@addAdmin');

    // Topic
    Route::group(['prefix' => '/blog',], function () {
        Route::get('/add', 'TopicController@AddGet');
        Route::post('/add', 'TopicController@AddPost');
        Route::get('/edit/{id}', 'TopicController@EditGet');
        Route::post('/edit', 'TopicController@EditPost');
        Route::get('/delete/{id}', 'TopicController@DeleteGet');
        Route::get('/', 'TopicController@AllGetForAdmin');
    });

    // Student
    Route::group(['prefix' => '/users',], function () {
        Route::get('/add', 'UserController@AddGet');
        Route::post('/add', 'UserController@AddPost');
        Route::get('/edit/{id}', 'UserController@EditGet');
        Route::post('/edit', 'UserController@EditPost');
        Route::get('/delete/{id}', 'UserController@DeleteGet');
        Route::get('/', 'UserController@AllGet');
        Route::get('/{id}', 'UserController@SingleGet');
    });

    // Course
    Route::group(['prefix' => '/courses',], function () {
        Route::get('/add', 'CourseController@AddGet');
        Route::post('/add', 'CourseController@AddPost');
        Route::get('/edit/{id}', 'CourseController@EditGet');
        Route::post('/edit', 'CourseController@EditPost');
        Route::get('/delete/{id}', 'CourseController@DeleteGet');
        Route::get('/', 'CourseController@AllGetForAdmin');
    });

    // Exam
    Route::group(['prefix' => '/exams'], function () 
    {
        Route::group(['prefix' => '/{exam_id}'], function () 
        {
            Route::group(['prefix' => '/stages'], function () 
            {
                Route::group(['prefix' => '/{stage_id}'], function () 
                {     
                    Route::group(['prefix' => '/questions'], function () 
                    {
                        Route::get('/{question_id}/edit', 'QuestionController@EditGet');
                        Route::post('/{question_id}/edit', 'QuestionController@EditPost');
                        Route::get('/add', 'QuestionController@AddGet');
                        Route::post('/add', 'QuestionController@AddPost');
                        Route::get('/', 'QuestionController@GetAllByStage');
                    });

                    Route::group(['prefix' => '/lesson'], function () 
                    {
                        Route::get('/edit', 'LessonController@EditGet');
                        Route::post('/edit', 'LessonController@EditPost');
                        Route::get('/add', 'LessonController@AddGet');
                        Route::post('/add', 'LessonController@AddPost');
                        Route::get('/', 'LessonController@GetByStageForAdmin');
                    });
                    
                    Route::get('/edit', 'StageController@EditGet');
                    Route::post('/edit', 'StageController@EditPost');
                });
                Route::get('/add', 'StageController@AddGet');
                Route::post('/add', 'StageController@AddPost');
                Route::get('/', 'StageController@GetAllByExamForAdmin');
            });
            Route::get('/edit', 'ExamController@EditGet');
            Route::get('/delete', 'ExamController@DeleteGet');
        });
        Route::get('/add', 'ExamController@AddGet');
        Route::post('/add', 'ExamController@AddPost');
        Route::post('/edit', 'ExamController@EditPost');
        Route::get('/', 'ExamController@AllGetForAdmin');
    });

     // Topic
     Route::group(['prefix' => '/blog/topic',], function () {
        Route::get('/add', 'TopicController@AddGet');
        Route::post('/add', 'TopicController@AddPost');
        Route::get('/edit/{id}', 'TopicController@EditGet');
        Route::post('/edit', 'TopicController@EditPost');
        Route::get('/delete/{id}', 'TopicController@DeleteGet');
        Route::get('/', 'TopicController@AllGetForAdmin');
    });

    Route::get('/categories', 'AdminController@categories');
    Route::post('/add_category', 'AdminController@add_category');

    Route::get('/teachers', 'AdminController@teachers');
    Route::get('/add_teacher', 'AdminController@getAdd_teacher');
    Route::get('/edit_teacher/{teacher_id}', 'AdminController@edit_teacher');
    Route::get('/delete_teacher/{teacher_id}', 'AdminController@delete_teacher');
    Route::post('/add_teacher', 'AdminController@add_teacher');
    Route::post('/teacher_edited', 'AdminController@teacher_edited');

    Route::get('/videos', 'AdminController@videos');
    Route::get('/add_video', 'AdminController@getAdd_video');
    Route::get('/edit_video/{video_id}', 'AdminController@edit_video');
    Route::get('/delete_video/{video_id}', 'AdminController@delete_video');
    Route::post('/add_video', 'AdminController@add_video');
    Route::post('/video_edited', 'AdminController@video_edited');

});