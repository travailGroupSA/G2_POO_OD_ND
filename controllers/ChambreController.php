<?php


class ChambreController extends Controller
{
    public  function __construct()
    {
        $this->layout = 'admin/admin';
        $this->folder = 'admin/chambre';
        if (!Sessions::get('admin')) {
            $this->layout = 'base';
            $this->redirect();
            die();
        }
    }

    public function listchambre()
    {
        // $this->view = 'listeChambres';
        // $this->getView();
        $this->view('admin/chambres/listeChambres');
    }
}