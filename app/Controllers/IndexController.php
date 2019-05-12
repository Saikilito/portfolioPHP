<?php

namespace App\Controllers;

use App\Models\{Job, Project};

class IndexController extends BaseController {
    public function indexAction(){
        $jobs = Job :: all();

        $project1 = new Project("Proyect 1","Desciption 1");
        $projects = [
            $project1
        ];

        return $this->renderHTML('index.twig', [
            "jobs" => $jobs,
        ]);
    }
}


?>