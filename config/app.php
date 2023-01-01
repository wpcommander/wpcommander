<?php

use PluginNameSpace\App\Http\Middleware\EnsureIsUserAdmin;
use PluginNameSpace\App\Providers\AdminMenuServiceProvider;

return [
    /**
     * Plugin Current Version
     */
    'version'         => '1.0.0',

    /**
     * Service providers
     */
    'providers'       => [],

    'admin_providers' => [
        AdminMenuServiceProvider::class
    ],
    /**
     * Plugin Api Namespace
     */
    'namespace'       => 'plugin-api-namespace',

    'api_versions'    => [],

    'middleware'      => [
        'admin' => EnsureIsUserAdmin::class
    ]
];
