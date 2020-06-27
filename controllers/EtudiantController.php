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
    public function delete($matricule)
    {
        $this->etudiant = new EtudiantManager();
        $this->etudiantDeleted = $this->etudiant->delete("matricule", $matricule);
        if ($this->etudiantDeleted) {
            $this->redirect("etudiant/liste");
        }
        $this->redirect("etudiant/liste");
    }
    public function create()
    {
        extract($_POST);
        if (Validations::exist(@$create)) {
            $datefistInscription = date("Y-m-d");

            $this->datas = [
                'prenom' => $prenom,
                'nom' => $nom,
                'mail' => $email,
                'telephone' => $telephone,
                'dateNaissance' => $dateNaissance,
                'typeBourse' => $typeBourse,
                'datefistInscription' => $datefistInscription
            ];
            Validations::isAllEmpty($this->datas);
            Validations::isEmail($email);
            if ($typeBourse == "pasbourse") {

                $this->datas["estLoge"] = 0;
                $this->datas["montantBourse"] = 0;
                if (Validations::exist($address)) {
                    $this->datas["adress"] =  $address;
                    $this->datas["boursier"] = 0;
                }
            } else {
                $this->datas["boursier"] = 1;
                if (Validations::exist(@$chambre)) {
                    $this->datas["estLoge"] =  1;
                    $this->datas["chambre"] = $chambre;
                }
                if ($typeBourse == "entiere") {
                    $this->datas["montantBourse"] = 40000;
                } else {
                    $this->datas["montantBourse"] = 20000;
                }
            }

            if (Validations::isValid()) {
                $matricule = generateMatricule($prenom, $nom);
                $this->datas["matricule"] = $matricule;
                $this->etudiant = new EtudiantManager();
                $envoyer = $this->etudiant->insert_data($this->datas);
                if ($envoyer) {
                    echo json_encode('created');
                }
            }
        } else {
            $this->redirect("etudiant/liste");
        }
    }
}