<?php

use PluginNameSpace\Bootstrap\Route;

Route::group( 'demo', function () {
    Route::get( '/', function () {
        wp_send_json( [
            'message' => 'This is a demo api'
        ] );
    } );
} );
