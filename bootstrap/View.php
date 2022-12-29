<?php

namespace PluginNameSpace\Bootstrap;

use WpCommander\View\View as WpCommanderView;

class View extends WpCommanderView
{
    protected static function get_application_instance(): Application
    {
        return Application::$instance;
    }
}
