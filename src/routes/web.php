<?php
Route::prefix('/en')->name('lang.')->middleware('web')->group(function () {

    Route::resource('language','Nvt1904\Languages\LanguageController');
    
    Route::get('/push','Nvt1904\Languages\LanguageController@push')->name('push');
});
