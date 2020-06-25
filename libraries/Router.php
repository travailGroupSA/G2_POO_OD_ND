<?php

class Router
{
    protected $currentController = 'AuthController';
    protected $currentMethod = "login";
    protected $params = [];
    public function __construct()
    {
        $url = $this->getUrl();

        if (file_exists('./controllers/' . ucfirst(strtolower($url[0]) . 'Controller.php'))) {
            $this->currentController = ucfirst(strtolower($url[0])) . 'Controller';
        } elseif (isset($url[0])) {
            $this->currentController = 'ErrorController';
            $this->currentMethod = 'showerror';
            $this->params = "le controlleur";
        }
        require_once "./controllers/" . $this->currentController . ".php";

        $this->currentController = new $this->currentController();
        if (isset($url[1])) {
            if (method_exists($this->currentController, strtolower($url[1]))) {
                $this->currentMethod = strtolower($url[1]);
            } else {
                $this->currentController = 'ErrorController';
                $this->currentMethod = 'showerror';
                $this->params = "la methode";
                require_once "./controllers/" . $this->currentController . ".php";

                $this->currentController = new $this->currentController();
            }
        } elseif (isset($url[0])) {
            die('dd');
        }


        if (isset($url[2])) {
            $this->params = $url[2];
        }
        call_user_func([$this->currentController, $this->currentMethod], $this->params);
    }

    private function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}