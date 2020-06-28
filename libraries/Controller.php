<?php

class Controller
{

    protected $viewPath = 'views/';
    protected $layout = 'base';
    protected $folder;
    protected $view;

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
    public function getView($data = [])
    {
        if (file_exists($this->pathView . '/' . $this->folder . '/' . $this->view . '.php')) {
            //si la vue exite
            $vue = $this->pathView . '/' . $this->folder . '/' . $this->view . '.php';
            ob_start();
            require($vue);
            //on recupere le contenu html de la vue et on le met dans $contentView=
            $contentView = ob_get_clean();
            //on require le layout
            $pathLayout = $this->pathView . '/layouts' . '/' . $this->layout . '.php';
            require($pathLayout);
        } else {
            echo "la vue n'existe pa ";
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

    public function loadAjaxData($view, $data = [])
    {
        if (file_exists($this->viewPath . $view . '.php')) {
            ob_start();
            extract($data);
            require($this->viewPath . $view . '.php');
        }
    }
}