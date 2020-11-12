<?php
//app landing page
Route::get('/', 'FrontendController@homepage')->name('app_frontend_homepage');
Route::get('/faq', 'FrontendController@faq')->name('app_frontend_faq');
Route::get('/support', 'FrontendController@support')->name('app_frontend_support');


Auth::routes();
//guest routess
Route::get('/root', 'GuestController@mobile_landing_page');
Route::get('/app/root',  'GuestController@mobile_landing_page')->name('handle_landing_request');
Route::get('/app/android/root',  'GuestController@mobile_landing_page')->name('handle_landing_request');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('app/mobile/root', 'GuestController@mobile_landing_page')->name('guest_mobile_landing_page');
Route::post('/guest/register', 'GuestController@handle_guest_register_request')->name('guest_register');
Route::get('/app/register', 'RegisterHomeController@register')->name('app_register');
Route::get('/guest/service_seeker/home', 'GuestController@service_seeker_home')->name('guest_service_seeker_home');
Route::post('/guest/service_seeker/services/service_providers_nearby/fetch', 'GuestController@fetch_service_provider_nearby')->name('guest_service_seeker_services_service_providers_nearby_fetch');
Route::post('/guest/register_user', 'UserController@register_user')->name('guest_register_user');
Route::post('/guest/service_seeker/services/subcategories/fetch', 'ServiceSeekerController@fetch_service_sub_categories')->name('service_seeker_subcategories_fetch');
Route::post('/guest/service_seeker/services/filter', 'ServiceSeekerController@services_filter')->name('guest_service_seeker_services_filter');


//manage service seeker draft job
Route::post('/guest/service_seeker/session/create_draft_job', 'GuestController@create_draft_job')->name('guest_service_seeker_session_create_draft_job');
Route::post('/guest/service_seeker/session/retrieve_session_draft_job', 'GuestController@retrieve_draft_job')->name('guest_service_seeker_session_retrieve_session_draft_job');
Route::post('/guest/service_seeker/session/retrieve_session_draft_sp_list', 'GuestController@retrieve_session_draft_sp_list')->name('guest_service_seeker_session_retrieve_session_draft_sp_list');
Route::post('/guest/service_seeker/session/retrieve_session_draft_sp_info', 'GuestController@retrieve_session_draft_sp_info')->name('guest_service_seeker_session_retrieve_session_draft_sp_info');


//service provider demo routes
Route::get('/guest/service_provider/home', 'GuestController@service_provider_home')->name('guest_service_provider_home');
Route::post('/guest/service_provider/jobs/fetch/all', 'GuestController@service_provider_fetch_all_jobs')->name('guest_service_provider_jobs_fetch_all');
Route::get('/guest/service_provider/jobs/job/{id}', 'GuestController@service_provider_show_job')->name('guest_service_provider_job');
Route::post('/guest/imageservice/images/fetch/', 'JobAttachmentController@retrive_job_images')->name('guest_imageservice_images_fetch');
Route::get('/guest/storage/images/profile/{filename}', 'ImageStorageController@make_profile_image_link');
Route::get('/guest/storage/job_attachments/{filename}', 'ImageStorageController@make_job_attachment_image_link');


//session draft job attachment storage routes
Route::post('guest/imageservice/images/image_upload', 'GuestController@store_session_draft_job_attachment')->name('guest_imageservice_images_upload');
Route::post('guest/imageservice/images/fetch/', 'GuestController@retrieve_session_draft_job_attachment')->name('guest_imageservice_images_fetch');
Route::post('guest/imageservice/images/delete/', 'GuestController@remove_job_images')->name('guest_imageservice_images_delete');
Route::get('guest/storage/job_attachments/{filename}', 'ImageStorageController@make_job_attachment_image_link');


//register home controller routes
Route::post('/register', 'RegisterHomeController@register')->name('register');


//user account update routes
Route::post('app/user/update_account_information', 'UserController@user_update_account_details')->name('app_user_update_account_information');
Route::post('app/user/update_password_information', 'UserController@update_account_password')->name('app_user_update_password_information');


