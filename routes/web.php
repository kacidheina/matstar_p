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
Auth::routes();

Route::get('/', array('as' => '/','uses' =>  'HomeController@index'));

Route::get('/home', array('as' => 'home','uses' =>  'HomeController@index'));

Route::group(['middleware' => 'auth'], function () {


    /************************************** Users Routes ****************************************/
    Route::get('/users',array('as' => 'users','uses' => 'UsersController@index'));
    Route::get('/view_user/{user}',array('as' => 'view_user','uses' => 'UsersController@show'));
    Route::get('/create_user',array('as' => 'create_user','uses' => 'UsersController@create'));
    Route::post('/add_user',array('as' => 'add_user','uses' => 'UsersController@store'));
    Route::get('/edit_user/{user}',array('as' => 'edit_user','uses' => 'UsersController@edit'));
    Route::post('/update_user/{user}',array('as' => 'update_user','uses' => 'UsersController@update'));
    Route::get('/delete_user/{user}',array('as' => 'delete_user','uses' => 'UsersController@destroy'));

    /************************************** Clients Routes ****************************************/
    Route::get('/clients',array('as' => 'clients','uses' => 'ClientsController@index'));
    Route::get('/view_client/{client}',array('as' => 'view_client','uses' => 'ClientsController@show'));
    Route::get('/create_client',array('as' => 'create_client','uses' => 'ClientsController@create'));
    Route::post('/add_client',array('as' => 'add_client','uses' => 'ClientsController@store'));
    Route::get('/edit_client/{client}',array('as' => 'edit_client','uses' => 'ClientsController@edit'));
    Route::post('/update_client/{client}',array('as' => 'update_client','uses' => 'ClientsController@update'));
    Route::get('/delete_client/{client}',array('as' => 'delete_client','uses' => 'ClientsController@destroy'));

    /**************************************Categories Routes ****************************************/
    Route::get('/categories',array('as' => 'categories','uses' => 'CategoriesController@index'));
    Route::get('/view_category/{category}',array('as' => 'view_category','uses' => 'CategoriesController@show'));
    Route::get('/create_category',array('as' => 'create_category','uses' => 'CategoriesController@create'));
    Route::post('/add_category',array('as' => 'add_category','uses' => 'CategoriesController@store'));
    Route::get('/edit_category/{category}',array('as' => 'edit_category','uses' => 'CategoriesController@edit'));
    Route::post('/update_category/{category}',array('as' => 'update_category','uses' => 'CategoriesController@update'));
    Route::get('/delete_category/{category}',array('as' => 'delete_category','uses' => 'CategoriesController@destroy'));

    /**************************************Products Routes ****************************************/
    Route::get('/products',array('as' => 'products','uses' => 'ProductsController@index'));
    Route::get('/view_product/{product}',array('as' => 'view_product','uses' => 'ProductsController@show'));
    Route::get('/create_product',array('as' => 'create_product','uses' => 'ProductsController@create'));
    Route::post('/add_product',array('as' => 'add_product','uses' => 'ProductsController@store'));
    Route::get('/edit_product/{product}',array('as' => 'edit_product','uses' => 'ProductsController@edit'));
    Route::post('/update_product/{product}',array('as' => 'update_product','uses' => 'ProductsController@update'));
    Route::get('/delete_product/{product}',array('as' => 'delete_product','uses' => 'ProductsController@destroy'));
    Route::get('/get_product_variations/{product}',array('as' => 'get_product_variations','uses' => 'ProductsController@get_product_variations'));

    /**************************************Orders Routes ****************************************/
    Route::get('/orders_archive',array('as' => 'orders_archive','uses' => 'OrdersController@index_archive'));
    Route::get('/view_order/{order}',array('as' => 'view_order','uses' => 'OrdersController@show'));
    Route::get('/view_order_invoice/{order}',array('as' => 'view_order_invoice','uses' => 'OrdersController@showInvoice'));
    Route::get('/create_order',array('as' => 'create_order','uses' => 'OrdersController@create'));
    Route::post('/add_order',array('as' => 'add_order','uses' => 'OrdersController@store'));
    Route::get('/edit_order/{order}',array('as' => 'edit_order','uses' => 'OrdersController@edit'));
    Route::post('/update_update/{order}',array('as' => 'update_update','uses' => 'OrdersController@update'));
    Route::get('/delete_order/{order}',array('as' => 'delete_order','uses' => 'OrdersController@destroy'));

    /**************************************Debit Routes ****************************************/
    Route::get('/debit_list',array('as' => 'debit_list','uses' => 'DebitsController@index_company'));
    Route::get('/clients_debit_list',array('as' => 'clients_debit_list','uses' => 'DebitsController@index_client'));
    Route::get('/view_debit/{story_debts}',array('as' => 'view_debit','uses' => 'DebitsController@show'));
    Route::get('/view_client_debit/{debit}',array('as' => 'view_client_debit','uses' => 'DebitsController@show_client_debit'));
    Route::get('/create_debit',array('as' => 'create_debit','uses' => 'DebitsController@create'));
    Route::get('/create_client_debit/{client}',array('as' => 'create_client_debit','uses' => 'DebitsController@create_client_debit'));
    Route::post('/add_debit',array('as' => 'add_debit','uses' => 'DebitsController@store'));
    Route::post('/add_client_debit/{client}',array('as' => 'add_client_debit','uses' => 'DebitsController@store_client_debit'));
    Route::get('/edit_debit/{debit}',array('as' => 'edit_debit','uses' => 'DebitsController@edit'));
    Route::get('/edit_client_debit/{debit}',array('as' => 'edit_client_debit','uses' => 'DebitsController@edit_client_debit'));
    Route::post('/update_debit/{story_debts}',array('as' => 'update_debit','uses' => 'DebitsController@update'));
    Route::post('/update_client_debit/{debit}',array('as' => 'update_client_debit','uses' => 'DebitsController@update_client_debit'));
    Route::get('/delete_debit/{story_debts}',array('as' => 'delete_debit','uses' => 'DebitsController@destroy'));
    Route::get('/delete_client_debit/{debit}',array('as' => 'delete_client_debit','uses' => 'DebitsController@destroy_client_debit'));

    /**************************************Color Routes ****************************************/
    Route::get('/colors',array('as' => 'colors','uses' => 'ColorController@index'));
    Route::get('/view_colors/{color}',array('as' => 'view_colors','uses' => 'ColorController@show'));
    Route::get('/create_color',array('as' => 'create_color','uses' => 'ColorController@create'));
    Route::post('/add_color',array('as' => 'add_color','uses' => 'ColorController@store'));
    Route::get('/edit_color/{color}',array('as' => 'edit_color','uses' => 'ColorController@edit'));
    Route::post('/update_color/{color}',array('as' => 'update_color','uses' => 'ColorController@update'));
    Route::get('/delete_color/{color}',array('as' => 'delete_color','uses' => 'ColorController@destroy'));

    /**************************************Product Entries Routes ****************************************/
    Route::get('/view_entry/{entry}',array('as' => 'view_entry','uses' => 'ProductEntryHistoryController@show'));
    Route::get('/create_entry/{product}',array('as' => 'create_entry','uses' => 'ProductEntryHistoryController@create'));
    Route::post('/add_entry/{product}',array('as' => 'add_entry','uses' => 'ProductEntryHistoryController@store'));
    Route::get('/edit_entry/{entry}',array('as' => 'edit_entry','uses' => 'ProductEntryHistoryController@edit'));
    Route::post('/update_entry/{entry}',array('as' => 'update_entry','uses' => 'ProductEntryHistoryController@update'));
    Route::get('/delete_entry/{entry}',array('as' => 'delete_entry','uses' => 'ProductEntryHistoryController@destroy'));


    /**************************************Product Variation Routes ****************************************/
    Route::get('/view_variation/{variation}',array('as' => 'view_variation','uses' => 'ProductVarationController@show'));
    Route::get('/create_variation/{product}',array('as' => 'create_variation','uses' => 'ProductVarationController@create'));
    Route::post('/add_variation/{product}',array('as' => 'add_variation','uses' => 'ProductVarationController@store'));
    Route::get('/edit_variation/{variation}',array('as' => 'edit_variation','uses' => 'ProductVarationController@edit'));
    Route::post('/update_variation/{variation}',array('as' => 'update_variation','uses' => 'ProductVarationController@update'));
    Route::get('/delete_variation/{variation}',array('as' => 'delete_variation','uses' => 'ProductVarationController@destroy'));



    /**************************************Course Routes ****************************************/
    Route::post('/update_course',array('as' => 'update_course','uses' => 'SystemVariablesController@update_course'));


    /**************************************Expenses Routes ****************************************/

    Route::get('/expenses_list',array('as' => 'expenses_list','uses' => 'ExpensesController@index'));
    Route::get('/view_expenses/{expenses}',array('as' => 'view_expenses','uses' => 'ExpensesController@show'));
    Route::get('/create_expenses',array('as' => 'create_expenses','uses' => 'ExpensesController@create'));
    Route::post('/add_expenses',array('as' => 'add_expenses','uses' => 'ExpensesController@store'));
    Route::get('/edit_expenses/{expenses}',array('as' => 'edit_expenses','uses' => 'ExpensesController@edit'));
    Route::post('/update_expenses/{expenses}',array('as' => 'update_expenses','uses' => 'ExpensesController@update'));
    Route::get('/delete_expenses/{expenses}',array('as' => 'delete_expenses','uses' => 'ExpensesController@destroy'));

});