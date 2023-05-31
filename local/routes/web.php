<?php


use App\Http\Controllers\HomeController;


Route::get('/ccl', function() {
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:cache');
        return('Clear-cache Success..');
});

//login OAuth
Route::get('/fdffdffgaghyujshjhmjkjl,jmvbzfzdgzfdggfd', 'AuthenticationController@login')->name('login');
// Route::get('/idplogin', 'AuthenticationController@login')->name('login');

//login no OAuth
Route::get('/', 'AuthenticationController@loginadmin')->name('loginadmin');
Route::get('/idplogin', 'AuthenticationController@loginadmin')->name('loginadmin');


//OAuth
Route::post('getOAuthcode', 'OAuthController@getOAuthcode')->name('getOAuthcode');
Route::post('resetPassword', 'OAuthController@resetPassword')->name('resetPassword');

Route::get('getOAuthcode/{code}', 'OAuthController@getOAuthcodejas')->name('getOAuthcodejas');

//Cookie
Route::get('/setCookie', 'CookieController@setCookie')->name('setCookie');
Route::get('/getCookie', 'CookieController@getCookie')->name('getCookie');
Route::get('/logoutCookie', 'CookieController@logoutCookie')->name('logoutCookie');

//dashboard
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::post('/dashview', 'DashboardController@dashview')->name('dashview');

//import
Route::get('/import', 'ImportController@index')->name('import');
Route::post('/importExcel', 'ImportController@importExcel')->name('importExcel');

//update result
Route::get('/updateResult', 'UpdateResultController@index')->name('updateResult');
Route::post('/importResult', 'UpdateResultController@importResult')->name('importResult');

//import employee
Route::post('/importemp', 'UpdateResultController@importemp')->name('importemp');

//view data in database
Route::get('/listidp', 'ListIDPController@index')->name('listidp');
Route::get('/view/{id}', 'ListIDPController@view')->name('view');
Route::post('/listidp/delete','ListIDPController@edit')->name('edit');

//edit course
Route::get('/course', 'CourseController@index')->name('course');
Route::get('/details/{category_id}/{course_id}/{method_id}', 'CourseController@details')->name('details');
Route::post('/delete','CourseController@edit')->name('edit');

//course detail
Route::get('/courseDetails', 'CourseDetailsController@index')->name('courseDetails');
Route::get('/edit/{id}', 'CourseDetailsController@view')->name('view');
Route::post('/update','CourseDetailsController@edit')->name('edit');
