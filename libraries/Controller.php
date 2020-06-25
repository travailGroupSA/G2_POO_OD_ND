<?php

class Controller
{

    protected $viewPath = 'views/';
    protected $layout = 'base';
    protected $validations;

    public function view($view, $data = [])
    {
        if (file_exists($this->viewPath . $view . '.php')) {
            ob_start();
            extract($data);
            require($this->viewPath . $view . '.php');
            $content = ob_get_clean();
            require($this->viewPath . 'layouts/' . $this->layout . '.php');
        }
    }

    //direction
    function redirect($page = '')
    {
        if ($page == "") {
            header('location: ' . URLROOT);
        } else {
            header('location: ' . URLROOT  . '/' . $page);
        }
    }
}