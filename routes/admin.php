<?php

use App\Http\Controllers\AddonController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\CrmReport;
use App\Models\Quotation;
use App\Addons\MultiVendor\Http\Controllers\MultiVendorController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmailSystemController;
use App\Http\Controllers\SmsPanelController;
use App\Http\Controllers\CustomerLogController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CRMController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/update', [UpdateController::class, 'step0'])->name('update');
Route::get('/update/step1', [UpdateController::class, 'step1'])->name('update.step1');
Route::get('/update/step2', [UpdateController::class, 'step2'])->name('update.step2');
Route::get('/convert_for_update', [UpdateController::class, 'convertForMultivendor']);

Route::get('/refresh-csrf', function () {
    return csrf_token();
});

Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear');
    dd("Cache Clear All");

});



Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
Route::delete('/aiz-uploader/destroy/{id}', [AizUploadController::class, 'destroy']);
Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');


Route::get('/demo/cron_1', [DemoController::class, 'cron_1']);
Route::get('/demo/cron_2', [DemoController::class, 'cron_2']);
Route::get('/insert_trasnalation_keys', [DemoController::class, 'insert_trasnalation_keys']);
Route::get('/customer-products/admin', [SettingController::class, 'initSetting']);

Auth::routes(['register' => false]);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

        Route::get('/', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');

        Route::post('/language', [LanguageController::class, 'changeLanguage'])->name('language.change');

        Route::post('/pos_sys/customer_store',[CategoryController::class,'customer_store'])->name('pos.customer_store');
        //Employee Manage Route start
        Route::get('/employee_manage/attendance_generate_report_view',[EmployeeController::class,'attendence_report_generate_view'])->name('employee.attendance.report_generate_view');
        Route::post('/employee_manage/attendance_generate_report_store',[EmployeeController::class,'attendence_report_generate_excell_store'])->name('employee.attendance.report_generate_store');
        Route::get('/employee_manage/attendance_generate_report',[EmployeeController::class,'attendence_report_generate'])->name('employee.attendance.report_generate');
        Route::post('/employee_manage/store_attendance_report_info',[EmployeeController::class,'store_attendence_report_info'])->name('employee.attendance.store_info');
        Route::get('/employee_manage/attendance_list',[EmployeeController::class,'employee_attendence_list'])->name('employee.attendance.list');
        Route::get('/employee_manage/attendance_print/{attendance_id}',[EmployeeController::class,'employee_attendence_print'])->name('employee.attendance.print');
        Route::get('/employee_manage/attendance_edit/{attendance_id}',[EmployeeController::class,'employee_attendence_edit'])->name('employee.attendance.edit');
        Route::post('/employee_manage/attendance_update/{attendance_id}',[EmployeeController::class,'employee_attendence_update'])->name('employee.attendance.update');
        Route::get('/employee_manage/attendance_delete/{attendance_id}',[EmployeeController::class,'employee_attendence_delete'])->name('employee.attendance.delete');
        Route::get('/employee_manage/automate_attendance',[EmployeeController::class,'automate_attendance'])->name('employee.automate_attendance');
        Route::post('/employee_manage/automate_attendance_generate',[EmployeeController::class,'automate_attendance_generate'])->name('employee.automate_attendance_generate');
        Route::get('/employee_manage/automate_attendance_show',[EmployeeController::class,'automate_attendance_show'])->name('employee.automate_attendance_show');
        Route::get('/employee_manage/automate_attendance_list',[EmployeeController::class,'automate_attendance_list'])->name('employee.automate_attendance.list');
        Route::get('/employee_manage/automate_attendance_edit/{user_id}/{year}/{month}',[EmployeeController::class,'automate_attendance_edit'])->name('employee.automate_attendance.edit');
        Route::get('/employee_manage/automate_attendance_delete/{user_id}/{year}/{month}',[EmployeeController::class,'automate_attendance_delete'])->name('employee.automate_attendance.delete');
        Route::post('/employee_manage/automate_attendance_store_edited_in_out_time_data',[EmployeeController::class,'automate_attendance_store_edited_in_out_time_data'])->name('employee.automate_attendance.store_edited_in_out_time_data');
        Route::get('/employee_manage/automate_attendance_generate_salary/{user_id}/{year}/{month}',[EmployeeController::class,'automate_attendance_generate_salary'])->name('employee.automate_attendance.generate_salary');
        Route::post('/employee_manage/automate_attendance_generate_salary_store',[EmployeeController::class,'automate_attendance_generate_salary_store'])->name('employee.automate_attendance.generate_salary.store');
        Route::get('/employee_manage/automate_attendance_print/{user_id}/{year}/{month}',[EmployeeController::class,'automate_attendance_print'])->name('employee.automate_attendance.print');
        Route::get('/employee_manage/employee_panel_list',[EmployeeController::class,'employee_panel_list'])->name('employee.employee_panel.list');
        Route::get('/employee_manage/employee_panel_edit/{id}',[EmployeeController::class,'employee_panel_edit'])->name('employee.employee_panel.edit');
        Route::post('/employee_manage/employee_panel_update',[EmployeeController::class,'employee_panel_update'])->name('employee.employee_panel.update');
        Route::get('/employee_manage/employee_current_attendance_data',[EmployeeController::class,'employee_current_attendance_data'])->name('employee.employee_current_attendance.data');
        Route::get('/employee_manage/employee_current_attendance_details/{user_id}/{year}/{month}',[EmployeeController::class,'employee_current_attendance_details'])->name('employee.automate_current_attendance.details');
    
    
        Route::get('/udpate_attendance_data_to_server',[EmployeeController::class,'udpate_attendance_data']);
        //Employee Manage Route End

        //Manage Payslip
        Route::get('/manage_payslip/create/{user_id}/{year}/{month}',[EmployeeController::class,'payslip_create'])->name('payslip.create');
        Route::get('/manage_payslip/edit/{user_id}/{year}/{month}',[EmployeeController::class,'payslip_edit'])->name('payslip.edit');
        Route::post('/manage_payslip/store',[EmployeeController::class,'payslip_store'])->name('payslip.store');
        Route::post('/manage_payslip/store/{user_id}/{year}/{month}',[EmployeeController::class,'payslip_update'])->name('payslip.update');
        Route::get('/manage_payslip/print/{user_id}/{year}/{month}',[EmployeeController::class,'payslip_print'])->name('payslip.print');
        

        Route::resource('customers', CustomerController::class);
        Route::get('customers_ban/{customer}', [CustomerController::class, 'ban'])->name('customers.ban');
        Route::get('/customers/login/{id}', [CustomerController::class, 'login'])->name('customers.login');
        Route::get('/customers/destroy/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

        Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletters.index');
        Route::post('/newsletter/send', [NewsletterController::class, 'send'])->name('newsletters.send');
        Route::post('/newsletter/test/smtp', [NewsletterController::class, 'testEmail'])->name('test.smtp');

        Route::resource('profile', ProfileController::class);

        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
        Route::post('/settings/update/activation', [SettingController::class, 'updateActivationSettings'])->name('settings.update.activation');
        Route::get('/general-setting', [SettingController::class, 'general_setting'])->name('general_setting.index');
        Route::get('/payment-method', [SettingController::class, 'payment_method'])->name('payment_method.index');
        Route::get('/file_system', [SettingController::class, 'file_system'])->name('file_system.index');
        Route::get('/social-login', [SettingController::class, 'social_login'])->name('social_login.index');
        Route::get('/smtp-settings', [SettingController::class, 'smtp_settings'])->name('smtp_settings.index');
        Route::post('/env_key_update', [SettingController::class, 'env_key_update'])->name('env_key_update.update');
        Route::post('/payment_method_update', [SettingController::class, 'payment_method_update'])->name('payment_method.update');

        Route::get('/third-party-settings', [SettingController::class, 'third_party_settings'])->name('third_party_settings.index');
        Route::post('/google_analytics', [SettingController::class, 'google_analytics_update'])->name('google_analytics.update');
        Route::post('/google_recaptcha', [SettingController::class, 'google_recaptcha_update'])->name('google_recaptcha.update');
        Route::post('/facebook_chat', [SettingController::class, 'facebook_chat_update'])->name('facebook_chat.update');
        Route::post('/facebook_pixel', [SettingController::class, 'facebook_pixel_update'])->name('facebook_pixel.update');

    
        // Language
        Route::resource('/languages', LanguageController::class);
        Route::post('/languages/update_rtl_status', [LanguageController::class, 'update_rtl_status'])->name('languages.update_rtl_status');
        Route::post('/languages/update_language_status', [LanguageController::class, 'update_language_status'])->name('languages.update_language_status');
        Route::get('/languages/destroy/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');
        Route::post('/languages/key_value_store', [LanguageController::class, 'key_value_store'])->name('languages.key_value_store');

        // website setting
        Route::group(['prefix' => 'website', 'middleware' => ['permission:website_setup']], function () {

            Route::view('/header', 'backend.website_settings.header')->name('website.header');
            Route::view('/footer', 'backend.website_settings.footer')->name('website.footer');
            Route::view('/banners', 'backend.website_settings.banners')->name('website.banners');
            Route::view('/pages', 'backend.website_settings.pages.index')->name('website.pages');
            Route::view('/appearance', 'backend.website_settings.appearance')->name('website.appearance');
            Route::resource('custom-pages', PageController::class);
            Route::get('/custom-pages/edit/{id}', [PageController::class, 'edit'])->name('custom-pages.edit');
            Route::get('/custom-pages/destroy/{id}', [PageController::class, 'destroy'])->name('custom-pages.destroy');
        });

        Route::resource('roles', RoleController::class);
        Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::get('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

        Route::resource('staffs', StaffController::class);
        Route::get('/staffs/destroy/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');

    
        Route::resource('addons', AddonController::class);
        Route::post('/addons/activation', [AddonController::class, 'activation'])->name('addons.activation');

        
    });

