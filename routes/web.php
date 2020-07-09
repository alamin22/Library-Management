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
Route::get('/admin/login', 'Admin\AdminLoginController@loginAdmin')->name('adminlogin.loginAdmin');
Route::post('/admin/login', 'Admin\AdminLoginController@loginAdminVerify')->name('adminlogin.loginAdminVerify');
Route::group(['middleware'=>['adminSession']],function(){
	Route::get('/', 'Admin\AdminController@index')->name('admin.index');
	Route::get('/Admin/Profile', 'Admin\AdminController@adminProfile')->name('admin.adminProfile');
	Route::post('/admin/profile/update', 'Admin\AdminController@adminProfileUpdate')->name('admin.adminProfileUpdate');
	Route::get('/admin/logout', 'Admin\AdminController@adminLogout')->name('admin.adminLogout');

//********************* Book Donator ************************
Route::get('/school/library/book/donators','Library\BookDonatorsController@index')->name('library.bookDonators');
Route::get('/school/library/book/add/donator','Library\BookDonatorsController@addDonators')->name('library.addDonators');
Route::post('/school/library/book/donator/store','Library\BookDonatorsController@addDonatorsStore')->name('library.addDonatorsStore');
Route::get('/school/library/book/donator/Data','Library\BookDonatorsController@getDonatorsData')->name('library.getDonatorsData');
Route::get('/school/library/book/donator/Update/{id}','Library\BookDonatorsController@updateValue')->name('library.updateValue');
Route::post('/school/library/book/donator/Update/Store','Library\BookDonatorsController@updateDonatorsStore')->name('library.updateDonatorsStore');
Route::post('/school/library/book/donator/Delete','Library\BookDonatorsController@donatorsDelete')->name('library.donatorsDelete');
});

//*******************book publisher ************************
Route::get('/school/library/book/publishers','Library\BookPublishersController@index')->name('library.bookpublishers');
Route::get('/school/library/book/publishers/add','Library\BookPublishersController@add')->name('library.bookpublishersadd');
Route::post('/school/library/book/publishers/add','Library\BookPublishersController@store')->name('library.bookpublishersadd');
Route::get('/school/library/book/publishers/edit/{id}','Library\BookPublishersController@edit')->name('library.bookpublishersedit');
Route::post('/school/library/book/publishers/update/store','Library\BookPublishersController@update')->name('library.bookpublisherseditStore');
Route::post('/school/library/book/publishers/search','Library\BookPublishersController@search')->name('library.bookpublisherssearch');
Route::post('/school/library/book/publishers/delete','Library\BookPublishersController@delete')->name('library.bookpublishersdelete');

//******************** Book writer ***************************
    Route::get('/school/library/book/writer','Library\BookWriterController@index')->name('library.bookWriter');
    Route::get('/school/library/book/writer/add','Library\BookWriterController@add')->name('library.bookWriteradd');
    Route::post('/school/library/book/writer/add','Library\BookWriterController@store')->name('library.bookWriteradd');
    Route::get('/school/library/book/writer/edit/{id}','Library\BookWriterController@edit')->name('library.bookWriteredit');
    Route::post('/school/library/book/writer/update/store','Library\BookWriterController@update')->name('library.bookWriterUpdate');
    Route::get('/school/library/book/writer/search','Library\BookWriterController@search')->name('library.bookWritersearch');
    Route::post('/school/library/book/writer/delete','Library\BookWriterController@delete')->name('library.bookWriterdelete');

//******************** Book Category ***********************
	Route::get('/school/library/bookCategoryIndex','Library\BooksCategoryController@bookCategoryIndex')->name('library.bookCategoryIndex');
	Route::post('/school/library/addCategory','Library\BooksCategoryController@addCategory')->name('library.addCategory');
	Route::get('/school/library/getCategory','Library\BooksCategoryController@getCategory')->name('library.getCategory');
	Route::post('/school/library/delete','Library\BooksCategoryController@delete')->name('library.categorydelete');

