<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/* ------------- user ------------------ */
Route::post('login', 'API\UserController@login');
Route::post('edit-profile', 'API\UserController@edit');
Route::post('update-profile', 'API\UserController@update');
Route::post('change-password', 'API\UserController@change_password');
Route::post('view-profile', 'API\UserController@view');
Route::post('registeruser', 'API\UserController@registeruser');
Route::post('sendotp', 'API\UserController@sendotp');
Route::post('verifyotp', 'API\UserController@verifyotp');
Route::post('kycsave', 'API\UserController@kycsave');

/* ------------end------------ */

Route::post('security/dashboad', 'API\SecurityguardController@index');
Route::post('security/getvisitor', 'API\SecurityguardController@getvisitor');
Route::post('security/visitor-entry', 'API\SecurityguardController@add');
Route::post('security/get-flatlist', 'API\SecurityguardController@getflatlist');
Route::post('security/get-response', 'API\SecurityguardController@getresponse');
Route::post('security/flat-Response', 'API\SecurityguardController@flatresponse');
Route::post('security/flat-visitor-list', 'API\SecurityguardController@flatvisitorlist');
Route::post('security/visitor-exit', 'API\SecurityguardController@update');
Route::post('security/add', 'API\SecurityguardController@add');

/* -------------------sales person  -----------------*/
Route::post('sales-person/dashboad', 'API\SalespersonController@index');
Route::post('sales-person/add-leads', 'API\SalespersonController@store');
Route::post('sales-person/edit-leads', 'API\SalespersonController@edit');
Route::post('sales-person/update-leads', 'API\SalespersonController@update');
Route::post('sales-person/view-leads', 'API\SalespersonController@show');
Route::post('sales-person/delete-leads', 'API\SalespersonController@destroy');
Route::post('sales-person/getplans', 'API\SalespersonController@getplans');
Route::post('sales-person/getpackage', 'API\SalespersonController@getpackage');

/* ----------------ends------------------ */

/* ------------------- sales managers -----------------*/


Route::post('sales-manager/dashboad', 'API\SalesmanagerController@index');
Route::post('sales-manager/add-sales-person', 'API\SalesmanagerController@store');
Route::post('sales-manager/view-sales-person', 'API\SalesmanagerController@view');
Route::post('sales-manager/edit-sales-person', 'API\SalesmanagerController@edit');
Route::post('sales-manager/update-sales-person', 'API\SalesmanagerController@update');
Route::post('sales-manager/delete-sales-person', 'API\SalesmanagerController@destroy');
Route::post('sales-manager/list-sales-leads', 'API\SalesmanagerController@sales_leads');
Route::post('sales-manager/view-sales-leads', 'API\SalesmanagerController@sales_leads_show');
Route::post('sales-manager/edit-sales-leads', 'API\SalesmanagerController@sales_leads_edit');
Route::post('sales-manager/update-sales-leads', 'API\SalesmanagerController@sales_leads_update');

/* ----------------ends------------------ */

/* ----------------Builder Owner---------------- */

Route::post('builder-owner/dashboad', 'API\BuildingownerController@index');
Route::post('builder-owner/flatlists', 'API\BuildingownerController@flatlists');
Route::post('builder-owner/flatshow', 'API\BuildingownerController@flatshow');
Route::post('builder-owner/flatstore', 'API\BuildingownerController@flatstore');
Route::post('builder-owner/flatupdate', 'API\BuildingownerController@flatupdate');
Route::post('builder-owner/flatdestroy', 'API\BuildingownerController@flatdestroy');
Route::post('builder-owner/gardlists', 'API\BuildingownerController@gardlists');
Route::post('builder-owner/gardshow', 'API\BuildingownerController@gardshow');
Route::post('builder-owner/gardstore', 'API\BuildingownerController@gardstore');
Route::post('builder-owner/gardupdate', 'API\BuildingownerController@gardupdate');
Route::post('builder-owner/garddestroy', 'API\BuildingownerController@garddestroy');
Route::post('builder-owner/complaintlists', 'API\BuildingownerController@complaintlists');
Route::post('builder-owner/complaintstore', 'API\BuildingownerController@complaintstore');
Route::post('builder-owner/complaintshow', 'API\BuildingownerController@complaintshow');
Route::post('builder-owner/complaintupdate', 'API\BuildingownerController@complaintupdate');
Route::post('builder-owner/complaintdelete', 'API\BuildingownerController@complaintdelete');
Route::post('builder-owner/purchaseplans', 'API\BuildingownerController@purchaseplans');



/* ---------------- ends ---------------- */

Route::group(['middleware' => 'auth:api'], function(){
	
Route::post('details', 'API\UserController@details');



});