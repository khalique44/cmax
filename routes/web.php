<?php

//Route::get('/', 'HomeController@welcome');

use Illuminate\Support\Facades\Hash;



Route::get('/routecache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
});
Route::get('/routeconfig', function (){
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
});

Route::get('/', 'HomeController@index');


Route::get('resend-verification-mail/{token}', 'HomeController@resendMail');
Route::get('waiting-for-approval/{token}', 'UsersController@waitingForApprovalProUser')->name('waiting-for-approval');


Route::group(['namespace'=>'Auth'],function (){

    
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Auth::routes(['register' => false]);
    Auth::routes(['password/reset' => false]);
    
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset', function (){
            return redirect('/login');
    });
    //Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    //Route::get('password/reset/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
    //Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');   

});

//Route::get('email-verification/{token}', 'UsersController@verifyUser')->name('email_verification');


Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['verified']], function() {       

        Route::post('change-password','UsersController@changePassword')->name('change_password');
        Route::post('update-address','UsersController@updateAddress')->name('update_address');
        
    });
    Route::get('verify-email','UsersController@verifyEmail')->name('verify_email');
    Route::get('resend-account-verify-email','UsersController@resendEmailVerifyMail')->name('resend_account_verify_email');
    Route::get('dashboard','UsersController@dashboard')->name('dashboard');   
    
   
});

Route::group(array('prefix'=>'admin','namespace'=>'Admin'), function (){

    Route::get('/','AdminController@welcome')->name('admin.welcome');

    Route::get('login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Auth\LoginController@login');
    Route::get('logout','Auth\LoginController@logout')->name('admin.logout');

    Route::group(array('middleware'=>'admin'), function (){
        Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
        Route::get('dashboard/get_users','AdminController@getUsers')->name('admin.dashboard.get_users');
        Route::get('dashboard/{id}','AdminController@showDashboard')->name('admin.showDashboard');		

        Route::get('change-password','Auth\ResetPasswordController@changePassword');
        Route::post('change-password','Auth\ResetPasswordController@updatePassword');

        Route::group(['prefix'=>'blog','namespace'=>'Blog'], function (){
            Route::resource('general_settings','GeneralSettingController');
            Route::resource('posts','PostController');
            Route::post('posts/update_position','PostController@updatePosition');
        });

        Route::group(['prefix'=>'contact_us','namespace'=>'ContactUs'], function (){
            Route::resource('general_settings','GeneralSettingController');                      
        });

        Route::group(['prefix'=>'dashboard_front','namespace'=>'DashboardFrontPage'], function (){
            Route::resource('general_settings','GeneralSettingController');                      
        });

        Route::group(['prefix'=>'login_page','namespace'=>'LoginPage'], function (){
            Route::resource('general_settings','GeneralSettingController');                      
        });

        Route::resource('users','UsersController');
        Route::get('user/import','UsersController@importUsers')->name('admin.import-users');
        Route::post('user/import','UsersController@importUsersStore')->name('admin.import-users');
        Route::get('user/imported_users','AdminController@dashboard')->name('admin.imported-users');
        Route::get('/users', 'UsersController@index')->name('users.index');
        Route::get('/users-data', 'UsersController@getUsers')->name('users.data');

        Route::get('create/{user_type}','UsersController@createUsers');
        Route::post('store/users','UsersController@storeUsers');        
        
        Route::resource('global-settings','GlobalSettingController');
        Route::get('global-styling/reset_color_to_default','GlobalStylingController@resetColorsDefault')->name('reset_color_to_default');
        Route::resource('global-styling','GlobalStylingController');     

        Route::resource('logs','LogActivityController');       


    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blog', 'BlogController@index')->name('index');
Route::get('/blog/{id}', 'BlogController@show')->name('show');




