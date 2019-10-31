<?php

Auth::routes();
//Frontend Routes
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::view('404', '404')->name('404');

Route::post('forgot-pass', 'User\UserController@forgotPass')->name('forgot.pass');
Route::get('reset/{token}', 'User\UserController@resetLink')->name('reset.passlink');
Route::post('reset/password', 'User\UserController@passwordReset')->name('reset.pass');

Route::get('dbdownload', 'Admin\AdminController@dbdownload')->name('db.download');
//User Routes
Route::group(['prefix' => 'user'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('authorization', 'User\UserController@authCheck')->name('user.authorization');
        Route::post('authorization', 'User\UserController@authorization')->name('user.auth');
        Route::post('reAuthorization', 'User\UserController@reAuthorization')->name('user.reauth');
        Route::post('check2StepAuth', 'User\UserController@check2StepAuth')->name('user.chk2step');
        Route::middleware(['checkstatus'])->group(function () {
            Route::get('dashboard', 'User\UserController@index')->name('user.home');
            Route::get('myProfile', 'User\UserController@profile')->name('my.profile');
            Route::post('myProfile', 'User\UserController@updateProfile')->name('user.profile.update');

            Route::get('smsPlans', 'User\UserController@smsPlans')->name('user.sms.plan');

            Route::get('coverage', 'User\UserController@coverage')->name('user.coverage');

            Route::get('sendSMS', 'User\UserController@sendSMS')->name('user.sms.send');
            Route::post('sendSMS', 'User\UserController@deliverSMS')->name('user.send.sms');

            Route::get('apiDocumentation', 'User\UserController@apiDocumentation')->name('api.doc');
            Route::get('generateKey', 'User\UserController@generateKey')->name('key.generate');

            Route::get('myClients', 'User\UserController@myClients')->name('user.clients');
            Route::post('searchClients', 'User\UserController@searchClients')->name('search.clients');
            Route::get('clientDetails/{id}', 'User\UserController@clientDetails')->name('client.details');
            Route::get('clientTransactions/{id}', 'User\UserController@clientTransaction')->name('client.transaction');
            Route::get('clientSms/{id}', 'User\UserController@clientSmslog')->name('client.sms.log');
            Route::put('clientPass/{id}', 'User\UserController@clientPass')->name('client.pass');
            Route::put('clientSMS/{id}', 'User\UserController@clientSMS')->name('client.sms');
            Route::put('clientUpdate/{id}', 'User\UserController@clientUpdate')->name('client.update');
            Route::get('addClient', 'User\UserController@addClient')->name('add.client');
            Route::post('addClient', 'User\UserController@storeClient')->name('store.client');
            Route::get('mail/{user}', 'User\UserController@email')->name('user.users.email');
            Route::post('sendmail', 'User\UserController@sendemail')->name('user.send.email');
            Route::get('broadcast', 'User\UserController@broadcast')->name('user.broadcast');
            Route::post('broadcast', 'User\UserController@broadcastemail')->name('user.broadcast.email');

            Route::get('smsLog', 'User\UserController@smsLog')->name('user.smsLog');
            Route::get('transactionLog', 'User\UserController@transactionLog')->name('user.transactionLog');

            Route::get('changePassword', 'User\UserController@changePassword')->name('change.password');
            Route::post('changePassword', 'User\UserController@passwordChange')->name('user.pass.change');

            Route::get('verification', 'User\UserController@verification')->name('user.verification');
            Route::post('verification', 'User\UserController@verificationStatus')->name('user.verification.status');

            Route::get('supportTicket', 'User\UserController@supportTicket')->name('user.ticket');
            Route::get('openSupportTicket', 'User\UserController@openSupportTicket')->name('user.ticket.open');
            Route::post('openSupportTicket', 'User\UserController@storeSupportTicket')->name('user.ticket.store');
            Route::get('supportMessage/{ticket}', 'User\UserController@supportMessage')->name('user.message');
            Route::put('storeSupportMessage/{ticket}', 'User\UserController@supportMessageStore')->name('user.message.store');
        });
    });
});
//Admin Routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\LoginController@showLoginForm')->middleware('guest:admin');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('passwordChange', 'Admin\AdminController@password')->name('admin.pass');
        Route::post('passwordChange', 'Admin\AdminController@passwordChange')->name('admin.pass.change');

        Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

        Route::get('coverage', 'Admin\AdminController@coverage')->name('coverage');
        Route::post('coverage', 'Admin\AdminController@coverageStore')->name('coverage.store');
        Route::put('coverage/{id}', 'Admin\AdminController@coverageEdit')->name('coverage.status');
        Route::delete('coveragedelete/{id}', 'Admin\AdminController@coverageDelete')->name('coverage.delete');

        Route::get('smsGatewayList', 'Admin\AdminController@smsGateway')->name('sms.gateway.list');
        Route::put('smsGatewayList/{id}', 'Admin\AdminController@smsGatewayEdit')->name('sms.gateway.edit');

        Route::get('sendSMS','Admin\AdminController@sendSMS')->name('admin.send.sms');
        Route::post('sendSMS','Admin\AdminController@deliverSMS')->name('admin.sms.send');

        Route::get('dbBackup', 'Admin\AdminController@dbBackup')->name('db.backup');

        Route::get('plan', 'Admin\AdminController@plan')->name('admin.plan');
        Route::post('plan', 'Admin\AdminController@planStore')->name('plan.store');
        Route::put('planUpdate/{id}', 'Admin\AdminController@planUpdate')->name('plan.update');

        Route::get('supportTickets', 'Admin\AdminController@supportTicket')->name('admin.ticket');
        Route::get('ticketReply/{id}', 'Admin\AdminController@ticketReply')->name('admin.ticket.reply');
        Route::get('pendingSupportTickets', 'Admin\AdminController@pendingSupportTicket')->name('admin.pending.ticket');
        Route::put('ticketReplySend/{id}', 'Admin\AdminController@ticketReplySend')->name('admin.ticket.send');

        Route::get('users', 'Admin\AdminController@userIndex')->name('admin.users');
        Route::post('user-search', 'Admin\AdminController@userSearch')->name('admin.search-users');
        Route::get('user/{user}', 'Admin\AdminController@singleUser')->name('admin.user-single');
        Route::put('user-status/{user}', 'Admin\AdminController@uerRoll')->name('admin.user-roll');
        Route::get('transactions/{id}', 'Admin\AdminController@userTransaction')->name('single.transaction');
        Route::get('sms/{id}', 'Admin\AdminController@userSms')->name('single.sms');
        Route::get('user-banned', 'Admin\AdminController@bannedUser')->name('admin.user-ban');
        Route::get('mail/{user}', 'Admin\AdminController@email')->name('admin.user-email');
        Route::post('sendmail', 'Admin\AdminController@sendemail')->name('admin.send-email');
        Route::put('user/pass-change/{user}', 'Admin\AdminController@userPasschange')->name('admin.user-pass');
        Route::put('user/sms-balance/{user}', 'Admin\AdminController@userSMSBalance')->name('admin.user-sms');
        Route::put('clientGateway/{id}', 'Admin\AdminController@clientGateway')->name('client.gateway');
        Route::put('user/status/{user}', 'Admin\AdminController@statupdate')->name('admin.user-status');
        Route::get('broadcast', 'Admin\AdminController@broadcast')->name('admin.broadcast');
        Route::post('broadcast/email', 'Admin\AdminController@broadcastemail')->name('admin.broadcast-email');

        Route::get('transactionLogs', 'Admin\AdminController@transactionLogs')->name('admin.transaction');
        Route::get('smsLog', 'Admin\AdminController@smsLog')->name('admin.smsLog');

        Route::get('generalSetting', 'Admin\WebsiteController@genSetting')->name('admin.GenSetting');
        Route::post('generalSetting', 'Admin\WebsiteController@updateGenSetting')->name('admin.UpdateGenSetting');

        Route::get('emailSetting', 'Admin\WebsiteController@emailSetting')->name('admin.EmailSetting');
        Route::post('emailSetting', 'Admin\WebsiteController@updateEmailSetting')->name('admin.UpdateEmailSetting');

        Route::get('smsSetting', 'Admin\WebsiteController@smsSetting')->name('admin.smsSetting');
        Route::post('updateSmsSetting', 'Admin\WebsiteController@updateSmsSetting')->name('admin.UpdateSmsSetting');

        Route::view('logoFaviconSettings', 'admin.interface.logoicon')->name('logoicon');
        Route::post('logoFaviconSettings', 'Admin\InterfaceController@logoIconUpdate')->name('logoicon.update');

        Route::get('contactSetting', 'Admin\InterfaceController@contact')->name('admin.contact');
        Route::post('contactSetting', 'Admin\InterfaceController@contactStore')->name('admin.contact.store');
    });
});