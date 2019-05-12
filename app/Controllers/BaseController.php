<?php
namespace App\Controllers;

use Zend\Diactoros\Response\HTMLResponse;//for PSR-7 Standar

class BaseController {
    protected $twig;

    public function __construct(){
        $loader = new \Twig\Loader\FilesystemLoader('../views');
        $this->twig = new \Twig\Environment($loader, [
            'debug' => true,
            'cache' => false,
        ]);
    }
    
    public function renderHTML($fileName, $data = []){
        return new HTMLResponse($this->twig->render($fileName, $data));
        
    }
}
?>