<?php namespace Virtuenetz\Portfolio\Components;

use Cms\Classes\ComponentBase;
use Virtuenetz\Portfolio\Models\Portfolio;

class Projects extends ComponentBase{

    public function componentDetails(){
        return [
            'name'=> 'Projects list',
            'description'=> 'List of Favourite Projects'
        ];
    }

    public function onRun(){
        $this->projects = $this->loadProjects();
    }

    protected function loadProjects(){
        return Portfolio::where('favourite',1)->get();
    }

    public $projects;
}
