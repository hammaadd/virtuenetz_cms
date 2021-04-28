<?php namespace Virtuenetz\Portfolio;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Virtuenetz\Portfolio\Components\Projects'=>'projects'
        ];
    }

  

    public function registerSettings()
    {
    }
}
