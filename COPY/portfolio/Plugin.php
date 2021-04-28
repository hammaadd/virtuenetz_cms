<?php namespace Virtuenetz\Portfolio;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Virtuenetz\Portfolio\Components\Portfolios'=>'Portfolios'
        ]
    }

    public function pluginDetails()
    {
        return [
            'name'        => 'October Demo',
            'description' => 'Provides features used by the provided demonstration theme.',
            'author'      => 'Alexey Bobkov, Samuel Georges',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerSettings()
    {
    }
}
