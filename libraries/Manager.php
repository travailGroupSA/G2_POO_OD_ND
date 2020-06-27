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
        $this->pdo = $this->getConnexion();
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

    //select les donne avec la clause limit et offset
    public function getDataByLimitAndOffset($condition, $limit = 20, $offset = 0)
    {
        $sql = "SELECT * FROM " . $this->tableName . "  " . $condition . " LIMIT " . $limit . " OFFSET " . $offset;
        $dataObejct = $this->executeSelect($sql);
        return $dataObejct;
    }

    //requete select avec la clause where
    public function getUnique($item, $value)
    {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $item . "='" . $value . "'";
        $data = $this->executeSelect($sql);
        return count($data) == 1 ? $data[0] : $data;
    }

    //requeste suppression
    public function delete($item, $value)
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $item . '="' . $value . '"';
        return $this->executeUpdate($sql) != 0;
    }


    function insert_data($data)
    {
        $placeholders = array_fill(0, count($data), '?');

        $keys = $values = array();
        foreach ($data as $k => $v) {
            $keys[] = $k;
            $values[] = !empty($v) ? $v : null;
        }

        // requete
        $query = 'INSERT INTO `' . $this->tableName . '` ' .
            '(' . implode(',', $keys) . ') VALUES ' .
            '(' . implode(',', $placeholders) . ')';
        $this->pdo = $this->getConnexion();
        $this->stmt = $this->pdo->prepare($query);
        if ($this->stmt->execute($values)) {
            $this->closeConnexion();
            return true;
        } else {
            return false;
        }
    }

    public function update($condition, $fields)
    {
        //initialise le nombre de valeur a modifier
        $set = '';
        //ajoute une virgule apres chaque set si on a plusieur valeur a modifier
        $countRow = 1;

        foreach ($fields as $indicArr => $array) {
            foreach ($array as $name => $value) {
                $set .= "{$name}=\"{$value}\"";
                if ($countRow < count($fields)) {
                    $set .= ',';
                }
                $countRow++;
            }
        }
        $sql = "UPDATE " . $this->tableName . " SET {$set} WHERE " . $condition . " ";
        return $this->executeUpdate($sql);
    }
}