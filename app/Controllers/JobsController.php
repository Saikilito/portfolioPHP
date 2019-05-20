<?php

namespace App\Controllers; 

use App\Models\Job;
use Respect\Validation\Validator as v ;

class JobsController extends BaseController {
    public function addJobAction($request) {

        $responseMessage = null;

        if($request->getMethod() == 'POST')
        {            
            $jobValidator = v::key('title', v::stringType()->notEmpty()) 
                ->key('description', v::stringType()->notEmpty()); // true  
            
            try{
                
                $postData = $request->getParsedBody();
                
                $jobValidator->assert($postData);
                
                $files = $request->getUploadedFiles();
                $avatar = $files['jobAvatar'];

                if($avatar->getError() == UPLOAD_ERR_OK){
                    $fileName = $avatar->getClientFilename();
                    $avatar->moveTo("uploads/$fileName");
                }

                $job = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->filename = $fileName;
                $job->visible = true ;
                $job->save();

                $responseMessage = 'Saved!';
            }   
            catch(\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        
        return $this->renderHTML('addJob.twig',[
            'responseMessage' => $responseMessage
        ]);
    }
}

?>