<?php
//app landing page
Route::get('/', 'GuestController@mobile_landing_page')->name('mobile.app.landing');
Auth::routes();
//guest routess
Route::get('/',  'GuestController@handle_landing_request')->name('handle_landing_request');
Route::get('app/',  'GuestController@handle_landing_request')->name('handle_landing_request');
Route::get('/links',  'GuestController@links')->name('links');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/root', 'GuestController@mobile_landing_page')->name('guest_mobile_landing_page');
Route::post('/register_user', 'UserController@register_user')->name('register_user');
//register home controller routes
Route::post('/register', 'RegisterHomeController@register')->name('register');
Route::get('/register_1', 'RegisterHomeController@register_step_1')->name('register_1');
Route::get('/register_2', 'RegisterHomeController@register_step_2')->name('register_2');
Route::get('/register_3', 'RegisterHomeController@register_step_3')->name('register_3');
Route::get('/register_4', 'RegisterHomeController@register_step_4')->name('register_4');
//user account update routes
Route::post('app/user/register_user', 'UserController@user_update_account_details')->name('app_user_update_account_details');
//service seeker routes
Route::group(['middleware' => ['auth', 'isPhoneVerified']] , function () {
  Route::get('/service_seeker/home',  'ServiceSeekerController@service_seeker_home')->name('service_seeker_home');
  Route::get('/jobs/service_provider/profile/1',  'ServiceSeekerController@service_seeker_service_provider_profile')->name('service_seeker_service_provider_profile');
  Route::get('/service_seeker/profile/',  'ServiceSeekerController@service_seeker_profile')->name('service_seeker_profile');
  Route::get('/service_seeker/more/',  'ServiceSeekerController@service_seeker_more')->name('service_seeker_more');
  Route::get('/service_seeker/more/faqs',  'ServiceSeekerController@service_seeker_more_faqs')->name('service_seeker_more_faqs');
  Route::get('/service_seeker/more/wallet',  'ServiceSeekerController@service_seeker_more_wallet')->name('service_seeker_more_wallet');
  Route::get('/service_seeker/more/help',  'ServiceSeekerController@service_seeker_more_help')->name('service_seeker_more_help');
  //profile routes
  Route::post('/service_seeker/job/details/update', 'ServiceSeekerController@service_seeker_job_details_update')->name('service_seeker_job_details_update');
  //jobs routes
  Route::get('/service_seeker/jobs', 'ServiceSeekerJobController@show_jobs')->name('service_seeker_jobs');
  Route::get('/service_seeker/jobs/job/{id}', 'ServiceSeekerJobController@show_job')->name('service_seeker_job');
  Route::post('/service_seeker/jobs/request/submit', 'JobController@request_job')->name('service_seeker_jobs_request_submit');
  Route::post('/service_seeker/jobs/filter', 'ServiceSeekerJobController@filter_jobs')->name('service_seeker_jobs_filter');
  //individual job routes
  Route::post('/serivce_seeker/jobs/job/{id}/filter', 'ServiceSeekerJobController@filter_job_offer')->name('service_seeker_job_offer_filter');
  //message job route
  Route::get('/service_seeker/messages', 'ServiceSeekerController@service_seeker_messages')->name('service_seeker_messages');
  Route::post('/serivce_seeker/messages/offer/{id}', 'ServiceSeekerController@show_message_offer')->name('service_seeker_message_offer');
  //Route::post('/serivce_seeker/jobs/job/{id}/filter', 'ServiceSeekerJobController@filter_job_offer')->name('service_seeker_job_offer_filter');
  //Conversation routes
  Route::get('service_seeker/jobs/job/conversation/{job_id}/{service_provider_id}/{source}', 'ServiceSeekerJobController@show_job_conversation' )->name('service_seeker_job_conversation');
  Route::post('service_seeker/jobs/job/conversation/send_message', 'ServiceSeekerJobController@send_message')->name('service_seeker_job_conversation_message_send');
  Route::post('/service_seeker/jobs/job/conversation/check_new_messages', 'ServiceSeekerJobController@check_new_messages')->name('service_seeker_check_new_messages');
  Route::post('/service_seeker/jobs/job/{job_id}/{conversation_id}/offer/accept', 'ServiceSeekerJobController@accept_offer')->name('service_seeker_accept_job');
  Route::post('/service_seeker/jobs/job/{job_id}/{conversation_id}/offer/reject', 'ServiceSeekerJobController@reject_offer')->name('service_seeker_reject_job');
  Route::post('/service_seeker/job/request/draft', 'ServiceSeekerJobController@request_job_draft')->name('service_seeker_job_request_draft');
  Route::post('/service_seeker/job/clear/draft', 'ServiceSeekerJobController@clear_job_draft')->name('service_seeker_job_clear_draft');
  Route::post('/service_seeker/job/request/submit', 'ServiceSeekerJobController@request_job')->name('service_seeker_job_request_submit');
  //ajax call routes
  Route::post('/service_seeker/services/subcategories/fetch', 'ServiceSeekerController@fetch_service_sub_categories')->name('service_seeker_subcategories_fetch');
  Route::post('/service_seeker/preferences/update', 'ServiceSeekerController@update_preferences')->name('service_seeker_preferences_update');
  Route::post('/service_seeker/services/filter', 'ServiceSeekerController@services_filter')->name('service_seeker_services_filter');
  Route::get('/service_seeker/timer', 'ServiceSeekerJobController@timer')->name('service_provider_timer');
});

