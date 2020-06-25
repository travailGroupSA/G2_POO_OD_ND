<?php


class ChambreController extends Controller
{
    public  function __construct()
    {
        $this->layout = 'admin/admin';
        if (!Sessions::get('admin')) {
            $this->layout = 'base';
            $this->redirect();
            die();
        }
    }

    public function liste()
    {

        $this->view('admin/chambres/liste');
    }
}