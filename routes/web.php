<?php

//Route::get('/', 'HomeController@welcome');

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admin\MediaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;




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

    //Route::get('/','AdminController@welcome')->name('admin.welcome');

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
            Route::get('blog-data', 'PostController@getPosts')->name('blog.data');
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

        
        Route::resource('projects','ProjectController'); 
        Route::get('/projects-data', 'ProjectController@getProjects')->name('projects.data');
        Route::get('/projects/add-property/{id}', 'ProjectController@addProperty')->name('add.property');
        Route::get('/projects/edit-property/{id}/{property_id}', 'ProjectController@editProperty')->name('edit.property');

        Route::resource('properties','PropertyController'); 
        Route::get('/properties-data', 'PropertyController@getProperties')->name('properties.data');

        

        Route::resource('builders','BuilderController'); 
        Route::get('/builders-data', 'BuilderController@getBuilders')->name('builders.data');


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



        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::get('media/list', [MediaController::class, 'list'])->name('media.list');
        Route::delete('media/delete/{id}', [MediaController::class, 'delete'])->name('media.delete'); 
        Route::get('/media/{media}', function (\Spatie\MediaLibrary\MediaCollections\Models\Media $media) {
            return response()->file($media->getPath());
        });

        Route::post('/upload-temp', function (Request $request) {
            $path = $request->file('file')->store('temp');
            return $path;
        });

        Route::delete('/upload-temp-revert', function (Request $request) {
            $mediaId = trim(file_get_contents('php://input'), '"');

            $media = Media::find($mediaId);

            if ($media) {
                $media->delete(); // will remove file from storage + db
                return response()->json(['deleted' => true]);
            }

            return response()->json(['deleted' => false, 'message' => 'Media not found'], 404);
        });

        Route::get('/media/{media}', function (Media $media) {
            return response()->file($media->getPath());
        });

        Route::delete('/media/{media}', function (Media $media) {
            $media->delete();
            return response()->json(['deleted' => true]);
        });


        Route::get('cms-pages/about-us','CmsPage@aboutUs')->name('cmspages.aboutus');
        Route::get('cms-pages/career','CmsPage@career')->name('cmspages.career');
        Route::get('cms-pages/contact-us','CmsPage@contactUs')->name('cmspages.contactus');
        Route::post('cms-pages/save-about-us','CmsPage@saveAboutUs')->name('cmspages.save-aboutus');
        Route::post('cms-pages/save-career','CmsPage@saveCareer')->name('cmspages.save-career');
        Route::post('get-sub-area/{id}','ProjectController@getSubAreas')->name('project.get-sub-area');
        Route::post('cms-pages/save-contact-us','CmsPage@saveContactUs')->name('cmspages.save-contactus');
        Route::resource('testimonials','TestimonialController');
        Route::get('project/update-status','ProjectController@updateStatus')->name('project.update-status');
        Route::post('project/update-position','ProjectController@updatePosition')->name('project.update-position');
        Route::post('/areas', 'MainAreaController@store')->name('areas.store');
        Route::post('/sub-areas', 'SubAreaController@store')->name('subareas.store');
        Route::resource('home-page','HomePageController');
        


    });
});

//Auth::routes();
Route::get('/home', function () {
    return redirect('/admin/dashboard');
});
Route::get('/admin', function () {
    return redirect('/admin/login');
});


Route::get('/', 'HomeController@index')->name('home');
Route::get('/blog', 'BlogController@index')->name('blog.list');
Route::get('/blog/{id}', 'BlogController@show')->name('show');
Route::get('/search-area', 'HomeController@searchArea')->name('search-area');
Route::get('/projects', 'ProjectController@index')->name('allprojects');
Route::get('/projects/search-results', 'ProjectController@searchResults')->name('search-results');
Route::get('/project/{slug}', 'ProjectController@show')->name('project.show');
Route::get('/about-us', 'CmsPage@showAboutUs')->name('aboutus.show');
Route::get('/career', 'CmsPage@showCareer')->name('career.show');
Route::get('/contact-us', 'CmsPage@showContactUs')->name('contactus.show');

Route::post('/compare/add', 'ProjectCompareController@ajaxAdd')->name('projects.compare.ajaxAdd');
Route::post('/compare/add-multiple', 'ProjectCompareController@ajaxAddMultiple')->name('projects.compare.ajaxAddMultiple');
Route::post('/compare/remove', 'ProjectCompareController@ajaxRemove')->name('projects.compare.ajaxRemove');
Route::post('/compare/clear', 'ProjectCompareController@ajaxClear')->name('projects.compare.ajaxClear');

Route::get('/compare', 'ProjectCompareController@index')->name('projects.compare');
Route::get('/compare/add/{id}', [ProjectCompareController::class, 'add'])->name('projects.compare.add');
Route::get('/compare/remove/{id}', [ProjectCompareController::class, 'remove'])->name('projects.compare.remove');





