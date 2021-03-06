<?php

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
$this->get('/', 'Api\VoucherController@index')->name('api.ccc');
/*
Route::get('/', function()
{
    return view('client/home');
});
*/
Route::get('/home', function () {
    return view('client/home');
});

Route::get('/details', function () {
    return view('client/details');
});

Route::get('/arcade', function () {
    return view('client/arcade');
});

Route::get('/games', function () {
    return view('client/game');
});

Route::get('/wheel', function () {
    return view('client/wheel');
});

Route::get('/results', function () {
    return view('client/results');
});

Route::get('/history', function () {
    return view('client/history');
});

Route::get('/profile', function () {
    return view('client/member');
});

Route::get('/redeem', function () {
    return view('client/redeem');
});
/*
Route::get('/register', function () {
    return view('client/register');
});

Route::get('/login', function () {
    return view('client/login');
});
*/
Route::get('/validate', function () {
    return view('client/validate');
});

Route::get('/share', function () {
    return view('client/share');
});



$this->get('register/{token?}', 'Auth\MemberRegisterController@showRegisterForm')->name('member.register');
$this->post('/doregister', 'Auth\MemberRegisterController@doregister')->name('submit.member.register');





//Auth Routes

//Auth::routes();
 Route::prefix('admin')->group(function() {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('adminlogin');
    Route::post('login', 'Auth\AdminLoginController@login')->name('adminlogin.submit');
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
 });

Route::group(['prefix' => 'member','namespace' => 'Auth', 'middleware' => ['guest']],function(){
//Route::prefix('member')->group(function() {
    Route::get('login', 'MemberLoginController@showLoginForm')->name('memberlogin');
    Route::post('login', 'MemberLoginController@login')->name('memberlogin.submit');
    	
	// Password Reset Routes...
    $this->get('password-reset', 'ForgotPasswordController@MembershowLinkRequestForm')->name('member.reset.password');
	$this->post('password-reset', 'ForgotPasswordController@sendResetLinkEmail')->name('submit.reset.password');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    $this->get('reset/{token}', 'ResetPasswordController@MembershowResetForm')->name('member.reset.token');
    $this->post('resetpassword', 'ResetPasswordController@resetpassword')->name('member.update.password');
 });
$this->get('login', 'Auth\MemberLoginController@showLoginForm')->name('login');
//Auth Routes END

//Member routes
Route::group(['middleware' => 'auth:member'], function()
{
   
		
	
});
//Member routes end



