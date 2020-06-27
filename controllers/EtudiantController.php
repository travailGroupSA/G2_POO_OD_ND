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
    public function show($matricule)
    {
        $this->etudiant = new EtudiantManager();
        $this->etudiantFound =  $this->etudiant->getUnique('matricule', $matricule);
        // var_dump($this->etudiantFound);
        $data = [
            'matricule' => $this->etudiantFound->getMatricule(),
            'prenom' => $this->etudiantFound->getPrenom(),
            'nom' => $this->etudiantFound->getNom(),
            'mail' => $this->etudiantFound->getMail(),
            'telephone' => $this->etudiantFound->getTelephone(),
            'dateNaissance' => $this->etudiantFound->getDateNaissance(),
            'boursier' => $this->etudiantFound->getBoursier(),
            'typeBourse' => $this->etudiantFound->getTypeBourse(),
            'montantBourse' => $this->etudiantFound->getMontantBourse(),
            'estLoge' => $this->etudiantFound->getEstLoge(),
            'datefistInscription' => $this->etudiantFound->getDatefistInscription(),
            'chambre' => $this->etudiantFound->getChambre(),
            'address' => $this->etudiantFound->getAddress()

        ];
        echo json_encode($data);
    }
}