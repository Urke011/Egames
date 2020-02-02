<?php

namespace app\common;

use app\App;

       
class Controller
{
    public $layout = 'layout/main';       
    
    public function render($view, $data=[])
    {
        if (!is_array($data)) {
            $data = ['content' => $data];
        }
        $viewFile = App::get()->webRoot() . "/src/view/$view.php";
        extract($data);
        ob_start();
        require($viewFile);
        return ob_get_clean();
    }
    
    public function redirect($url)
    {
        header("Location:$url");
        die();
    }
}

