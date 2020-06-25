<?php


class EtudiantController extends Controller
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
    public function index()
    {
        $this->view('admin/index');
    }

    public function liste()
    {
        if (isset($_POST['search'])) {
            var_dump($_POST);
        }
        $this->typeSearch = ["matricule", "type", "département"];
        $data = ['typeSearch' => $this->typeSearch];
        $this->view('admin/etudiants/liste', $data);
    }
    public function show($id)
    {
        echo "id " . $id;
    }
}