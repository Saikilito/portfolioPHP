<?php

namespace App\Controllers;

use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function loginAction($request){
        $responseMessage = null ;
        
        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            
            $user = User::where('email',$postData['email'] )->first();
        
            if($user){
                if(password_verify($postData['password'], $user->password)){
                    $_SESSION['userID'] = $user->ID ;
                    return new RedirectResponse('/admin');
                }
                else $responseMessage = "Incorrect User or password ";
                
            }
            else $responseMessage = "Incorrect User or password ";

        }

        return $this->renderHTML('login.twig',[
            'responseMessage' => $responseMessage
        ]);
    }

    public function logoutAction(){
        unset($_SESSION['userID']);
        var_dump($_SESSION['userID']);
        return new RedirectResponse('/login');
    }
}

?>