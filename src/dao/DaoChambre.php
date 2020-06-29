<?php
require_once('../helpers/functions.php');
class DaoChambre extends Manager
{
    public function __construct()
    {
        $this->tableName = 'chambre';
        $this->className = 'Chambre';
    }
    public function test()
    {
        echo 'newtester';
    }

    public function getChambreByLimit($debut, $limite)
    {
        $sql =
            'SELECT numChambre,numBatiment,type
    FROM chambre 
    ORDER BY numChambre ASC 
    LIMIT ' . $debut . ',' . $limite;
        $data = $this->executeSelect($sql);
        return $data;
    }
    //insertion de chambre
    public function insertChambre($val1, $val2, $val3)
    {
        $sql = "insert into " . $this->tableName . "(numBatiment,type, numChambre) VALUES('" . $val1 . "','" . $val2 . "','" . $val3 . "')";
        $this->executeUpdate($sql);
    }

    //modifier une chambre
    public function editChambre($numChambre, $nomColonne, $value)
    {
        $sql = "update " . $this->tableName . " set " . $nomColonne . " = '" . $value . "' where numChambre='" . $numChambre . "'";
        $this->executeUpdate($sql);
    }

    //suppression de chambre
    public function supprimer($numChambre)
    {
        $sql = "delete from " . $this->tableName . " where numChambre='" . $numChambre . "'";
        $this->executeUpdate($sql);
    }
    //teste si la page existe
    public function successSend()
    {
        if (isset($_POST['page'])) {
            $limite = 5;
            $output = '<div>
        <table class="table table-light">
        <thead class="thead-primary bg-primary text-light">
            <tr>
                <th>num chambre</th>
                <th>num batiment</th>
                <th>type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>';
            $debut = ($_POST['page'] - 1) * $limite;
            $data = $this->getChambreByLimit($debut, $limite);
            foreach ($data as $donnees) {
                $output .= '<tr>
                        <td class="numChambre" id=' . $donnees->getNumchambre() . '>' . $donnees->getNumchambre() . '</td>
                        <td class="numBatiment" id=' . $donnees->getNumchambre() . ' contenteditable>' . $donnees->getNumbatiment() . '</td>
                        <td class="type" id=' . $donnees->getNumchambre() . ' contenteditable>' . $donnees->getType() . '</td>
                        <td><img class="supIcon" id=' . $donnees->getNumchambre() . ' src="../public/icones/ic-supprimer.png">
                        </td>
                    </tr>
                    ';
            }
            $data = $this->findAll();
            // le nbre de lignes dans notre table etudiants
            $compte = count($data);
            // le nbre total de pages
            $nbrePages = ceil($compte / $limite);
            // bouton precedent
            $output .= '<tr>
                <td id="numChambre"></td>
                <td id="numBatiment" contenteditable class="border border-primary"></td>
                <td id="type" contenteditable class="border border-primary"></td>
                <td><img class="float-right addIcon" id=' . $nbrePages . ' src="../public/icones/ic-ajout.png"></td>
            </tr>
            </table><br /><div align="center">';
            if ($_POST["page"] > 1) {
                $output .= '<button class="precedent btn btn-primary" id=' . ($_POST["page"] - 1) . '>Precedent</button>';
            }
            //on affiche les numeros de pages de pagination
            for ($i = 0; $i < $nbrePages; $i++) {
                $output .= '<span class="lienPagination bg-dark text-white border col-3" id="' . ($i + 1) . '">' . ($i + 1) . '</span>';
            }
            //bouton suivant
            if ($_POST["page"] < $nbrePages) {
                $output .= '<button class="suivant btn btn-success" id=' . ($_POST["page"] + 1) . '>Suivant</button></div>';
            }
            echo $output;
        }
    }
    //ajout
    public function ajout()
    {
        if (isset($_POST["numBatiment"]) && isset($_POST["type"])) {
            if (!empty($_POST["numBatiment"]) && !empty($_POST["type"])) {
                if (($_POST['type'] == 'individuel') || ($_POST['type'] == 'a deux')) {
                    $this->insertChambre($_POST['numBatiment'], $_POST['type'], generateNumChambre($_POST['numBatiment']));
                    echo '<div class="text-success">Ajoutée</div>';
                } else {
                    echo '<div class="text-danger">type invalide</div>';
                }
            } else {
                echo '<div class="text-danger">Champs vide</div>';
            }
        }
    }
    //modication d'une chambre
    public function modifierChambre()
    {
        if (isset($_POST['id'])) {
            if (empty($_POST['text'])) {
                echo '<div class="text-danger">champs vide</div>';
            } else if ($_POST['column_name'] == 'type' && (($_POST['text'] != 'individuel') && ($_POST['text'] != 'a deux'))) {
                echo '<div class="text-danger">type invalide</div>';
            } else {
                $this->editChambre($_POST['id'], $_POST['column_name'], $_POST['text']);
                echo '<div class="text-success">Modifiée</div>';
            }
        }
    }

    //public de suppression
    public function deleteChambre()
    {
        if (isset($_POST['theId'])) {
            $this->supprimer($_POST['theId']);
            echo '<div class="text-success"></div>';
        }
    }
}