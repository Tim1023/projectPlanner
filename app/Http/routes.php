<?php
Route::auth();

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

// Registration routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => ['auth', 'admin']], function()
{

    Route::get('admin', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

    Route::group(/**
     *
     */
        ['prefix' => 'admin'], function()
    {
        Route::resource('departments', 'DepartmentController');
        Route::resource('programs', 'ProgramController');
        Route::resource('programs.program_semesters', 'ProgramSemesterController');
        Route::resource('programs.program_requirements', 'ProgramRequirementController');
        Route::resource('pathways', 'PathwayController');
        Route::resource('pathways.pathway_semesters', 'PathwaySemesterController');
        Route::resource('courses', 'CourseController');
        Route::resource('careers', 'CareerController');


        Route::post('program_semesters/{program_semester}/courses/create', [
            'as' => 'program_semesters.courses.store',
            'uses' => 'ProgramSemesterController@addCourse'
        ]);
        Route::post('program_semesters/{program_semester}/courses/destroy', [
            'as' => 'program_semesters.courses.destroy',
            'uses' => 'ProgramSemesterController@removeCourse'
        ]);
        Route::post('pathway_semesters/{pathway_semester}/courses/create', [
            'as' => 'pathway_semesters.courses.store',
            'uses' => 'PathwaySemesterController@addCourse'
        ]);
        Route::post('pathway_semesters/{pathway_semester}/courses/destroy', [
            'as' => 'pathway_semesters.courses.destroy',
            'uses' => 'PathwaySemesterController@removeCourse'
        ]);

        Route::get('programs/{program}/compulsory/index', [
            'as' => 'programs.compulsory.index',
            'uses' => 'ProgramController@getCompulsoryCourses'
        ]);
        Route::get('programs/{program}/compulsory/create/{course}', [
            'as' => 'programs.compulsory.create',
            'uses' => 'ProgramController@addCompulsoryCourse'
        ]);
        Route::get('programs/{program}/compulsory/destroy/{course}', [
            'as' => 'programs.compulsory.destroy',
            'uses' => 'ProgramController@removeCompulsoryCourse'
        ]);
        Route::group(['prefix' => 'api'], function() {
            Route::get('courses', [
                'as' => 'api.courses',
                'uses' => 'CourseController@indexJson'
            ]);
        });
    });
});