<?php

namespace PluginNameSpace\Bootstrap;

use WpCommander\Route\Route as RouteRoute;

class Route extends RouteRoute
{
    protected static $group_configuration = [];

    protected static function get_application_instance(): Application
    {
        return Application::$instance;
    }
}
