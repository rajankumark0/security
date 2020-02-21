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


Route::prefix('admin')->namespace('Admin')->group(function () {	
	 Route::get('/', 'DashboardController@login');
	 Route::get('forgot', 'DashboardController@forgotPassword');
	 Route::get('logout', 'DashboardController@logout');
	 
	 Route::group(['middleware' => ['auth']], function () {	  
	      Route::get('dashboard', 'DashboardController@index')->name('Dashboard');
		   Route::get('profile', 'DashboardController@profile')->name('Profile');
		   Route::prefix('admin')->name('Admin')->group(function () {
			Route::get('/', 'AdminController@index');
			Route::get('create', 'AdminController@create');
			Route::post('create', 'AdminController@store');
			Route::get('edit/{id}', 'AdminController@edit');
			Route::post('edit/{id}', 'AdminController@update');		
			Route::get('view/{id}', 'AdminController@show');
			Route::get('delete/{id}', 'AdminController@destroy');					
           });
		   
		    Route::prefix('security-guard')->name('Security Guard')->group(function () {
				Route::get('/', 'SecurityguardController@index')->name('-list');
				Route::get('create', 'SecurityguardController@create')->name('-add');
				Route::post('create', 'SecurityguardController@store')->name('-save');
				Route::get('edit/{id}', 'SecurityguardController@edit')->name('-edit');
				Route::post('edit/{id}', 'SecurityguardController@update')->name('-update');		
				Route::get('view/{id}', 'SecurityguardController@show')->name('-view');
				Route::get('delete/{id}', 'SecurityguardController@destroy')->name('-delete');	
				Route::get('download', 'SecurityguardController@download')->name('-download');
             });
			 
			 Route::prefix('building-owner')->name('Building Owner')->group(function () {
				Route::get('/', 'BuildingownerController@index')->name('-list');
				Route::get('create', 'BuildingownerController@create')->name('-add');
				Route::post('create', 'BuildingownerController@store');
				Route::get('edit/{id}', 'BuildingownerController@edit')->name('-edit');
				Route::post('edit/{id}', 'BuildingownerController@update');		
				Route::get('view/{id}', 'BuildingownerController@show')->name('-view');
				Route::get('delete/{id}', 'BuildingownerController@destroy')->name('-list');					
				Route::get('download', 'BuildingownerController@download')->name('-download');					
             });
			 
			 Route::prefix('flat-office-owner')->name('Flat Office Owner')->group(function () {
				Route::get('/', 'FlatofficeownerController@index')->name('-list');
				Route::get('create', 'FlatofficeownerController@create')->name('-add');
				Route::post('create', 'FlatofficeownerController@store');
				Route::get('edit/{id}', 'FlatofficeownerController@edit')->name('-edit');
				Route::post('edit/{id}', 'FlatofficeownerController@update');		
				Route::get('view/{id}', 'FlatofficeownerController@show')->name('-view');
				Route::get('delete/{id}', 'FlatofficeownerController@destroy')->name('-delete');
				Route::get('download', 'FlatofficeownerController@download')->name('-download');	
             });
			 
			 Route::prefix('sales-person')->name('Sales Person')->group(function () {
				Route::get('/', 'SalespersonController@index')->name('-list');
				Route::get('create', 'SalespersonController@create')->name('-add');
				Route::post('create', 'SalespersonController@store');
				Route::get('edit/{id}', 'SalespersonController@edit')->name('-edit');
				Route::post('edit/{id}', 'SalespersonController@update');		
				Route::get('view/{id}', 'SalespersonController@show')->name('-view');
				Route::get('delete/{id}', 'SalespersonController@destroy')->name('-detele');
				Route::get('download', 'SalespersonController@download')->name('-download');	
             }); 
			 
			 Route::prefix('sales-manager')->name('Sales Manager')->group(function () {
				Route::get('/', 'SalesmanagerController@index')->name('-list');
				Route::get('create', 'SalesmanagerController@create')->name('-add');
				Route::post('create', 'SalesmanagerController@store');
				Route::get('edit/{id}', 'SalesmanagerController@edit')->name('-edit');
				Route::post('edit/{id}', 'SalesmanagerController@update');		
				Route::get('view/{id}', 'SalesmanagerController@show')->name('-view');
				Route::get('delete/{id}', 'SalesmanagerController@destroy')->name('-delete');					
				Route::get('download', 'SalesmanagerController@download')->name('-download');					
             });
			 
			 
			 Route::prefix('visitor')->name('Visitor')->group(function () {
				Route::get('/', 'VisitorController@index')->name('-list');
				Route::get('vip', 'VisitorController@vip')->name('-vip');
				Route::get('create', 'VisitorController@create')->name('-add');
				Route::post('create', 'VisitorController@store');
				Route::get('edit/{id}', 'VisitorController@edit')->name('-edit');
				Route::post('edit/{id}', 'VisitorController@update');		
				Route::get('view/{id}', 'VisitorController@show')->name('-view');
				Route::get('delete/{id}', 'VisitorController@destroy')->name('-delete');
				Route::get('download', 'VisitorController@download')->name('-download');	
				Route::get('vip-download', 'VisitorController@vip_download')->name('-vipdownload');	
					
             });
			 
			 
			 Route::prefix('clientsreport')->name('Clientsreport')->group(function () {
				Route::get('/', 'ClientsreportController@index')->name('-list');					
				Route::get('view/{id}', 'ClientsreportController@show')->name('-view');				
             });
			 
			 
		    Route::prefix('destinationreport')->name('Destinationreport')->group(function () {
				Route::get('/', 'DestinationreportController@index')->name('-list');					
				Route::get('view/{id}', 'DestinationreportController@show')->name('-add');				
             });
			 
			 
			 Route::prefix('salesmanagerreport')->name('Salesmanagerreport')->group(function () {
				Route::get('/', 'SalesmanagerreportController@index')->name('-list');					
				Route::get('view/{id}', 'SalesmanagerreportController@show')->name('-view');				
             });
			  
			  Route::prefix('salesreport')->name('Salesreport')->group(function () {
				Route::get('/', 'SalesreportController@index')->name('-list');					
				Route::get('view/{id}', 'SalesreportController@show')->name('-view');				
             });
			 
			 Route::prefix('statusreport')->name('Statusreport')->group(function () {
				Route::get('/', 'StatusreportController@index')->name('-list');					
				Route::get('view/{id}', 'StatusreportController@show')->name('-view');				
             });
			 	
				Route::prefix('purchange-plan')->name('PurchagePlan')->group(function () {
				Route::get('/', 'PurchagePlanController@index')->name('-list');					
				Route::get('purchage-log', 'PurchagePlanController@purchage_log')->name('-purchageLogs');					
				Route::get('view/{id}', 'PurchagePlanController@show')->name('-view');				
				Route::get('add-more-gaurd/{id}', 'PurchagePlanController@addmoresecurity')->name('-moreGaurd');				
				Route::get('renew/{id}', 'PurchagePlanController@renew')->name('-renew');	
				Route::get('download', 'PurchagePlanController@download')->name('-download');	
             });
				
			 Route::prefix('cms')->name('Cms')->group(function () {		   
				   Route::get('/', 'CmsController@index')->name('-list');
				   Route::get('create', 'CmsController@create')->name('-add');
				   Route::post('create', 'CmsController@store');				   
				   Route::get('edit/{id}', 'CmsController@edit')->name('-edit');
				   Route::post('edit/{id}', 'CmsController@update');
				   Route::get('delete/{id}', 'CmsController@destroy')->name('-delete');
				   Route::get('download', 'CmsController@download');
				   
			  });
			  
			  Route::prefix('faq')->name('Faq')->group(function () {		   
				   Route::get('/', 'FaqController@index')->name('-list');
				   Route::get('create', 'FaqController@create')->name('-add');
				   Route::post('create', 'FaqController@store');				   
				   Route::get('edit/{id}', 'FaqController@edit')->name('-edit');
				   Route::post('edit/{id}', 'FaqController@update');
				   Route::get('delete/{id}', 'FaqController@destroy')->name('-delete');
				   Route::get('downloadExcel', 'FaqController@downloadExcel')->name('-download');
			  });	
			 Route::prefix('plan')->name('Plan')->group(function () {		   
				   Route::get('/', 'PlanController@index')->name('-list');
				   Route::get('create', 'PlanController@create')->name('-add');
				   Route::post('create', 'PlanController@store');				   
				   Route::get('edit/{id}', 'PlanController@edit')->name('-edit');
				   Route::post('edit/{id}', 'PlanController@update');
				   Route::get('delete/{id}', 'PlanController@destroy')->name('-view');
				   Route::get('downloadExcel', 'PlanController@downloadExcel')->name('-download');
			  });	
			Route::prefix('plan-price')->name('PlanPrice')->group(function () {		   
				   Route::get('/', 'PlanPriceController@index')->name('-list');
				   Route::get('create', 'PlanPriceController@create')->name('-add');
				   Route::post('create', 'PlanPriceController@store');				   
				   Route::get('edit/{id}', 'PlanPriceController@edit')->name('-edit');
				   Route::post('edit/{id}', 'PlanPriceController@update');
				   Route::get('delete/{id}', 'PlanPriceController@destroy')->name('-delete');
				   Route::get('downloadExcel', 'PlanPriceController@downloadExcel')->name('-download');
			  });
			  
			  Route::prefix('user-role')->name('UserRole')->group(function () {		   
				   Route::get('/', 'UserRoleController@index')->name('-list');
				   Route::get('create', 'UserRoleController@create')->name('-add');
				   Route::post('create', 'UserRoleController@store');				   
				   Route::get('edit/{id}', 'UserRoleController@edit')->name('-edit');
				   Route::post('edit/{id}', 'UserRoleController@update');
				   Route::get('delete/{id}', 'UserRoleController@destroy')->name('-delete');
				   Route::get('downloadExcel', 'UserRoleController@downloadExcel')->name('-download');
				   Route::get('add-permision/{id}', 'UserRoleController@addpermission')->name('-permission');
				   Route::post('update-permision/{id}', 'UserRoleController@updatepermission');
			  });
			  Route::prefix('complaint')->name('Complaint')->group(function () {		   
				   Route::get('/', 'ComplaintController@index')->name('-list');
				   Route::get('create', 'ComplaintController@create')->name('-add');
				   Route::post('create', 'ComplaintController@store');				   
				   Route::get('edit/{id}', 'ComplaintController@edit')->name('-edit');
				   Route::post('edit/{id}', 'ComplaintController@update');
				   Route::get('view/{id}', 'ComplaintController@show')->name('-view');
				   Route::get('delete/{id}', 'ComplaintController@destroy')->name('-delete');
				   Route::get('download', 'ComplaintController@download')->name('-download');
			  });

			  Route::prefix('testimonial')->name('testimonial')->group(function () {		   
				   Route::get('/', 'TestimonialController@index')->name('-list');
				   Route::get('create', 'TestimonialController@create')->name('-add');
				   Route::post('create', 'TestimonialController@store');				   
				   Route::get('edit/{id}', 'TestimonialController@edit')->name('-edit');
				   Route::post('edit/{id}', 'TestimonialController@update');
				   Route::get('view/{id}', 'TestimonialController@show')->name('-view');
				   Route::get('delete/{id}', 'TestimonialController@destroy')->name('-delete');
				   Route::get('downloadExcel', 'TestimonialController@downloadExcel')->name('-download');
			  });
			  Route::prefix('saleslead')->name('SalesLead')->group(function () {		   
				   Route::get('/', 'SalesleadController@index')->name('-list');
				   Route::get('create', 'SalesleadController@create')->name('-add');
				   Route::post('create', 'SalesleadController@store');				   
				   Route::get('edit/{id}', 'SalesleadController@edit')->name('-edit');
				   Route::post('edit/{id}', 'SalesleadController@update');
				   Route::get('view/{id}', 'SalesleadController@show')->name('-view');
				   Route::get('delete/{id}', 'SalesleadController@destroy')->name('-delete');
				   Route::get('download', 'SalesleadController@download')->name('-download');
			  });
			  
			  Route::prefix('kyc')->name('Kyc')->group(function () {		   
				   Route::get('/', 'KycController@index')->name('-list');
				   Route::get('create', 'KycController@create')->name('-add');
				   Route::post('create', 'KycController@store');				   
				   Route::get('edit/{id}', 'KycController@edit')->name('-edit');
				   Route::post('edit/{id}', 'KycController@update');
				   Route::get('view/{id}', 'KycController@show');
				   Route::get('delete/{id}', 'KycController@destroy')->name('-delete');
				   Route::get('download', 'KycController@download')->name('-download');
			  });
	 
	   });
});



/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

Route::get('/', 'Web\HomeController@index')->name('home');
Route::get('/buy-now', '\App\Http\Controllers\Web\HomeController@buynow');
Route::get('/getplans', '\App\Http\Controllers\Web\HomeController@getplans');
Route::post('/buy-now', '\App\Http\Controllers\Web\HomeController@buynow');
Route::post('/confirm/{id}', '\App\Http\Controllers\Web\HomeController@confirm');
Route::get('/trailnow/{id}', '\App\Http\Controllers\Web\HomeController@trailnow');
Route::post('/trailnow/{id}', '\App\Http\Controllers\Web\HomeController@trailnow');
Route::get('/confirm/{id}', '\App\Http\Controllers\Web\HomeController@confirm');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('signup', '\App\Http\Controllers\Auth\RegisterController@signup');
Route::post('signin', '\App\Http\Controllers\Auth\LoginController@signin');
Route::get('page/{url}', 'Web\CmsController@index');
Route::get('faq', 'Web\CmsController@faq');
Route::get('/verify-account/{email}', '\App\Http\Controllers\Web\HomeController@verifyaccount');

