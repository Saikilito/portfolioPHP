<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v ;

class UsersController extends BaseController {
    public function addUserAction($request) {
        $responseMessage = null ;

        if($request->getMethod() == 'POST')
        {            
            $userValidator = v::key('email', v::stringType()->notEmpty()) 
                ->key('password', v::stringType()->notEmpty())
                ->key('password2', v::stringType()->notEmpty());
            
            try{
                
                $postData = $request->getParsedBody();
                
                $userValidator->assert($postData);
                
                if($postData['password'] == $postData['password2'])
                {
                    $user = new user();
                    $user->email = $postData['email'];
                    $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
                    $user->save();
    
                    $responseMessage = 'Saved!';
                }
                else{
                    $responseMessage = 'passwords do not match';
                }
            }   
            catch(\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        
        return $this->renderHTML('addUser.twig',[
            'responseMessage' => $responseMessage
        ]);
    }
}

?>