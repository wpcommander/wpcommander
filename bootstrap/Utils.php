<?php

namespace PluginNameSpace\Bootstrap;

use WpCommander\Utils\Common;

class Utils extends Common
{
    protected static function get_application_instance(): Application
    {
        return Application::$instance;
    }
}
