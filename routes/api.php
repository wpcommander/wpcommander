<?php

use PluginNameSpace\App\Http\Controllers\UserController;
use PluginNameSpace\WpCommander\Route\Route;

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
    Route::get( '/', [UserController::class, 'index'] );
    Route::post( '/create', [UserController::class, 'create'] );
    Route::get( '/{id}', [UserController::class, 'show'] );
} );