//************************** Library Book ***********************

	Route::get('/school/library/bookManagementList','Library\BooksManagmentController@bookManagementList')->name('library.bookManagementList');
	Route::get('/school/library/bookManagemenAdd','Library\BooksManagmentController@bookManagemenAdd')->name('school.bookManagemenAdd');
	Route::post('/school/library/bookManagemenAdd','Library\BooksManagmentController@bookManagemenAddStore')->name('school.bookManagemenAddStore');
	Route::get('/school/library/searchBookCategory','Library\BooksManagmentController@searchBookCategory')->name('library.searchBookCategory');
	Route::get('/school/library/bookLibraryEdit/{id}','Library\BooksManagmentController@bookLibraryEdit')->name('library.bookLibraryEdit');
	Route::post('/school/library/bookLibraryEdit','Library\BooksManagmentController@bookLibraryUpdate')->name('library.bookLibraryUpdate');
	Route::get('/school/library/bookLibraryDelete','Library\BooksManagmentController@bookLibraryDelete')->name('library.bookLibraryDelete');

//************************** Self *************************
	Route::get('/school/library/book/self','Library\LibrarySelfController@index')->name('library.LibrarySelf');
    Route::get('/school/library/book/self/get','Library\LibrarySelfController@get_all')->name('library.LibrarySelfShow');
    Route::post('/school/library/book/self/add','Library\LibrarySelfController@store')->name('library.LibrarySelfadd');
    Route::post('/school/library/book/self/edit','Library\LibrarySelfController@update')->name('library.LibrarySelfedit');
    Route::post('/school/library/book/self/delete','Library\LibrarySelfController@delete')->name('library.LibrarySelfdelete');

// ************************* Book self **************************
	Route::get('/school/library/book/Self','Library\bookSelfController@index')->name('library.bookSelfIndex');
	Route::get('/school/library/book/page','Library\bookSelfController@bookSelfPage')->name('library.bookSelfPage');
	Route::post('/school/library/book/Store','Library\bookSelfController@bookSelfStore')->name('library.bookSelfStore');
	Route::get('/school/library/book/Get','Library\bookSelfController@getBookSelfData')->name('library.getBookSelfData');
	Route::post('/school/library/book/self/Delete','Library\bookSelfController@bookSelfDataDelete')->name('library.bookSelfDataDelete');
	Route::get('/school/library/book/self/update/{id}','Library\bookSelfController@updateValue')->name('library.updateValue');
	Route::post('/school/library/book/self/update/Store','Library\bookSelfController@updateStore')->name('library.updateStore');

//***************************book issue*******************************
	Route::get('/school/library/bookIssueIndex','Library\BookIssueController@bookIssueIndex')->name('library.bookIssueIndex');
	Route::get('/school/library/searchBookIssue','Library\BookIssueController@searchBookIssue')->name('library.searchBookIssue');
	Route::post('/school/library/bookIssueInsert','Library\BookIssueController@bookIssueInsert')->name('library.bookIssueInsert');

//***************************** book retun ******************************
Route::get('/school/library/book/Return','Library\bookReturnController@index')->name('library.bookReturnIndex');
Route::get('/school/library/book/Return/data','Library\bookReturnController@getBookReturnData')->name('library.getBookReturnData');
Route::post('/school/library/book/Return/store','Library\bookReturnController@bookReturnStore')->name('library.bookReturnStore');
Route::post('/school/library/book/Renew','Library\bookReturnController@bookRenew')->name('library.bookRenew');
Route::get('/school/library/book/return/view','Library\bookReturnController@bookReturnView')->name('library.bookReturnView');

//*************************** Book Issue History *********************************
Route::get('/school/library/book/Issue/History','Library\BookIsskueHistory@index')->name('library.BookIssueHistory');
Route::get('/school/library/bookIssue/History/Data','Library\BookIsskueHistory@getData')->name('library.getData');
