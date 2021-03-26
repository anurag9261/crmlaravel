<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Admin;
use App\Http\Controllers\AdminController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

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



Auth::routes();

Route::get('/admin','HomeController@index')->name('admin');
// Route::get('/','HomeController@index');
Route::get('/logout','HomeController@logout');
Route::get('/admin', [AdminController::class, 'adminHome'])->name('admin.dashboard')->middleware('role');
Route::get('/','AdminController@index');
    /*---------------------Change password Route---------------------------*/
Route::get('/editPassword{id}','AdminController@editpassword')->name('admin.editpassword');
Route::post('/updatePassword{id}','AdminController@updatepassword')->name('admin.updatepassword');


/*---------------------AdminController Route---------------------------*/
Route::get('users','AdminController@index')->name('admin.users');
Route::get('adduser', 'AdminController@create')->name('admin.adduser');
Route::post('adduser','AdminController@store')->name('admin.usersubmit');
Route::get('viewuser{id}', 'AdminController@view')->name('admin.viewuser');
Route::get('edituser{id}', 'AdminController@edit')->name('admin.edituser');
Route::post('updateuser{id}', 'AdminController@update')->name('admin.update');
Route::get('deleteuser{id}', 'AdminController@destroy')->name('admin.deleteuser');


/*---------------------CustomerController Route---------------------------*/
Route::get('/customers','CustomerController@index')->name('admin.customers');
Route::get('addcustomer', 'CustomerController@create')->name('admin.addcustomer');
Route::post('addcustomer','CustomerController@store')->name('admin.customersubmit');
Route::get('viewcustomer{id}', 'CustomerController@view')->name('admin.viewcustomer');
Route::get('editcustomer{id}', 'CustomerController@edit')->name('admin.editcustomer');
Route::post('updatecustomer{id}', 'CustomerController@update')->name('admin.updatecustomer');
Route::get('deletecustomer/{id}', 'CustomerController@destroy')->name('admin.deletecustomer');

/*---------------------RoleController Route---------------------------*/
Route::get('roles','RoleController@index')->name('admin.roles');
Route::get('addrole', 'RoleController@create')->name('admin.addrole');
Route::post('addrole','RoleController@store')->name('admin.rolesubmit');
Route::get('viewrole{id}', 'RoleController@view')->name('admin.viewrole');
Route::get('editrole{id}', 'RoleController@edit')->name('admin.editrole');
Route::post('updaterole{id}', 'RoleController@update')->name('admin.updaterole');
Route::get('deleterole{id}', 'RoleController@destroy')->name('admin.deleterole');

/*---------------------EmployeeController Route---------------------------*/
Route::get('/employees','EmployeeController@index')->name('admin.employee');
Route::get('addemployee', 'EmployeeController@create')->name('admin.addemployee');
Route::post('addemployee','EmployeeController@store')->name('admin.employeesubmit');
Route::get('viewemployee{id}', 'EmployeeController@view')->name('admin.viewemployee');
Route::get('editemployee{id}', 'EmployeeController@edit')->name('admin.editemployee');
Route::post('updateemployee{id}', 'EmployeeController@update')->name('admin.updateemployee');
Route::get('/Employee', 'EmployeeController@exportCsv');
Route::get('deleteemployee{id}', 'EmployeeController@destroy')->name('admin.deleteemployee');

/*---------------------InvoiceController Route---------------------------*/
Route::get('/invoices','InvoiceController@index')->name('admin.invoices');
Route::get('addinvoice', 'InvoiceController@create')->name('admin.addinvoice');
// Route::post('addemployee','EmployeeController@store')->name('admin.employeesubmit');
// Route::get('viewemployee{id}', 'EmployeeController@view')->name('admin.viewemployee');
// Route::get('editemployee{id}', 'EmployeeController@edit')->name('admin.editemployee');
// Route::post('updateemployee{id}', 'EmployeeController@update')->name('admin.updateemployee');
// Route::get('/Employee', 'EmployeeController@exportCsv');
// Route::get('deleteemployee{id}', 'EmployeeController@destroy')->name('admin.deleteemployee');


// Route::get('dropdownlist','DropdownController@index');
Route::get('get-username-list','InvoiceController@getUsernameList');
// Route::get('get-city-list','DropdownController@getCityList');