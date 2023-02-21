<?php

use Illuminate\Support\Facades\Route;

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



// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/admin','Admin\AdminController@index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.dashboard')->with('status', session('status'));
    }

    return redirect()->route('admin.dashboard');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes(['register'=>false]);
// Auth::routes();
Route::get('otp', 'Auth\OTPController@index')->name('otp.index');
Route::post('otp', 'Auth\OTPController@store')->name('otp.post');
Route::get('otp/reset', 'Auth\OTPController@resend')->name('otp.resend');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth:web','otp','prevent-back-after-logout']], function () {
    Route::post('/password/update-first-time-login', 'AdminController@updatePassword')->name('password.update-first-time');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/search','AdminController@search')->name('search');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    Route::get('demo/generate/createdemo', 'GenerateDemoController@create')->name('generate.createdemo');
    Route::post('demo/generate/store', 'GenerateDemoController@store')->name('generate.store');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Companies
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::resource('companies', 'CompaniesController');

    // Industries
    Route::delete('industries/destroy', 'IndustriesController@massDestroy')->name('industries.massDestroy');
    Route::resource('industries', 'IndustriesController');

    // FAQs
    Route::delete('faqs/destroy', 'FAQsController@massDestroy')->name('faqs.massDestroy');
    Route::resource('faqs', 'FAQsController');

    // Complaints
    Route::delete('complaints/destroy', 'ComplaintsController@massDestroy')->name('complaints.massDestroy');
    Route::resource('complaints', 'ComplaintsController');
    Route::get('complaint/resolve/{id}','ComplaintsController@resolve')->name('complaints.resolve');
    Route::post('complaint/resolve/{id}','ComplaintsController@resolveComplaint')->name('complaints.resolveComplaint');

    //Entries

    Route::get('/entry/all','EntryController@index')->name('entries.index');
    Route::get('/entry/valid','EntryController@valid')->name('entries.valid');
    Route::get('/entry/show/{id}','EntryController@show')->name('entries.show');
    Route::get('/validpool/show/{id}','EntryController@checkPhoneEntries')->name('entries.checkphone');
    Route::get('/entry/invalid','EntryController@invalid')->name('entries.invalid');
    Route::get('/entry/validpool','EntryController@validPool')->name('entries.validpool');
    Route::get('/entry/participants','EntryController@participants')->name('entries.participants');

    // Week Draws

    Route::resource('weeks','WeekController');

    //Draws
    Route::get('blacklists','DrawController@blacklist')->name('draw.blacklists');
    Route::get('/draw/draw-winners-all', 'DrawController@drawWinnersAll')->name('draws.draw-winners-all');
    Route::get('/draw/create-blacklist', 'DrawController@createBlacklist')->name('draws.create-blacklist');
    Route::post('/draw/store-blacklist', 'DrawController@storeBlacklist')->name('draws.store-blacklist');
    Route::get('/draw/edit-blacklist/{id}', 'DrawController@editBlacklist')->name('draws.edit-blacklist');
    Route::put('/draw/update-blacklist/{id}', 'DrawController@updateBlacklist')->name('draws.update-blacklist');

    Route::get('/redraw/{id}', 'DrawController@redraw')->name('draws.redraw');
    Route::get('/draws/draw-winner-confirm/{id}', 'DrawController@confirmDrawWinner')->name('draws.draw-winner-confirm');
    Route::get('/draws/draw-winner-reject/{id}', 'DrawController@rejectDrawWinner')->name('draws.draw-winner-reject');
    Route::post('/draws/draw-winner-reject/{id}', 'DrawController@rejectDrawWinnerPost')->name('draws.draw-winner-reject-post');
    Route::get('/draws/create/region', 'DrawController@createRegion')->name('draws.create-region');
    Route::resource('draws', 'DrawController');

    // Artime wins
    Route::get('/airtime-winners', 'DrawController@allAirtimeWins')->name('airtime.all-wins');
    Route::get('/airtime-winners-25', 'DrawController@airtimeWins25')->name('airtime.all-wins-25');
    Route::get('/airtime-winners-50', 'DrawController@airtimeWins50')->name('airtime.all-wins-50');
    Route::get('/airtime-winners-100', 'DrawController@airtimeWins100')->name('airtime.all-wins-100');


    //Rejected Winners

    Route::resource('rejects', 'RejectWinnerController');

    //Products/Merchandise
    Route::get('/products/issue/{id}','ProductController@issueProduct')->name('products.issue');
    Route::get('/products/issued-out','ProductController@issuedOut')->name('products.issued-out');
    Route::get('/products/remaining','ProductController@remaining')->name('products.remaining');

    Route::resource('products','ProductController');


    // Product Categories
    Route::get('/product-categories','ProductCategoryController@index')->name('products-categories.index');

    //Activity Log
    Route::get('/logs/index','LogActivityController@index')->name('logs.index');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
