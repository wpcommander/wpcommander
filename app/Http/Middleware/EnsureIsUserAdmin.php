<?php

namespace PluginNameSpace\App\Http\Middleware;

use PluginNameSpace\WpCommander\Contracts\Middleware;
use WP_REST_Request;

class EnsureIsUserAdmin implements Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \WP_REST_Request  $wp_rest_request
     * @return bool
     */
    public function handle( WP_REST_Request $wp_rest_request )
    {
        return current_user_can( 'manage_options' );
    }
}
