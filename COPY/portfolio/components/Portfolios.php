<?php namespace Virtuenetz\Portfolio\Components;

use Cms\Classes\ComponentBase;
use Virtuenetz\Portfolio\Models\Portfolio;

class Portfolios extends ComponentBase{

    public function componentDetails(){
        return [
            'name'=> 'Projects list',
            'description'=> 'List of Favourite Projects'
        ];
    }

    public function onRun(){
        $this->portfolios = $this->loadProjects();
    }

    protected function loadProjects(){
        return Portfolio::all();
    }

    public $portfolios;
}
