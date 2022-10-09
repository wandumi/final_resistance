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

Route::get('/sort', function () {
    return view('sort');
});

Auth::routes(['register' => false]);//

Route::get('/home', 'HomeController@index')->name('home');

/** bbbee */
Route::post('/bbbees_sort', 'BbbeeController@updateAll');
Route::get('/bbbees_sortable', 'BbbeeController@sortable')->name('bbbees_sortable');
Route::resource('bbbees', BbbeeController::class);

/** Circulars */
Route::post('/circulars_sort', 'CicularController@updateAll');
Route::get('/circulars_sortable', 'CicularController@sortable')->name('circulars_sortable');
Route::resource('circulars', CicularController::Class);

/** pages */
Route::post('/shareholders_sort', 'ShareholderController@updateAll');
Route::get('/shareholders_sortable', 'ShareholderController@sortable')->name('shareholder_sortable');
Route::resource('shareholders', ShareholderController::class);

Route::resource('provinces', PronviceController::class);

/** properties */
Route::post('/properties_sort', 'PropertyController@updateAll');
Route::get('/properties_sortable', 'PropertyController@sortable')->name('shareholder_sortable');
Route::resource('properties', PropertyController::class);

Route::resource('announcements', AnnouncementsController::class);

Route::resource('shop_logos', LogoController::class);

Route::resource('page_banners', BannerController::class);

/** Galleries */
Route::get('/gallery_sortable/{property}', 'GalleryController@sortable')->name('gallery_sortable');
Route::post('/gallery_sort', 'GalleryController@updateAll');
Route::resource('galleries', GalleryController::class);

/**The Tenants */
Route::resource('anchor', AnchorTenantController::class);

Route::resource('major', MajorTenantController::class);

Route::resource('following', TheFunController::class);

/**The Portifolio */
Route::prefix('portifolios')->group(function() {

    Route::resource('portifolio', PortifolioController::class);

    Route::resource('portifolio_lists', PortifolioListController::class);

});

Route::prefix('financials')->group(function(){
    Route::resource('financial', FinancialController::class);

    Route::resource('financial_section', FinancialSectionController::class);
});

Route::prefix('presentations')->group(function(){
    Route::resource('presentation', PresentationController::class);

    Route::resource('presentation_sections', PresentationSectionController::class);
});

Route::prefix('dmtns')->group(function(){
    Route::resource('dmtn', DmtnController::class);

    Route::resource('dmtn_sections', DmtnSectionController::class);

    Route::post('/program_documents_sort', 'DmtnProgDocumentsController@updateAll');
    Route::get('/program_documents_sortable', 'DmtnProgDocumentsController@sortable')->name('program_documents_sortable');
    Route::resource('program_documents', DmtnProgDocumentsController::class);

    Route::post('/policies_sort', 'DmtnPoliciesController@updateAll');
    Route::get('/policies_sortable', 'DmtnPoliciesController@sortable')->name('policies_sortable');
    Route::resource('policies', DmtnPoliciesController::class);

    Route::post('/price_supplements_sort', 'DmtnPriceSupplementsController@updateAll');
    Route::get('/price_supplements_sortable', 'DmtnPriceSupplementsController@sortable')->name('price_supplements_sortable');
    Route::resource('price_supplements', DmtnPriceSupplementsController::class);

    Route::post('/credit_ratings_sort', 'DmtnCreditRatingController@updateAll');
    Route::get('/credit_ratings_sortable', 'DmtnCreditRatingController@sortable')->name('credit_ratings_sortable');
    Route::resource('credit_ratings', DmtnCreditRatingController::class);
});

/** Calendar */

Route::resource('calendar', CalendarController::class);

/**User Managment */

Route::resource('users', UserController::class);

/** Schedule of properties */
Route::post('/schedules_properties_sort', 'SchedulePropertyController@updateAll');
Route::get('/schedules_properties_sortable', 'SchedulePropertyController@sortable')->name('schedules_properties_sortable');
Route::resource('schedules_properties', SchedulePropertyController::class);

/** tables */
// Route::resource('financial_performance', InvestorRelationController::class);
Route::resource('financial_performance', TablesController::class);

/** Years */
Route::resource('years', YearController::class);

/** Portifolio Banners */
Route::resource('portifolio_banners', PortifolioBannerController::class);