Route::group(['middleware' => ['auth', 'isPhoneVerified']] , function () {
  Route::get('/service_provider/register/business',  'ServiceProviderBusinessController@registration_page')->name('service_provider_register_business');
  Route::post('/service_provider/register/business',  'ServiceProviderBusinessController@registration_process')->name('service_provider_register_business_process');
  Route::get('/service_provider/register/services',  'ServiceProviderBusinessController@service_registration_page')->name('service_provider_register_services');
  Route::post('/service_subscription/fetch', 'ServiceSubscriptionController@fetch_services_active')->name('service_subcription_services_fetch_active');
  Route::post('/service_subscription/add', 'ServiceSubscriptionController@service_add')->name('service_subcription_services_add');
  Route::post('/service_subscription/remove', 'ServiceSubscriptionController@service_remove')->name('service_subcription_services_remove');
  //certificate routes
  Route::get('/service_provider/register/certificates',  'CertificateController@show_registration_page')->name('service_provider_register_certificate');
  Route::post('/service_provider/register/certificates/upload',  'CertificateController@registration_process')->name('service_provider_register_certificate_process');
  Route::get('/service_provider/certificates/delete/{id}',  'CertificateController@delete')->name('service_provider_delete_certificate');
  Route::get('/service_provider/register/completed',  'ServiceProviderController@registration_completed')->name('service_provider_register_completed');
  ///langauge registration routes
  Route::get('/service_provider/register/languages',  'ServiceProviderLanguagesController@show_registration_page')->name('service_provider_register_langauges');
  Route::post('/service_provider/register/languages/upload',  'ServiceProviderLanguagesController@registration_process')->name('service_provider_register_language_process');
  Route::get('/service_provider/language/delete/{id}',  'ServiceProviderLanguagesController@delete')->name('service_provider_delete_language');
});

