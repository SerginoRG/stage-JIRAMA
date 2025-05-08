<?php




require_once("../Config/serveur.php");
require("../Entity/AnalytiqueEntity.php");


class AnalytiqueRepository{

public function create_Analytique(Analytique $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO analytique VALUES( '".$i->getId_analytique()."', '".$i->getNom_analytique()."'  ) ");
 
  
}
public function search_Analytique(Analytique $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM analytique WHERE id_analytique like '%".$i->getId_analytique()."%' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_analytique"],$key["nom_analytique"]);
  }
return $af;

}
public function read_Analytique(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM analytique  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
        $af[]= array($key["id_analytique"],$key["nom_analytique"]);
    }
return $af;

}
public function delete_Analytique(Analytique $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM analytique WHERE id_analytique = '".$i->getId_analytique()."' ");
  

}
public function update_Analytique(Analytique $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE analytique SET nom_analytique = '".$i->getNom_analytique()."'   WHERE  id_analytique = '".$i->getId_analytique()."'  ");
  
} 

}



?>