//service seeker routes
Route::group(['middleware' => ['auth', 'isPhoneVerified']] , function () {
  Route::get('/service_seeker/registration_completed',  'ServiceSeekerController@registration_completed')->name('service_seeker_registration_completed');
  Route::get('/service_seeker/home',  'ServiceSeekerController@service_seeker_home')->name('service_seeker_home');
  Route::get('/service_seeker/profile/',  'ServiceSeekerController@service_seeker_profile')->name('service_seeker_profile');
  Route::get('/service_seeker/more/',  'ServiceSeekerController@service_seeker_more')->name('service_seeker_more');
  Route::get('/service_seeker/more/faqs',  'ServiceSeekerController@service_seeker_more_faqs')->name('service_seeker_more_faqs');
  Route::get('/service_seeker/more/wallet',  'ServiceSeekerController@service_seeker_more_wallet')->name('service_seeker_more_wallet');
  Route::get('/service_seeker/more/help',  'ServiceSeekerController@service_seeker_more_help')->name('service_seeker_more_help');
  Route::post('/service_seeker/services/subcategories/fetch', 'ServiceSeekerController@fetch_service_sub_categories')->name('service_seeker_subcategories_fetch');
  Route::post('/service_seeker/services/filter', 'ServiceSeekerController@services_filter')->name('service_seeker_services_filter');
  Route::get('/service_seeker/jobs/full_history',  'ServiceSeekerController@service_seeker_jobs_full_history')->name('service_seeker_jobs_full_history');
  Route::post('/service_seeker/job/details/update', 'ServiceSeekerController@service_seeker_job_details_update')->name('service_seeker_job_details_update');
  Route::post('/service_seeker/job/location/update', 'ServiceSeekerController@service_seeker_job_location_update')->name('service_seeker_job_location_update');
  //jobs routes
  Route::get('/service_seeker/jobs/history', 'ServiceSeekerJobController@show_jobs')->name('service_seeker_jobs');
  Route::get('/service_seeker/jobs/job/{id}', 'ServiceSeekerJobController@show_job')->name('service_seeker_job');
  Route::get('/service_seeker/jobs/jobpay', 'JobPaymentController@process_job_payment')->name('service_seeker_process_job_payment');
  Route::post('/service_seeker/jobs/jobpay/pay_with_stripe', 'JobPaymentController@process_stripe_job_payment')->name('service_seeker_process_job_payment_pay_with_stripe');
  Route::post('/service_seeker/jobs/jobpay/pay_with_paypal', 'JobPaymentController@payWithpaypal')->name('service_seeker_process_job_payment_pay_with_paypal');
  Route::get('/service_seeker/jobs/jobpay/pay_with_paypal/status', 'JobPaymentController@getPaymentStatus')->name('service_seeker_process_job_payment_pay_with_paypal_status');
  

  Route::post('/service_seeker/jobs/request/type/board/submit', 'ServiceSeekerJobController@job_request_type_board')->name('service_seeker_jobs_request_type_board_subimt');
  Route::post('/service_seeker/jobs/filter', 'ServiceSeekerJobController@filter_jobs')->name('service_seeker_jobs_filter');
  //individual job routes
  Route::post('/serivce_seeker/jobs/job/data/filter', 'ServiceSeekerJobController@filter_job_offer')->name('service_seeker_job_offer_filter');
  Route::post('/serivce_seeker/jobs/job/{id}/map_data', 'ServiceSeekerJobController@map_data_job_offer')->name('service_seeker_job_offer_map_data');
  //message job route
  Route::get('/service_seeker/messages', 'ServiceSeekerController@service_seeker_messages')->name('service_seeker_messages');
  Route::post('/serivce_seeker/messages/offer/{id}', 'ServiceSeekerController@show_message_offer')->name('service_seeker_message_offer');
  //Route::post('/serivce_seeker/jobs/job/{id}/filter', 'ServiceSeekerJobController@filter_job_offer')->name('service_seeker_job_offer_filter');
  //Conversation routes
  Route::get('/service_seeker/jobs/service_provider/profile/{service_provider_id}',  'ServiceSeekerJobController@service_seeker_service_provider_profile')->name('service_seeker_service_provider_profile');
  Route::get('/service_seeker/jobs/job/conversation/{job_id}/{service_provider_id}/', 'ServiceSeekerJobController@show_job_conversation' )->name('service_seeker_job_conversation');
  Route::post('/service_seeker/jobs/job/conversation/send_message', 'ServiceSeekerJobController@send_message')->name('service_seeker_job_conversation_message_send');
  Route::post('/service_seeker/jobs/job/conversation/check_new_messages', 'ServiceSeekerJobController@check_new_messages')->name('service_seeker_check_new_messages');
  Route::post('/service_seeker/jobs/job/offer/accept', 'ServiceSeekerJobController@accept_offer')->name('service_seeker_accept_job');
  Route::post('/service_seeker/jobs/job/{job_id}/{conversation_id}/offer/reject', 'ServiceSeekerJobController@reject_offer')->name('service_seeker_reject_job');
  Route::post('/service_seeker/job/request/draft', 'ServiceSeekerJobController@request_job_draft')->name('service_seeker_job_request_draft');
  Route::post('/service_seeker/job/clear/draft', 'ServiceSeekerJobController@clear_job_draft')->name('service_seeker_job_clear_draft');
  Route::post('/service_seeker/job/request/submit', 'ServiceSeekerJobController@request_job')->name('service_seeker_job_request_submit');
  Route::get('/service_seeker/jobs/job/email_invoice/{id}', 'ServiceSeekerJobController@service_seeker_email_invoice' )->name('service_seeker_job_email_invoice');
  Route::post('/service_seeker/job/tracking/info/{id}', 'ServiceSeekerJobController@job_tracking_info')->name('service_seeker_job_tracking_info');
  Route::post('/service_seeker/job/request/update', 'ServiceSeekerJobController@job_request_stutus_update')->name('service_seeker_job_request_status_updte');
  Route::post('/service_seeker/job/request/provider_info', 'ServiceSeekerJobController@job_request_provider_info')->name('service_seeker_job_request_provider_info');
  //service seeker rating update
  Route::post('/service_seeker/jobs/job/update/rating', 'ServiceSeekerJobController@update_rating')->name('service_seeker_job_update_rating');
  //job cancel route
  Route::post('/service_seeker/jobs/action/cancel', 'ServiceSeekerJobController@service_seeker_job_cancel')->name('service_seeker_job_cancel');
  //post to job board
  Route::post('/service_seeker/jobs/action/posttojobboard', 'ServiceSeekerJobController@service_seeker_job_posttojobboard')->name('service_seeker_job_posttojobboard');
  //ajax call routes
  Route::post('/service_seeker/preferences/update', 'ServiceSeekerController@update_preferences')->name('service_seeker_preferences_update');
  Route::get('/service_seeker/timer', 'ServiceSeekerJobController@timer')->name('service_provider_timer');
  //services
  Route::post('/service_seeker/services/location/update',  'ServiceSeekerController@services_location_update')->name('service_seeker_services_location_update');
  //payment controller sources
  //stripe routes
  Route::post('/service_seeker/more/wallet/stripe/create_customer',  'ServiceSeekerStripePaymentController@create_customer')->name('service_seeker_more_wallet_stripe_create_customer');
  Route::post('/service_seeker/more/wallet/stripe/change_customer_default_card',  'ServiceSeekerStripePaymentController@change_customer_default_card')->name('service_seeker_more_wallet_stripe_change_customer_default_card');
  Route::get('/service_seeker/more/wallet/stripe/delete_customer_card/{id}',  'ServiceSeekerStripePaymentController@delete_customer_card')->name('service_seeker_more_wallet_stripe_delete_customer_card');
  //post job completion routes
  Route::post('/service_seeker/jobs/job_notify_job_completion/', 'PostJobCompletionController@job_notify_completion_confirmation')->name('service_seeker_job_notify_job_completion');
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
  Route::get('/sevrice_provider/profle/update_user_bio', 'ServiceProviderController@service_provider_update_user_bio_view')->name('service_provider_profile_update_user_bio');
  Route::post('/sevrice_provider/profle/update_user_bio', 'ServiceProviderController@service_provider_update_user_bio_save')->name('service_provider_profile_update_user_bio');
  Route::post('/service_provider/profile/business/update',  'ServiceProviderController@service_provider_profile_business_edit')->name('service_provider_profile_business_update');
  Route::get('/service_provider/jobs/history',  'ServiceProviderController@service_provider_jobs_history')->name('service_provider_jobs_history');
  Route::get('/service_provider/jobs/full_history',  'ServiceProviderController@service_provider_jobs_full_history')->name('service_provider_jobs_full_history');
  Route::get('/service_provider/more/',  'ServiceProviderController@service_provider_more')->name('service_provider_more');
  Route::get('/service_provider/more/faqs',  'ServiceProviderController@service_provider_more_faqs')->name('service_provider_more_faqs');
  Route::get('/service_provider/more/wallet',  'ServiceProviderController@service_provider_more_wallet')->name('service_provider_more_wallet');
  Route::get('/service_provider/more/help',  'ServiceProviderController@service_provider_more_help')->name('service_provider_more_help');
  //online status controller
  Route::post('/service_provider/services/update_availablity_status', 'ServiceProviderController@services_update_availablity_status')->name('service_provider_services_update_availablity_status');
  Route::post('/service_provider/services/location/update',  'ServiceProviderController@services_location_update')->name('service_provider_services_location_update');
  //Service Provider Job Routes
  Route::get('/service_provider/jobs/job/{id}', 'ServiceProviderJobController@show_job')->name('service_provider_job');
  //start a conversation without an offer
  Route::post('/service_provider/jobs/job/coversation/create', 'ServiceProviderJobController@create_conversation_without_offer')->name('service_provider_job_conversation_create');
  Route::post('/service_provider/jobs/job/offer', 'ServiceProviderJobController@make_offer')->name('service_provider_job_make_offer');
  Route::post('/service_provider/jobs/job/offer/duplicate', 'ServiceProviderJobController@check_offer_exists')->name('service_provider_offer_exists');
  Route::post('/service_provider/jobs/job/offer/accept/check', 'ServiceProviderJobController@check_if_offer_accepted')->name('service_provider_offer_accept_check');
  Route::post('/service_provider/jobs/filter', 'ServiceProviderJobController@filter_jobs')->name('service_provider_jobs_filter');
  Route::post('/service_provider/jobs/fetch/all', 'ServiceProviderJobController@fetch_all_jobs')->name('service_provider_jobs_fetch_all');
  //Service provider navigate to job route
  Route::post('/service_provider/jobs/job/update/ontrip', 'ServiceProviderJobController@update_status_ontrip')->name('service_provider_job_update_status_ontrip');
  Route::post('/service_provider/jobs/job/update/cancelontrip', 'ServiceProviderJobController@update_status_cancelontrip')->name('service_provider_job_update_status_cancelontrip');
  Route::post('/service_provider/jobs/job/update/mark_arrived', 'ServiceProviderJobController@update_status_mark_arrived')->name('service_provider_job_update_status_mark_arrived');
  Route::post('/service_provider/jobs/job/update/mark_started', 'ServiceProviderJobController@update_status_mark_started')->name('service_provider_job_update_status_mark_started');
  Route::post('/service_provider/jobs/job/update/mark_completed', 'ServiceProviderJobController@update_status_mark_completed')->name('service_provider_job_update_status_mark_completed');
  //Service provider rating update
  Route::post('/service_provider/jobs/job/update/rating', 'ServiceProviderJobController@update_rating')->name('service_provider_job_update_rating');
  //Route::get('/service_provider/jobs/job/conversation/{job_id}/{service_provider_id}', 'ServiceProviderJobController@show_job_detail_pending' )->name('service_provider_job_detail');
  Route::get('/service_provider/jobs/job/conversation/{job_id}/{service_provider_id}', 'ServiceProviderJobController@show_job_conversation' )->name('service_provider_job_conversation');
  Route::post('/service_provider/jobs/job/conversation/send_message', 'ServiceProviderJobController@send_message')->name('service_seeker_job_conversation_message_send');
  Route::post('/service_provider/jobs/job/conversation/check_new_messages', 'ServiceProviderJobController@check_new_messages')->name('service_provider_check_new_messages');
  //invocie routes
  Route::get('/service_provider/jobs/job/email_invoice/{id}', 'ServiceProviderJobController@service_provider_email_invoice' )->name('service_provider_job_email_invoice');
  //job cancel route
  Route::post('/service_provider/jobs/job/cancel', 'ServiceProviderJobController@service_provider_job_cancel')->name('service_provider_job_cancel');
  //post job completion routes
  Route::post('/service_provider/jobs/job_notify_job_completion/', 'PostJobCompletionController@job_notify_completion_confirmation')->name('service_provider_job_notify_job_completion');
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

  Route::get('/fetch/job_attachments/{id}', 'ImageStorageController@make_job_attachment_image_link');
});


