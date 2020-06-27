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
        $etudiant = new EtudiantManager();

        if (isset($_POST['search'])) {
            extract($_POST);
            $condition = " WHERE " . $type . " LIKE '%" . $searched . "%'";
            $this->etudiants = $etudiant->getDataByLimitAndOffset($condition);
        } else {
            $this->etudiants = $etudiant->getDataByLimitAndOffset("");
        }

        //donné a affiche 
        $this->selectTypeBourse = ["demi-bourse" => "demi", "pension complète" => "entiere", "non boursiers" => "pasbourse"];
        $this->typeSearch = ["matricule", "typeBourse", "département"];
        $data = [
            'typeSearch' => $this->typeSearch,
            'etudiants' => $this->etudiants,
            'selectTypeBourse' => $this->selectTypeBourse,
        ];

        $this->view('admin/etudiants/liste', $data);
    }
    public function show($id)
    {
        echo "id " . $id;
    }
}