<?php



require_once("../Config/serveur.php");
require("../Entity/AgentEntity.php");


class AgentRepository{

public function create_Agent(Agent $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO agent VALUES( null,'".$i->getIdSociete()."', '".$i->getNomAgent()."' , '".$i->getPrenomAgent()."', '".$i->getAdresseAgent()."', '".$i->getSexeAgent()."','".$i->getStatut()."', '".$i->getTelephone()."' ,  '".$i->getNumero_compte_Agent()."' ) ");
 
  
}
public function search_Agent(Agent $i){
  $db = new Db();
  $conn = $db->connexion();
  
  // Préparation de la requête avec des paramètres
  $stmt = $conn->prepare("SELECT * FROM agent WHERE matricule_agent LIKE :matricule ");
  
  // Utilisation de % pour la recherche partielle
  $matricule = '%' . $i->getMatriculeAgent() . '%';
  // $nom = '%' . $i->getNomAgent() . '%';
  
  // Lier les paramètres de la requête
  $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
  // $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
  
  // Exécution de la requête
  $stmt->execute();
  
  // Récupération des résultats
  $af = array();
  foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[] = array(
          $key["matricule_agent"],
          $key["id_societe"],
          $key["nom_agent"],
          $key["prenom_agent"],
          $key["adresse_agent"],
          $key["sexe_agent"],
          $key["statut_agent"],
          $key["telephone"],
          $key["compte_bancaire"]
      );
  }
  
  return $af;
}

public function read_Agent(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM agent  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[] = array(
        $key["matricule_agent"],
        $key["id_societe"],
        $key["nom_agent"],
        $key["prenom_agent"],
        $key["adresse_agent"],
        $key["sexe_agent"],
        $key["statut_agent"],
        $key["telephone"],
        $key["compte_bancaire"]
    );}
return $af;

}
public function delete_Agent(Agent $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM agent WHERE matricule_agent = '".$i->getMatriculeAgent()."' ");
  

}
public function update_Agent(Agent $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE agent SET nom_agent = '".$i->getNomAgent()."' ,prenom_agent = '".$i->getPrenomAgent()."' ,id_societe = '".$i->getIdSociete()."',adresse_agent = '".$i->getAdresseAgent()."', sexe_agent = '".$i->getSexeAgent()."', compte_bancaire = '".$i->getNumero_compte_Agent()."',statut_agent= '".$i->getStatut()."',telephone= '".$i->getTelephone()."'  WHERE  matricule_agent = '".$i->getMatriculeAgent()."'   ");
  
} 

}



?>