//job extras controlle routes
Route::group(['middleware' => ['auth', 'isPhoneVerified', 'isServiceProvider']] , function () {
  Route::post('app/services/jobs/extras/add', 'JobExtraController@store')->name('app_services_job_extra_add');
  Route::get('app/services/jobs/extras/remove/{id}', 'JobExtraController@remove')->name('app_services_job_extra_remove');
});


//helpdesk routes
Route::post('app/services/support/send_support_email', 'HelpdeskController@send_support_email')->name('app_services_support_send_support_email')->middleware('auth');



//Service Provider Portal routes
Route::group(['middleware' => ['auth', 'isPhoneVerified', 'isServiceProvider']] , function () {
  Route::get('/app/portal/provider/home', 'ProviderPortalController@display_home')->name('app_portal_provider_home');
  Route::get('/app/portal/provider/banking', 'ProviderPortalController@display_banking')->name('app_portal_provider_banking');
  Route::get('/app/portal/provider/invoices', 'ProviderPortalController@display_invoices')->name('app_portal_provider_inovices');
  Route::get('/app/portal/provider/invoice/download/{id}', 'ProviderPortalController@download_invoice')->name('app_portal_provider_inovice_download');
  //short url for provider banking page
  Route::get('/banking', 'ProviderPortalController@redirect_to_banking_page');
  Route::get('/app/portal/provider/banking/stripe/connect/onboarding', 'StripeConnectController@store_stripe_connect_account')->name('app_portal_provider_banking_stripe_onboarding');
  Route::get('/app/portal/provider/banking/stripe/connect/single_sign_on_link', 'StripeConnectController@single_sign_on_link')->name('app_portal_provider_banking_single_on_link');
});


