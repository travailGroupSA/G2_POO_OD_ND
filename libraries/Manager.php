<?php
abstract class Manager implements IReservation
{
    //Connexion est Fermée
    private $pdo = null;
    protected $tableName;
    protected $className;


    //Connexion a la db
    private function getConnexion()
    {
        //teste si la connexion est formée sinon, On crée une instance de PDO
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur de Connexion");
            }
        }
        return $this->pdo;
    }
    //Fermer Connexion
    private function closeConnexion()
    {

        if ($this->pdo != null) {
            $this->pdo = null;
        }
    }

    //Executer une requete(Insert,Update,delete)
    public function executeUpdate($sql)
    {
        $this->getConnexion();
        $nbreLigne = $this->pdo->exec($sql);
        $this->closeConnexion();
        return $nbreLigne;
    }

    //Executer requete Select
    public function executeSelect($sql)
    {

        $this->pdo = $this->getConnexion();
        //Traitement
        $result = $this->pdo->query($sql);
        // $result = $result->fetch();
        $dataObject = [];
        foreach ($result as $rowBD) {
            //transformer le resultat en Objet
            //new Admin($rowBD) => appel la fonction hydrate au niveau du constructeur de la classe ClassName 
            $dataObject[] = new $this->className($rowBD);
        }
        $this->closeConnexion();
        //retourn un tableau d'object
        return $dataObject;
    }

    //requeste select
    public function getALl()
    {
        $sql = "select * from $this->tableName";
        $data = $this->executeSelect($sql);
    }

    //requete select avec la clause where
    public function getUnique($item, $value)
    {
        $sql = "select * from $this->tableName where " . $item . "=" . $value;
        $data = $this->executeSelect($sql);
        return count($data) == 1 ? $data[0] : $data;
    }

    //requeste suppression
    public function delete($item, $value)
    {
        $sql = "delete from $this->tableName where " . $item . "=" . $value;
        return $this->executeUpdate($sql) != 0;
    }
}