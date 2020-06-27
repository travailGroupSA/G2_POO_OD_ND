<?php class EtudiantManager extends Manager
{
    public function __construct()
    {
        $this->tableName = "etudiant";
        $this->className = "Etudiant";
    }
}