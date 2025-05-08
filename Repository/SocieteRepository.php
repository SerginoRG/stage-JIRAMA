<?php




require_once ("../Config/serveur.php");
require("../Entity/Societe.php");


class SocieteRepository{

public function create_Societe(Societe $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO societe VALUES( '".$i->getId_societe()."', '".$i->getNom_societe()."'  ) ");
 
  
}
public function search_Societe(Societe $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM societe WHERE id_societe like '%".$i->getId_societe()."%' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_societe"],$key["nom_societe"]);
  }
return $af;

}
public function read_Societe(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM societe ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
        $af[]= array($key["id_societe"],$key["nom_societe"]);
    }
return $af;

}

public function delete_Societe(Societe $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM societe WHERE id_societe = '".$i->getId_societe()."' ");
  

}
public function update_Societe(Societe $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE societe SET nom_societe = '".$i->getNom_societe()."'   WHERE  id_societe = '".$i->getId_societe()."'  ");
  
} 

}



?>
