<?php

namespace PluginNameSpace\Bootstrap;

use WpCommander\Application as WpCommanderApplication;

class Application extends WpCommanderApplication
{
    public static $instance, $config;
    protected static $instances = [], $configs = [], $is_boot = false, $root_dir, $root_url;

    public function configuration(): array
    {
        return [
            'api' => [
                'register_route' => RegisterRoute::class
            ]
        ];
    }
}
