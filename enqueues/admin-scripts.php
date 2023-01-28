<?php

use PluginNameSpace\WpCommander\Utils\Common;

wp_enqueue_script( 'pluginFileName-app-js', Common::asset('js/app.js'), [], Common::version(), true );
wp_enqueue_style( 'pluginFileName-app-css', Common::asset('css/app.css'), [], Common::version() );