<?php

use PluginNameSpace\Bootstrap\Application;
use PluginNameSpace\Bootstrap\Utils;

/**
 * @var Application $application
 */

wp_enqueue_script( 'pluginFileName-app-js', Utils::asset('js/app.js'), [], Utils::version() );
wp_enqueue_style( 'pluginFileName-app-css', Utils::asset('js/app.css'), [], Utils::version() );