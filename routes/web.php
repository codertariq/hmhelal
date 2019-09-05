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
Route::group(['middleware' => ['install']], function () {
	Route::get('/','FrontendController@index')->name('index');
	Route::get('/next','FrontendController@next')->name('next');
	Route::get('/search','FrontendController@search')->name('search');
	// Route::get('/', function () {
	// 	 return view('welcome');
	// 	// return redirect()->route('login');
	// });
	Auth::routes();
	Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function () {
		//ui:::::::::::::::::::
		Route::get('/profile', 'UiController@index')->name('profile');
		Route::post('/profile', 'UiController@postprofile')->name('postprofile');
		Route::post('/password', 'UiController@password_change')->name('password');

		Route::match(['get', 'post'], 'configuration', 'SettingController@index')->name('configuration');
		Route::post('/logo', 'SettingController@upload_logo')->name('logo');
		Route::post('/api', 'SettingController@api')->name('api');
		Route::post('/social', 'SettingController@api')->name('social');
		Route::post('/basic', 'SettingController@basic')->name('basic');
		/*::::::::::::::::::language:::::::::::::::::::::*/
		Route::get('/language', 'LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');
		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');
		/*::::::::::::::user role Permission:::::::::*/
		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});
		Route::group(['as' => 'client.', 'prefix' => 'client', 'namespace' => 'Client'], function () {
			Route::put('/status/{id}', 'ClientController@status')->name('status');
			Route::put('/action', 'ClientController@action')->name('action');
			Route::get('/datatable', 'ClientController@datatable')->name('datatable');
			Route::get('/', 'ClientController@index')->name('index');
			Route::get('/create', 'ClientController@create')->name('create');
			Route::post('/create', 'ClientController@store')->name('store');
			Route::get('/show/{id}', 'ClientController@show')->name('show');
			Route::get('/edit/{id}', 'ClientController@edit')->name('edit');
			Route::put('/edit/{id}', 'ClientController@update')->name('update');
			Route::delete('/delete/{id}', 'ClientController@destroy')->name('destroy');
		});

		Route::group(['as' => 'cases.', 'prefix' => 'cases', 'namespace' => 'Cases'], function () {

			Route::put('/status/{id}', 'CaseController@status')->name('status');
			Route::put('/action', 'CaseController@action')->name('action');
			Route::get('/datatable', 'CaseController@datatable')->name('datatable');
			Route::get('/', 'CaseController@index')->name('index');
			Route::get('/create', 'CaseController@create')->name('create');
			Route::post('/create', 'CaseController@store')->name('store');
			Route::get('/show/{id}', 'CaseController@show')->name('show');
			Route::get('/edit/{id}', 'CaseController@edit')->name('edit');
			Route::put('/edit/{id}', 'CaseController@update')->name('update');
			Route::delete('/delete/{id}', 'CaseController@destroy')->name('destroy');
			Route::post('/hearing-date', 'CaseController@hearing_date')->name('hearing-date');
			Route::delete('/hear-destroy/{id}', 'CaseController@hear_destroy')->name('hear-destroy');
			Route::get('/preview/{id}', 'CaseController@preview')->name('preview');
			Route::get('/invoice/{id}', 'CaseController@invoice')->name('invoice');
			Route::post('/payment', 'CaseController@payment')->name('payment');
			Route::delete('/payment-destroy/{id}', 'CaseController@payment_destroy')->name('payment-destroy');
			Route::post('/study', 'CaseController@case_study')->name('study');

			Route::group(['as' => 'archived.', 'prefix' => 'archived'], function () {

				Route::get('/index/{id}', 'CaseHistoryController@index')->name('index');
				Route::post('/index', 'CaseHistoryController@archived')->name('archivedpost');
				Route::get('/', 'CaseHistoryController@postindex')->name('postindex');
				Route::get('/datatable', 'CaseHistoryController@datatable')->name('datatable');

				Route::get('/show/{id}', 'CaseHistoryController@show')->name('show');
				Route::put('/restore/{id}', 'CaseHistoryController@restore')->name('restore');
			});
		});
		Route::group(['as' => 'account.', 'prefix' => 'account', 'namespace' => 'Account'], function () {
			Route::get('/', 'BankController@index')->name('index');
			Route::get('/datatable', 'BankController@datatable')->name('datatable');
			Route::get('/create', 'BankController@create')->name('create');
			Route::post('/store', 'BankController@store')->name('store');
			Route::get('/show/{id}', 'BankController@show')->name('show');
			Route::get('/edit/{id}', 'BankController@edit')->name('edit');
			Route::put('/edit/{id}', 'BankController@update')->name('update');
			Route::delete('/delete/{id}', 'BankController@destroy')->name('destroy');
			Route::put('/action', 'BankController@action')->name('action');
		});
		Route::group(['as' => 'transaction.', 'prefix' => 'transaction', 'namespace' => 'Account'], function () {
			Route::group(['as' => 'income.', 'prefix' => 'income'], function () {
				Route::get('/', 'TransactionController@index')->name('index');
				Route::get('/datatable', 'TransactionController@datatable')->name('datatable');
				Route::get('/create', 'TransactionController@create')->name('create');
				Route::post('/store', 'TransactionController@store')->name('store');
				Route::get('/show/{id}', 'TransactionController@show')->name('show');
				Route::get('/edit/{id}', 'TransactionController@income_edit')->name('edit');
				Route::put('/edit/{id}', 'TransactionController@update')->name('update');
				Route::delete('/delete/{id}', 'TransactionController@destroy')->name('destroy');
				Route::put('/action', 'TransactionController@action')->name('action');
			});
			Route::group(['as' => 'expense.', 'prefix' => 'expense'], function () {
				Route::get('/', 'TransactionController@index')->name('index');
				Route::get('/datatable', 'TransactionController@datatable')->name('datatable');
				Route::get('/create', 'TransactionController@create')->name('create');
				Route::post('/store', 'TransactionController@store')->name('store');
				Route::get('/show/{id}', 'TransactionController@show')->name('show');
				Route::get('/edit/{id}', 'TransactionController@income_edit')->name('edit');
				Route::put('/edit/{id}', 'TransactionController@update')->name('update');
				Route::delete('/delete/{id}', 'TransactionController@destroy')->name('destroy');
				Route::put('/action', 'TransactionController@action')->name('action');
			});
			Route::group(['as' => 'chart-account.', 'prefix' => 'chart-account'], function () {
				Route::get('/', 'ChartAccountController@index')->name('index');
				Route::get('/datatable', 'ChartAccountController@datatable')->name('datatable');
				Route::get('/create', 'ChartAccountController@create')->name('create');
				Route::post('/store', 'ChartAccountController@store')->name('store');
				Route::get('/show/{id}', 'ChartAccountController@show')->name('show');
				Route::get('/edit/{id}', 'ChartAccountController@edit')->name('edit');
				Route::put('/edit/{id}', 'ChartAccountController@update')->name('update');
				Route::delete('/delete/{id}', 'ChartAccountController@destroy')->name('destroy');
				Route::put('/action', 'ChartAccountController@action')->name('action');
			});
			Route::group(['as' => 'payee-payers.', 'prefix' => 'payee-payers'], function () {
				Route::get('/', 'PayeePayerController@index')->name('index');
				Route::get('/datatable', 'PayeePayerController@datatable')->name('datatable');
				Route::get('/create', 'PayeePayerController@create')->name('create');
				Route::post('/store', 'PayeePayerController@store')->name('store');
				Route::get('/show/{id}', 'PayeePayerController@show')->name('show');
				Route::get('/edit/{id}', 'PayeePayerController@edit')->name('edit');
				Route::put('/edit/{id}', 'PayeePayerController@update')->name('update');
				Route::delete('/delete/{id}', 'PayeePayerController@destroy')->name('destroy');
				Route::put('/action', 'PayeePayerController@action')->name('action');
			});
		});
		Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
			Route::any('/income', 'ReportController@income')->name('income');
		});

		Route::group(['as' => 'report.', 'prefix' => 'report'], function () {
			Route::any('/income', 'ReportController@income')->name('income');
			Route::any('/expense', 'ReportController@expense')->name('expense');
			Route::any('/balance', 'ReportController@balance')->name('balance');
			Route::any('/case', 'ReportController@case')->name('case');

		});

		Route::group(['prefix' => 'configuration', 'namespace' => 'Configuration', 'as' => 'configuration.'], function () {
			//Country Related Routes
			Route::group(['namespace' => 'Master', 'as' => 'master.'], function () {
				Route::group(['prefix' => 'master'], function () {
					Route::put('/case_stage/status/{id}', 'CaseStageController@status')->name('case_stage.status');
					Route::put('/case_stage/action', 'CaseStageController@action')->name('case_stage.action');
					Route::get('/datatable/case_stage', 'CaseStageController@datatable')->name('case_stage.datatable');
					Route::resource('/case_stage', 'CaseStageController');
					Route::put('/act/status/{id}', 'ActController@status')->name('act.status');
					Route::put('/act/action', 'ActController@action')->name('act.action');
					Route::get('/datatable/act', 'ActController@datatable')->name('act.datatable');
					Route::resource('/act', 'ActController');
					//Court Section
					Route::put('/court/status/{id}', 'CourtController@status')->name('court.status');
					Route::put('/court/action', 'CourtController@action')->name('court.action');
					Route::get('/datatable/court', 'CourtController@datatable')->name('court.datatable');
					Route::resource('/court', 'CourtController');
					//Area Related Routes
					Route::put('/union/action', 'UnionController@action')->name('union.action');
					Route::get('/datatable/union', 'UnionController@datatable')->name('union.datatable');
					Route::resource('/union', 'UnionController');
					//City Related Routes
					Route::put('/upozila/action', 'UpozilaController@action')->name('upozila.action');
					Route::get('/datatable/upozila', 'UpozilaController@datatable')->name('upozila.datatable');
					Route::resource('/upozila', 'UpozilaController');
					//State Related Routes
					Route::put('/district/action', 'DistrictController@action')->name('district.action');
					Route::get('/datatable/district', 'DistrictController@datatable')->name('district.datatable');
					Route::resource('/district', 'DistrictController');
					Route::put('/division/action', 'DivisionController@action')->name('division.action');
					Route::get('/datatable/division', 'DivisionController@datatable')->name('division.datatable');
					Route::resource('/division', 'DivisionController');
				});
			});
			Route::group(['namespace' => 'Category', 'as' => 'category.'], function () {
				Route::group(['prefix' => 'category'], function () {
					//Area Related Routes
					Route::put('/case/status/{id}', 'CaseCategoryController@status')->name('case.status');
					Route::put('/case/action', 'CaseCategoryController@action')->name('case.action');
					Route::get('/datatable/case', 'CaseCategoryController@datatable')->name('case.datatable');
					Route::resource('/case', 'CaseCategoryController');
					//City Related Routes
					Route::put('/client/status/{id}', 'ClientCategoryController@status')->name('client.status');
					Route::put('/client/action', 'ClientCategoryController@action')->name('client.action');
					Route::get('/datatable/client', 'ClientCategoryController@datatable')->name('client.datatable');
					Route::resource('/client', 'ClientCategoryController');
					//State Related Routes
					Route::put('/court/status/{id}', 'CourtCategoryController@status')->name('court.status');
					Route::put('/court/action', 'CourtCategoryController@action')->name('court.action');
					Route::get('/datatable/court', 'CourtCategoryController@datatable')->name('court.datatable');
					Route::resource('/court', 'CourtCategoryController');
				});
			});
		});
	});
});
/*::::::::::::::::::::install::::::::::::::::::*/
Route::get('/install', 'Install\InstallController@index')->name('install');
Route::post('/install', 'Install\InstallController@terms');
Route::get('/install/server', 'Install\InstallController@server')->name('install.server');
Route::post('/install/server', 'Install\InstallController@check_server');
Route::get('install/database', 'Install\InstallController@database')->name('install.database');
Route::post('install/database', 'Install\InstallController@process_install');
Route::get('install/user', 'Install\InstallController@create_user')->name('install.user');
Route::post('install/user', 'Install\InstallController@store_user');
Route::get('install/settings', 'Install\InstallController@system_settings')->name('install.settings');
Route::post('install/settings', 'Install\InstallController@final_touch');
Route::get('/home', 'HomeController@index')->name('home');