//Service Provider Routes
Route::group(['middleware' => ['auth', 'isPhoneVerified', 'isServiceProvider']] , function () {
  //navigational routes
  Route::get('/service_provider/home',  'ServiceProviderController@home')->name('service_provider_home');
  Route::get('/service_provider/profile/nested',  'ServiceProviderController@service_provider_profile_nested')->name('service_provider_profile_nested');
  Route::get('/service_provider/profile/edit',  'ServiceProviderController@service_provider_profile_edit')->name('service_provider_profile_edit');
  Route::get('/sevrice_provider/profle/update_service_preferences', 'ServiceProviderController@service_provider_update_service_preferences')->name('service_provider_profile_update_service_preferences');
  Route::get('/sevrice_provider/profle/update_certificate_preferences', 'ServiceProviderController@service_provider_update_certificate_preferences')->name('service_provider_profile_update_certificate_preferences');
  Route::get('/sevrice_provider/profle/update_languages_preferences', 'ServiceProviderController@service_provider_update_languages_preferences')->name('service_provider_profile_update_languages_preferences');
  Route::get('/service_provider/jobs/history',  'ServiceProviderController@service_provider_jobs_history')->name('service_provider_jobs_history');
  Route::get('/service_provider/jobs/full_history',  'ServiceProviderController@service_provider_jobs_full_history')->name('service_provider_jobs_full_history');
  Route::get('/service_provider/more/',  'ServiceProviderController@service_provider_more')->name('service_provider_more');
  Route::get('/service_provider/more/faqs',  'ServiceProviderController@service_provider_more_faqs')->name('service_provider_more_faqs');
  Route::get('/service_provider/more/wallet',  'ServiceProviderController@service_provider_more_wallet')->name('service_provider_more_wallet');
  Route::get('/service_provider/more/help',  'ServiceProviderController@service_provider_more_help')->name('service_provider_more_help');
  //Anuj Service Provider Home Jobs Routes
  Route::post('/service_provider/jobs/fetch/all', 'ServiceProviderJobController@fetch_all_jobs')->name('service_provider_jobs_fetch_all');
  //Route::post('/service_provider/home/jobs/filter','ServiceProviderJobController@home_job_filter')->name('service_provider_home_filter_jobs');
  //Service Provider Job Routes
  Route::get('/service_provider/jobs/job/{id}', 'ServiceProviderJobController@show_job')->name('service_provider_job');
  Route::post('/service_provider/jobs/job/offer', 'ServiceProviderJobController@make_offer')->name('service_provider_job_make_offer');
  Route::post('/service_provider/jobs/job/offer/duplicate', 'ServiceProviderJobController@check_offer_exists')->name('service_provider_offer_exists');
  //service provider navigate to job route
  Route::post('/service_provider/jobs/job/update/ontrip', 'ServiceProviderJobController@update_status_ontrip')->name('service_provider_job_update_status_ontrip');
  Route::post('/service_provider/jobs/job/update/cancelontrip', 'ServiceProviderJobController@update_status_cancelontrip')->name('service_provider_job_update_status_cancelontrip');
  Route::post('/service_provider/jobs/job/update/mark_arrived', 'ServiceProviderJobController@update_status_mark_arrived')->name('service_provider_job_update_status_mark_arrived');
  Route::post('/service_provider/jobs/job/update/mark_started', 'ServiceProviderJobController@update_status_mark_started')->name('service_provider_job_update_status_mark_started');
  Route::post('/service_provider/jobs/job/update/mark_completed', 'ServiceProviderJobController@update_status_mark_completed')->name('service_provider_job_update_status_mark_completed');
  //service provider rating update
  Route::post('/service_provider/jobs/job/update/rating', 'ServiceProviderJobController@update_rating')->name('service_provider_job_update_rating');
  // Route::get('/service_provider/jobs/job/conversation/{job_id}/{service_provider_id}', 'ServiceProviderJobController@show_job_detail_pending' )->name('service_provider_job_detail');
  Route::get('/service_provider/jobs/job/conversation/{job_id}/{service_provider_id}', 'ServiceProviderJobController@show_job_conversation' )->name('service_provider_job_conversation');
  Route::post('/service_provider/jobs/job/conversation/send_message', 'ServiceProviderJobController@send_message')->name('service_seeker_job_conversation_message_send');
  Route::post('/service_provider/jobs/job/conversation/check_new_messages', 'ServiceProviderJobController@check_new_messages')->name('service_provider_check_new_messages');
  //invocie routes
  Route::get('/service_provider/jobs/job/email_invoice/{id}', 'ServiceProviderJobController@service_provider_email_invoice' )->name('service_provider_job_email_invoice');
});

Route::group(['middleware' => 'auth' ], function () {
  Route::get('/user/mobile_verification/send', 'PhoneVerificationController@send')->name('user_verify_phone_send');
  Route::get('/user/mobile_verification/submit', 'PhoneVerificationController@submit')->name('user_verify_phone_submit');
  Route::post('/user/mobile_verification/submit_code', 'PhoneVerificationController@requestcode')->name('user_phone_number_verification_requestcode');
  Route::post('/user/mobile_verification/verify_code', 'PhoneVerificationController@verify')->name('user_phone_number_verification_submitcode');

  //image processor routes
  Route::post('imageservice/images/image_upload', 'JobAttachmentController@store_images')->name('imageservice_images_upload');
  Route::post('imageservice/images/fetch/', 'JobAttachmentController@retrive_job_images')->name('imageservice_images_fetch');
  Route::post('imageservice/images/delete/', 'JobAttachmentController@remove_job_images')->name('imageservice_images_delete');
  Route::post('imageservice/images/user/profile_image_upload', 'UserController@upload_user_profile_image')->name('imageservice_images_user_profile_image_upload');

  //storage directory links
  Route::get('storage/images/profile/{filename}', 'ImageStorageController@make_profile_image_link');
  Route::get('storage/job_attachments/{filename}', 'ImageStorageController@make_job_attachment_image_link');
});
//rating routes
Route::post('/addRating', 'JobController@addRating');
//job extras controlle routes
Route::group(['middleware' => ['auth', 'isPhoneVerified', 'isServiceProvider']] , function () {
  Route::post('app/services/jobs/extras/add', 'JobExtraController@store')->name('app_services_job_extra_add');
  Route::get('app/services/jobs/extras/remove/{id}', 'JobExtraController@remove')->name('app_services_job_extra_remove');
});

//demo/test route links
Route::get('/demo/car_map_demo', 'DemoController@car_map_demo')->name('demo_car_map_demo');
Route::get('/demo/test2', 'DemoController@test2');
Route::get('/demo/create_demo_jobs', 'DemoController@create_demo_jobs');
Route::get('/demo/test_sp_invoice_template_design/{id}', 'DemoController@test_sp_invoice_template_design');