//cookie controller routes
Route::get('/app/session/set/user_offline_consent', 'SessionController@set_user_offline_consent')->name('app_session_set_user_offline_consent');


//Service Provider Portal routes
Route::group(['middleware' => ['auth', 'isPhoneVerified','admin_routes']] , function () {
  Route::get('/app/portal/admin/home', 'AdminController@home')->name('app_portal_admin_home');
  Route::get('/app/portal/admin/users/all', 'AdminController@users_all')->name('app_portal_admin_users_all');
  Route::get('/app/portal/admin/users/profile/{id}', 'AdminController@user_profile')->name('app_portal_admin_users_profile');
  Route::post('/app/portal/admin/users/update_user_profile_info/', 'AdminController@update_user_profile_info')->name('app_portal_admin_users_update_user_profile_info');
  Route::post('/app/portal/admin/users/update_user_online_status/', 'AdminController@user_update_online_status')->name('app_portal_admin_users_update_user_online_status');
  Route::post('/app/portal/admin/users/update_user_account_status/', 'AdminController@user_update_account_status')->name('app_portal_admin_users_update_user_account_status');
  Route::get('/app/portal/admin/users/update_user_send_welcome_email/{id}', 'AdminController@user_send_welcome_email')->name('app_portal_admin_users_update_user_send_welcome_email');
  Route::post('/app/portal/admin/users/send_user_mobile_test_notification/', 'AdminController@send_user_mobile_test_notification')->name('app_portal_admin_users_send_user_mobile_test_notification');
  Route::get('/app/portal/admin/jobs/all', 'AdminController@jobs_all')->name('app_portal_admin_jobs');
  Route::get('/app/portal/admin/jobs/job/{id}', 'AdminController@job_profile')->name('app_portal_admin_jobs_job');
  Route::post('/app/portal/admin/jobs/search', 'AdminController@jobs_search')->name('app_portal_admin_jobs_search');
  Route::post('/app/portal/admin/users/search', 'AdminController@users_search')->name('app_portal_admin_users_search');
  Route::get('/app/portal/admin/jobs/job_invoice_provider/{id}', 'DemoController@test_sp_invoice_template_design')->name('app_portal_admin_jobs_job_invoice_provider');
  Route::get('/app/portal/admin/jobs/job_invoice_seeker/{id}', 'DemoController@test_ss_invoice_template_design')->name('app_portal_admin_jobs_job_invoice_seeker');
  Route::post('/app/portal/admin/jobs/job_cancel', 'AdminController@job_cancel')->name('app_portal_admin_jobs_job_cancel');
  //map module
  Route::get('/app/portal/admin/maps/heatmap', 'AdminController@show_heatmap')->name('app_portal_admin_maps_heatmap');
  Route::post('/app/portal/admin/maps/heatmap/api/fetch', 'AdminController@fetch_heatmap_locations')->name('app_portal_admin_maps_heatmap_api_fetch');
  //charts module
  Route::post('/app/portal/admin/chart/reg_trend_fetch', 'AdminController@reg_trend_fetch')->name('app_portal_admin_chart_reg_trend_fetch');
  //service manager routes
  Route::get('/app/portal/admin/service_managment/editview', 'ServiceManagementController@display_admin_edit_view')->name('app_portal_admin_service_management');
  Route::post('/app/portal/admin/service_managment/update_major_priority_list', 'ServiceManagementController@update_major_priority_list')->name('app_portal_admin_update_major_priority_list');
  Route::post('/app/portal/admin/service_managment/update_minor_priority_list', 'ServiceManagementController@update_minor_priority_list')->name('app_portal_admin_update_minor_priority_list');
  Route::post('/app/portal/admin/service_managment/fetch_minor_cat_list', 'ServiceManagementController@fetch_minor_cat_list')->name('app_portal_admin_fetch_minor_cat_list');
  Route::post('/app/portal/admin/service_managment/admin_update_major_name', 'ServiceManagementController@update_major_name')->name('app_portal_admin_update_major_name');
  Route::post('/app/portal/admin/service_managment/admin_update_minor_name', 'ServiceManagementController@update_minor_name')->name('app_portal_admin_update_minor_name');
  Route::post('/app/portal/admin/service_managment/add_category', 'ServiceManagementController@add_category')->name('app_portal_admin_add_category');
  Route::post('/app/portal/admin/service_managment/add_sub_category', 'ServiceManagementController@add_sub_category')->name('app_portal_admin_add_sub_category');


  Route::get('/app/portal/admin/data/import/index', 'DataImportController@index')->name('app_portal_admin_data_import_index');

  //artisan admin routes
  Route::get('/app/services/artisan/clear_log', 'ArtisanController@clear_log')->middleware('auth');
  //dev only routes
  Route::get('dev/migrate_users', 'DataImportController@import_users')->name('app_portal_admin_data_import_index');
  //demo/test route links
  Route::get('/demo/car_map_demo', 'DemoController@car_map_demo')->name('demo_car_map_demo');
  Route::get('/demo/test2', 'DemoController@test2');
  Route::get('/demo/dump_database', 'DemoController@dump_database');
  Route::get('/demo/create_demo_jobs', 'DemoController@create_demo_jobs');
  Route::get('/demo/button_demo', 'DemoController@button_demo');
  Route::get('/test_notification', 'JobNotificationController@test_template');
  Route::get('/demo/test_email', 'DemoController@test_email')->name('demo_test_email');
});


//mobile interface controller. Used for handling notification channels and other mobile realted requests.
Route::post('/android_login', 'MobileInterfaceController@android_login')->name('app_mobile_api_android_login');
Route::post('/serviceLatLng', 'MobileInterfaceController@iOS_location_receiver')->name('app_mobile_api_iOS_location_receiver');
Route::post('/serviceLatLng2', 'MobileInterfaceController@android_location_receiver')->name('app_mobile_api_android_location_receiver');
Route::post('/notify', 'MobileInterfaceController@save_ios_device_token')->name('app_mobile_api_save_save_ios_device_token');
Route::post('/notifyAndro', 'MobileInterfaceController@save_android_device_token')->name('app_mobile_api_save_android_device_token');
Route::post('/save_android_token', 'MobileInterfaceController@save_android_device_token_2')->name('app_mobile_api_save_android_device_token_2');
Route::get('/94663', 'MobileInterfaceController@dump_iOS_user_id')->name('app_mobile_api_dump_iOS_user_id');
