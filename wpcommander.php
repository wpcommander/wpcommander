<?php

/**
 * Plugin Name:       PluginName
 * Description:       This plugin is build with WpCommander framework
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Tested up to:      6.1.1
 * Author:            WpCommander
 * Author URI:        http://github.com/wpcommander
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       pluginFileName
 * Domain Path:       /languages
 */

use PluginNameSpace\Bootstrap\Application;

require_once __DIR__ . '/vendor/autoload.php';

class PluginNameSpace
{
    public static function boot()
    {
        $app = Application::instance();

        /**
         * Fires once activated plugins have loaded.
         */
        add_action( 'plugins_loaded', function () use ( $app ): void {
            $app->boot( __DIR__, __FILE__);
        } );
    }
}

PluginNameSpace::boot();

