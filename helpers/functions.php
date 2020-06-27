<?php
//function génére le Matricule suivant ce Format​, Annee CC LL 0000
function generateMatricule($prenom, $nom)
{
    $year = date("Y");
    $twoFirstCharNom = substr($nom, 0, 2);
    $lenPrenom = strlen($prenom);
    $twoLastCharPrenom = substr($prenom, $lenPrenom - 2);
    //genere une série de quatre chiffre qui est distinct
    $randomnum = rand();
    $strnum = (string) ($randomnum);
    $serieNum = substr($strnum, 0, 4);
    $matricule = $year . $twoFirstCharNom . $twoLastCharPrenom . $serieNum;

    return $matricule;
};