//Admin
Route::group(['middleware' => 'auth:admin'], function()
{
    	
	//Game rotes
	Route::get('/game', 'GameController@get_game_list');
	Route::get('/game/index', 'GameController@dashboard');
	Route::get('/game/list', 'GameController@get_game_list');
	
	Route::get('/game/new', 'GameController@new_game');
	Route::post('/game/new', 'GameController@save_game');
	
	
	Route::get('/game/edit/{id}', 'GameController@edit_game');
	Route::post('/game/edit/{id}', 'GameController@update_game');
	
	Route::get('/game/addlevel/{id}', 'GameController@add_level');
	
	//Member route
	Route::get('/member/index', 'MemberController@dashboard');
	Route::get('/member/dashboard', 'MemberController@dashboard')->name('memberdashboard');
	Route::get('/member', 'MemberController@member_list');
	Route::get('/member/list', 'MemberController@member_list')->name('memberlist');
	
	Route::get('/member/add', 'MemberController@add_member');
	Route::post('/member/add', 'MemberController@save_member');
	
	Route::get('/member/edit/{id}', 'MemberController@edit_member');
	Route::post('/member/edit/{id}', 'MemberController@update_member');
	
	
	//Route::post('/member/delete/{id}', 'MemberController@delete_member');
	//Route::get('/member/delete/{id}', 'MemberController@delete_member');
	Route::delete('/member/delete/{id}', 'MemberController@delete_member');
	//Route::get('/member/edit', 'MemberController@change_password');
	//Route::get('/member/edit', 'MemberController@verify_wechat');	
	//Route::post('/member/edit', 'MemberController@delete_member');
	
	
	
	//Admin Routes
	///Route::any('/', ['uses' => 'AdminController@dashboard'])->name('admindashboard');
	///Route::get('/', 'AdminController@dashboard');
	//Route::get('/', function() { return Redirect::to("AdminController/dashboard"); });
	Route::get('/admin/dashboard', 'AdminController@dashboard');
	
	
	//Voucher Routes
	Route::get('/voucher/', 'VoucherController@get_voucher_list');
	Route::get('/voucher/list', 'VoucherController@get_voucher_list');
	Route::get('/voucher/unreleased', 'VoucherController@get_unreleasedvoucher_list');	
	
	Route::get('/voucher/category', 'VoucherController@get_category');
	Route::get('/voucher/category/add', 'VoucherController@add_category');
	Route::post('/voucher/category/add', 'VoucherController@save_category');	
	Route::get('/voucher/category/edit/{id}', 'VoucherController@edit_category');
	Route::post('/voucher/category/edit/{id}', 'VoucherController@edit_category');	
	Route::post('/voucher/category/delete/{id}', 'VoucherController@delete_category');	
	
	Route::get('/voucher/edit/{id}', 'VoucherController@edit_voucher');
	Route::post('/voucher/edit/{id}', 'VoucherController@update_voucher');
	
	Route::delete('/voucher/delete/{id}', 'VoucherController@destroy');
	Route::delete('/voucher/ur-delete/{id}', 'VoucherController@destroy_unr_voucher');
	
	Route::delete('/voucher/bulkupdate', 'VoucherController@bulkdata_update');
	Route::delete('/voucher/bulk-unreleased-update', 'VoucherController@bulkdata_unrv_update')->name('unrv_update');
	
	Route::get('/voucher/edit/{id}', 'VoucherController@edit_voucher');
	Route::get('/voucher/addlevel/{id}', 'VoucherController@add_level');
	
	Route::get('/voucher/import', 'ImportController@getImport')->name('import');
	
	Route::post('/voucher/import', 'ImportController@parseImport')->name('importparse');
	Route::post('/voucher/importprocess', 'ImportController@ProcessparseImport')->name('importpost');
	
	
	Route::get('/voucher/testimport', 'ImportController@testparseImport')->name('testimport');
	Route::post('/voucher/testimport', 'ImportController@testProcessparseImport')->name('testimportpost');
	
	Route::get('/voucher/download', 'ImportController@downloadExcel');
	
	
	Route::post('/voucher/publishvoucher/{id}', 'VoucherController@publishvoucher');
	
	Route::post('/voucher/unreleased', 'VoucherController@post_unreleasedvoucher_list');
	
	Route::post('/voucher/publishfile/{id}', 'VoucherController@publishfile');
	 
	Route::get('/voucher/un-duplicate-finder', 'VoucherController@check_unrvoucher_duplicate')->name('ajaxfindunrvoucherduplicate');
	Route::get('/voucher/vo-duplicate-finder', 'VoucherController@check_voucher_duplicate')->name('ajaxfindvoucherduplicate');
	
	Route::delete('/voucher/remove-unr-duplicate/', 'VoucherController@remove_unrvoucher_duplicate');
	Route::delete('/voucher/remove-vor-duplicate/', 'VoucherController@remove_voucher_duplicate');
	
	
	Route::get('/voucher/show/{id}', 'VoucherController@show_voucher')->name('showvoucher');
	Route::get('/voucher/show-unrv/{id}', 'VoucherController@show_unreleased_voucher')->name('showunreleasedvoucher');
	
	Route::post('/voucher/ajaxupdate-unrv-voucher', 'VoucherController@ajax_unrv_update_voucher')->name('ajax_unrv_updatevoucher');
	Route::post('/voucher/ajaxupdatevoucher', 'VoucherController@ajax_update_voucher')->name('ajaxupdatevoucher');
});
//END

Route::get('/admin', 'AdminController@index');
Route::get('/member', 'MemberController@index');

Route::get('/clearcache', function() {
    $exitCode = Artisan::call('cache:clear');
	return 'cache:cleared';
});



Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');




