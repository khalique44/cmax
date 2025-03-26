<?php

//Route::get('/', 'HomeController@welcome');

/*Route::get('/email', function(){
    $user = \App\User::find(151);
    return view('thank-you',compact('user'));
})->name('/');*/

Route::get('language/{locale}', 'LocalizationController@index');

Route::get('/emails','AthleteController@testEmail');


Route::get('/routecache', function (){
    \Illuminate\Support\Facades\Artisan::call('config:cache');
});
Route::get('/routeconfig', function (){
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
});

Route::get('/test_sub','AthleteController@testSubscription');


//Route::get('/', 'HomeController@showPreLogin')->name('/');
Route::get('/', 'HomeController@welcome');
Route::post('pre-login', 'HomeController@preLogin')->name('pre-login');
///////////////////////
//Route::get('/sendEmail', 'AthleteController@test_email');

Route::get('resend-verification-mail/{token}', 'HomeController@resendMail');
Route::get('waiting-for-approval/{token}', 'UsersController@waitingForApprovalProUser')->name('waiting-for-approval');

/* Expediters Users */
Route::get('contests/{slug}','ExpeditersController@index')->name('expediters.index');
Route::post('expediters','ExpeditersController@store')->name('expediters.store');

Route::group(['namespace'=>'Auth'],function (){
    //App::setLocale('en');
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    Route::get('register', 'RegisterController@registerUser')->name('register');
    Route::post('register', 'RegisterController@register')->name('register');

    Route::get('register-type','RegisterController@registerNpc');

    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    Route::get('password/reset/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

Route::get('getstatelist', 'AthleteController@getStates');
Route::get('getCost', 'AthleteController@getCost');
Route::get('getRegisterYears', 'AthleteController@getRegisterYears');
Route::get('getdistrictlist', 'AthleteController@getDistricts');
Route::get('getyearslist', 'AthleteController@getYears');
Route::get('membership-number','AthleteController@nextMembershipNumber');

Route::post('email_available/check', 'AthleteController@check')->name('email_available.check');

Route::get('email-verification/{token}', 'UsersController@verifyUser')->name('email_verification');

Route::get('athlete','AthleteController@createAthlete')->name('athlete');
Route::post('athlete','AthleteController@storeAthlete');

/*Route::get('non-athlete','AthleteController@createNonAthlete');
Route::post('non-athlete','AthleteController@storeNonAthlete');

Route::get('pro-athlete','AthleteController@createProAthlete');
Route::post('pro-athlete','AthleteController@storeProAthlete');*/

Route::get('checkout/{token}','AthleteController@checkout');
Route::post('checkout/{token}','AthleteController@storeSubscription');

Route::post('zipcode','AthleteController@zipcodeCheck');

Route::get('membership','AthleteController@membership')->name('membership');

Route::group(['middleware' => ['auth']], function() {

    Route::group(['middleware' => ['verified']], function() {
        Route::get('home','HomeController@index')->name('home');

        Route::post('judge','UsersController@Judge')->name('judge');

        Route::post('change-password','UsersController@changePassword')->name('change_password');
        Route::post('update-address','UsersController@updateAddress')->name('update_address');

        //renew membership
        Route::get('renew_membership/{id}','AthleteController@renew_membership');
        Route::post('renew_membership/{id}','AthleteController@update_membership');
    });

    Route::get('verify-email','UsersController@verifyEmail')->name('verify_email');
    Route::get('resend-account-verify-email','UsersController@resendEmailVerifyMail')->name('resend_account_verify_email');

    Route::group(array('prefix'=>'contest','as' => 'contests.'), function (){
        Route::get('all-contests','ContestsController@allContests')->name('all-contests');
        Route::get('apply/{id}','ContestsController@Apply')->name('apply');
        Route::get('apply-for-contestant/{id}','ContestsController@ApplyForContestant')->name('apply_for_contestant');
        Route::get('my-contests','ContestsController@myContests')->name('my-contests');

        Route::get('scan_contests','ContestsController@scanContests')->name('scan_contests');

        /*////////////////  type = "non-athlete" => registration_type = "promoter" ////////////////////*/

        Route::get('judges/{slug}','ContestsController@Judges')->name('judges');
        Route::get('contest-contestants/{slug}','ContestsController@contestContestants')->name('contest_contestants');
        Route::get('contest-expediter/{slug}','ContestsController@contestExpediters')->name('contest-expediter');
        Route::delete('contest-expediter-destroy/{id}','ContestsController@contestExpeditersDestroy')->name('contest-expediter-destroy');
        Route::get('contest-trainer/{slug}','ContestsController@contestTrainers')->name('contest-trainer');

        Route::get('create-judges/{slug}','ContestsController@createJudges')->name('create_judges');
        Route::get('create-contestants/{slug}','ContestsController@createContestants')->name('create_contestants');
        Route::get('create-expediters/{slug}','ContestsController@createExpediters')->name('create_expediters');
        Route::get('create-trainers/{slug}','ContestsController@createTrainers')->name('create_trainers');

        Route::post('store-judges','ContestsController@storeJudges')->name('store_judges');
        Route::post('store-contestants','ContestsController@storeContestants')->name('store_contestants');
        Route::post('store-expediters','ContestsController@storeExpediters')->name('store_expediters');
        Route::post('store-trainers','ContestsController@storeTrainers')->name('store_trainers');

        Route::get('make_attendee_by_promoter/{attendee_id}','ContestsController@makeAttendee')->name('make_attendee_by_promoter');
        /*///////////////   end of non-athlete promoter ///////////////////////*/

        Route::get('approved_judges_from_promoters/{contest_id}/{user_id}','ContestsController@JudgesApprovalFromPromoter')->name('approved_judges_from_promoters');
        Route::get('decline_judges_from_promoters/{contest_id}/{user_id}','ContestsController@declineJudges')->name('decline_judges');

        Route::get('complete-contests/{id}','ContestsController@CompleteContests')->name('complete-contests');
        Route::get('start-contests/{id}','ContestsController@StartContests')->name('start-contests');

        Route::get('approve_for_contest_completion/{user_id}/{contest_id}','ContestsController@ApproveForContestCompletion')->name('approve_for_contest_completion');
        Route::get('approve_for_judges_and_promoters/{user_id}/{contest_id}','ContestsController@ApproveForJudgesAndPromoters')->name('approve_for_judges_and_promoters');

    });
});

Route::group(array('prefix'=>'admin','namespace'=>'Admin'), function (){
    Route::get('/','AdminController@welcome')->name('admin.welcome');

    Route::get('login','Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','Auth\LoginController@login');
    Route::get('logout','Auth\LoginController@logout')->name('admin.logout');

    Route::group(array('middleware'=>'admin'), function (){
        Route::get('dashboard','AdminController@dashboard')->name('admin.dashboard');
        Route::get('dashboard/{id}','AdminController@showDashboard')->name('admin.showDashboard');

        Route::get('change-password','Auth\ResetPasswordController@changePassword');
        Route::post('change-password','Auth\ResetPasswordController@updatePassword');

        Route::group(['prefix'=>'modules','namespace'=>'Modules'], function (){
            Route::resource('gym','GymController');
            Route::resource('categories','CategoryController');
            Route::resource('countries','CountryController');
            Route::resource('districts','DistrictController');
            Route::resource('membership_year_color','YearColorController');
            Route::resource('registration_years','RegistrationYearController');
            Route::resource('registration_fee','RegistrationFeeController');
            Route::get('registration_fees/add_year','RegistrationFeeController@addYear');
            Route::post('registration_fees/store_year','RegistrationFeeController@storeYear');
            Route::resource('registration_types','RegistrationTypesController');
        });

        Route::resource('users','UsersController');

        Route::get('create/{user_type}','UsersController@createUsers');
        Route::post('store/users','UsersController@storeUsers');

        Route::post('usersActiveUpdate/{id}','UsersController@usersActiveUpdate');
        Route::post('usersInActiveUpdate/{id}','UsersController@usersInActiveUpdate');
        Route::post('usersVerifyUpdate/{id}','UsersController@usersVerifyUpdate');
        Route::post('usersVerificationMailSend/{id}','UsersController@usersVerificationMailSend');
        Route::group(['as'=>'admin.'], function () {
            Route::resource('contests','ContestsController');

            Route::group(['prefix'=>'contest','as'=>'contests.'], function () {
                Route::get('in_progress-contests','ContestsController@inProgressContests')->name('in_progress_contests');
                Route::get('complete-contests','ContestsController@completeContests')->name('complete_contests');

                Route::get('contest-judges/{slug}','ContestsController@contestJudges')->name('contest_judges');
                Route::delete('judges-destroy/{judge_id}/{contest_id}','ContestsController@judgesDestroy');

                Route::get('user-contestants/{slug}','ContestsController@contestContestants')->name('user_contestants');
                Route::delete('contestants-destroy/{contestant_id}/{contest_id}','ContestsController@contestantsDestroy');

                Route::get('expediters/{slug}','ContestsController@contestExpediters')->name('expediters');
                Route::delete('expediters-destroy/{expediter_id}/{contest_id}','ContestsController@expeditersDestroy');

                Route::get('contest-trainers/{slug}','ContestsController@contestTrainers')->name('contest_trainers');
                Route::delete('trainers-destroy/{trainer_id}/{contest_id}','ContestsController@trainersDestroy');

                Route::get('contest-promoters/{slug}','ContestsController@contestPromoters')->name('contest_promoters');
                Route::delete('promoters-destroy/{promoter_id}/{contest_id}','ContestsController@promoterDestroy');


            });

            Route::get('requested-users','RequestedUsersController@index')->name('requested_users');
            Route::get('requested-user/{user}','RequestedUsersController@show')->name('requested_users.show');

            Route::get('requested-judges','RequestedJudgesController@requestedJudges')->name('requested_judges');
            Route::get('all-judges','RequestedJudgesController@allJudges')->name('all_judges');

            Route::get('requested-promoters','RequestedPromotersController@requestedPromoters')->name('requested_promoters');
            Route::get('all-promoters','RequestedPromotersController@allPromoters')->name('all_promoters');

            Route::get('requested-expediters','RequestedExpeditersController@requestedExpediters')->name('requested_expediters');
            Route::get('all-expediters','RequestedExpeditersController@allExpediters')->name('all_expediters');

            Route::get('requested-trainers','RequestedTrainersController@requestedTrainers')->name('requested_trainers');
            Route::get('all-trainers','RequestedTrainersController@allTrainers')->name('all_trainers');

            Route::get('requested-starting-contests','RequestedStartingContest@index')->name('requested_starting_contests');
            Route::get('requested-completion-contests','RequestedCompletionContest@index')->name('requested_completion_contests');

            Route::get('approved-users-email/{id}','RequestedUsersController@UserApprovalEmail')->name('approved-users-email');
            Route::get('decline-users/{id}','RequestedUsersController@destroy');

            Route::get('admin_approved_judge_and_send_email/{contest_id}/{user_id}','RequestedJudgesController@AdminApprovedJudgeAndSendEmail')->name('admin_email_to_approved_judge');
            Route::get('admin_decline_the_judge_request/{contest_id}/{user_id}','RequestedJudgesController@destroy');
//////
            Route::get('admin_approved_promoter_and_send_email/{contest_id}/{user_id}','RequestedPromotersController@AdminApprovedPromoterAndSendEmail')->name('admin_email_to_approved_promoter');
            Route::get('admin_decline_the_promoter_request/{contest_id}/{user_id}','RequestedPromotersController@destroy');

            Route::get('admin_approved_expediter_and_send_email/{contest_id}/{user_id}','RequestedExpeditersController@AdminApprovedExpediterAndSendEmail')->name('admin_email_to_approved_expediter');
            Route::get('admin_decline_the_expediter_request/{contest_id}/{user_id}','RequestedExpeditersController@destroy');

            Route::get('admin_approved_trainer_and_send_email/{contest_id}/{user_id}','RequestedTrainersController@AdminApprovedTrainerAndSendEmail')->name('admin_email_to_approved_trainer');
            Route::get('admin_decline_the_trainer_request/{contest_id}/{user_id}','RequestedTrainersController@destroy');
/////
            Route::get('admin_email_to_completion_contest/{contest_id}/{user_id}','RequestedCompletionContest@RequestedCompletionApprovalEmail')->name('admin_email_to_completion_contest');
            Route::get('admin_decline_to_completion_contest/{contest_id}/{user_id}','RequestedCompletionContest@destroy');

            Route::get('admin_email_to_starting_contest/{contest_id}/{user_id}','RequestedStartingContest@RequestedStartingApprovalEmail')->name('admin_email_to_starting_contest');
            Route::get('admin_decline_to_starting_contest/{contest_id}/{user_id}','RequestedStartingContest@destroy');

            Route::get('admin_start_contest/{contest_id}','ContestsController@directStartContests')->name('admin_start_contest');
            Route::get('admin_complete_contest/{contest_id}','ContestsController@directCompleteContests')->name('admin_complete_contest');

        });

        Route::group(array('prefix'=>'reports'), function (){
            Route::get('facebook','ReportsController@indexFacebook');
            Route::get('twitter','ReportsController@indexTwitter');
            Route::get('emails','ReportsController@indexEmail');
            Route::get('addresses','ReportsController@indexAddress');
            Route::get('registrations','ReportsController@indexRegistration');
            Route::get('district-memberships','ReportsController@indexDistrictMembership');
            Route::get('district-memberships-by-country','ReportsController@indexDistrictMembershipCountry');
            Route::get('athletes','ReportsController@indexAthlete');
            Route::get('non-athletes','ReportsController@indexNonAthlete');
            Route::get('pro-athletes','ReportsController@indexProAthlete');
            Route::get('district-chairman','ReportsController@indexDistrictChairman');

            Route::get('facebook/{id}','ReportsController@showFacebook');
            Route::get('twitter/{id}','ReportsController@showTwitter');
            Route::get('emails/{id}','ReportsController@showEmail');
            Route::get('addresses/{id}','ReportsController@showAddress');
            Route::get('registrations/{id}','ReportsController@showRegistration');
            Route::get('district-memberships/{id}','ReportsController@showDistrictMembership');
            Route::get('athletes/{id}','ReportsController@showAthlete');
            Route::get('non-athletes/{id}','ReportsController@showNonAthlete');
            Route::get('pro-athletes/{id}','ReportsController@showProAthlete');
            Route::get('district-chairman/{id}','ReportsController@showDistrictChairman');

        });
    });
});
// User's Detail Page at admin pannel:

//views/admin/show.blade.php
//views/admin/users/show.blade.php
//views/admin/requested_users/show.blade.php

