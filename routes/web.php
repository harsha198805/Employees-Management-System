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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth']],function(){
Route::get('/employees', 'EmployeesController@index')->name('employees.index');
Route::get('/employees/create', 'EmployeesController@create')->name('employees.create');
Route::post('/employees/store', 'EmployeesController@store')->name('employees.store');
Route::get('/employees/{id}', 'EmployeesController@show')->name('employees.show');
Route::get('/employees/{id}/edit', 'EmployeesController@edit')->name('employees.edit');
Route::put('/employees/{id}/update', 'EmployeesController@update')->name('employees.update');
Route::delete('/employees/{id}/destroy', 'EmployeesController@destroy')->name('employees.destroy');

Route::get('/companies', 'CompaniesController@index')->name('companies.index');
Route::get('/companies/create', 'CompaniesController@create')->name('companies.create');
Route::post('/companies/store', 'CompaniesController@store')->name('companies.store');
Route::get('/companies/{id}', 'CompaniesController@show')->name('companies.show');
Route::get('/companies/{id}/edit', 'CompaniesController@edit')->name('companies.edit');
Route::put('/companies/{id}/update', 'CompaniesController@update')->name('companies.update');
Route::delete('/companies/{id}/destroy', 'CompaniesController@destroy')->name('companies.destroy');
});

