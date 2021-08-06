<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;

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


//news
Route::get('/create', 'NewsController@createNews')->name('createNews');
Route::post('/save', 'NewsController@saveNews')->name('saveNews');
Route::get('/show', 'NewsController@showNews')->name('showNews');
Route::get('delete/{id}', 'NewsController@deleteNews')->name('deleteNews');
Route::get('edit/{id}', 'NewsController@editNews')->name('editNews');
Route::post('/update/{id}', 'NewsController@updateNews')->name('updateNews');
Route::post('/search', 'NewsController@searchNews')->name('searchNews');
Route::get('/search', 'NewsController@searchNews')->name('searchNews');


Auth::routes();
Route::get('/admin', 'NewsController@name')->name('admin');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UserssController@index')->name('user');

Route::get('/test', 'NewsController@test')->name('test');




// Route::get('/datatables/posts',  'DatatableController@posts' );
// Route::get('/datatables',  'DatatableController@index');
// Route::get('/datatables1/posts',  'NewsController@posts1' );
// Route::get('/datatables1',  'NewsController@index1');
// Route::post('/testPostback',  'NewsController@testPostback')->name('testPostback');


//category
Route::get('/createCategory', 'NewsCategoryController@createCategory')->name('createCategory');
Route::post('/saveCategory', 'NewsCategoryController@saveCategory')->name('saveCategory');
Route::get('/showCategory', 'NewsCategoryController@showCategory')->name('showCategory');
Route::get('deleteCategory/{id}', 'NewsCategoryController@deleteCategory')->name('deleteCategory');
Route::get('editCategory/{id}', 'NewsCategoryController@editCategory')->name('editCategory');
Route::post('/updateCategory/{id}', 'NewsCategoryController@updateCategory')->name('updateCategory');
Route::post('/searchCategory', 'NewsCategoryController@searchCategory')->name('searchCategory');
Route::get('/searchCategory', 'NewsCategoryController@searchCategory')->name('searchCategory');



