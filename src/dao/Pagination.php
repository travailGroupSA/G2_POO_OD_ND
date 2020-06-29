<?php
require("../libraries/Manager.php");
require 'DaoChambre.php';
require("../models/Chambre.php");
$chambre = new DaoChambre();
$chambre->getConnexion();
$chambre->closeConnexion();
$chambre->successSend();
$chambre->ajout();
$chambre->modifierChambre();
$chambre->deleteChambre();