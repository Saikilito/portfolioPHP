<?php

namespace App\Controllers; 

use App\Models\Job;

class JobsController extends BaseController {
    public function addJobAction($request) {

        if($request->getMethod() == 'POST')
        {
            $postData = $request->getParsedBody();
            $job = new Job();
            $job->title = $postData['title'];
            $job->description = $postData['description'];
            $job->visible = true ;
            $job->save();
        }
        
        // if(!empty($_POST))
        // {
            // $job = new Job();
            // $job->title = $_POST['title'];
            // $job->description = $_POST['description'];
            // $job->visible = true ;
            // $job->save();
        // }
        
        return $this->renderHTML('addJob.twig');
    }
}

?>