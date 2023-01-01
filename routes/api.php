<?php

use PluginNameSpace\Bootstrap\Route;

/**
 * Frontend rest api
 */
Route::get( '/posts', function () {
    //
} );

/**
 * Admin rest api
 */
Route::group( ['prefix' => 'user', 'middleware' => ['admin']], function () {
    Route::get( '/', function () {
        //
    } );

    Route::get( '/create', function () {
        //
    } );
} );
