<?php

require_once("../Config/serveur.php");
require("../Entity/CmsEntity.php");


class CMSRepository{

    private $db;

// Constructeur pour initialiser la connexion à la base de données
public function __construct() {
    $this->db = new Db();
}

// Méthode pour vérifier si un agent existe
public function agentExists($matricule_agent) {
    $query = $this->db->connexion()->prepare("SELECT COUNT(*) FROM cms WHERE matricule_agent = :matricule_agent");
    $query->bindParam(':matricule_agent', $matricule_agent);
    $query->execute();
    return $query->fetchColumn() > 0;
}

// Méthode pour insérer un agent
public function create_CMS(Cms $i) {
    // Vérifiez si l'agent existe déjà
    if ($this->agentExists($i->getMatricule_agentCMS())) {
        throw new Exception("Cet agent est déjà inscrit dans la base de données.");
    }

    // Préparez et exécutez la requête d'insertion
    $query = $this->db->connexion()->prepare("
        INSERT INTO cms  VALUES (null, :matricule_agent, :nom_cms, :role_cms)
    ");
    $query->bindParam(':matricule_agent', $i->getMatricule_agentCMS());
    $query->bindParam(':nom_cms', $i->getNom_cms());
    $query->bindParam(':role_cms', $i->getRole_cms());
    $query->execute();
}













public function read_CMS() {
    $db = new Db();
    $h = $db->connexion()->query("SELECT * FROM cms");
    $af = []; // Initialisation du tableau
    foreach ($h->fetchAll(PDO::FETCH_ASSOC) as $key) {
        $af[] = array($key["id_cms"], $key["matricule_agent"], $key["nom_cms"], $key["role"]);
    }
    return $af;
}









public function delete_CMS(Cms $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM cms WHERE id_cms = '".$i->getId_cms()."'  AND  matricule_agent = '".$i->getMatricule_agentCMS()."' ");
  

}


}



?>



