<?php

require_once("../Config/serveur.php");
require("../Entity/HospitalisationLimiteEntity.php");


class TypeHopistalRepository{

    public function create_Type_Hospitalisation(TypeHospitalisationEntity $i){
     
      $db= new Db();
      
    
    $db->connexion()->exec("INSERT INTO type_hospitalisation VALUES(  '".$i->getId_type_hospitalisation()."' , '".$i->getNom_hospitalisation()."', '".$i->getPlafond()."'  ) ");
     
      
    }
    public function search_Type_Hospitalisation(TypeHospitalisationEntity $i){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM type_hospitalisation WHERE id_type_hospitalisation like '%".$i->getId_type_hospitalisation()."%' ");
    
        $af = array();
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
    $af[]= array($key["id_type_hospitalisation"],$key["nom_hospitalisation"],$key["plafond"]);
      }
    return $af;
    
    }
    

    
    
    
    public function read_Type_Hospitalisation(){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM type_hospitalisation ");
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
            $af[]= array($key["id_type_hospitalisation"],$key["nom_hospitalisation"],$key["plafond"]);
    
    }
    return $af;
    
    }
    
    
    
    public function delete_Type_Hospitalisation(TypeHospitalisationEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" DELETE FROM type_hospitalisation WHERE id_type_hospitalisation = '".$i->getId_type_hospitalisation()."' ");
      
    
    }
    public function update_Type_Hospitalisation(TypeHospitalisationEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" UPDATE type_hospitalisation SET nom_hospitalisation = '".$i->getNom_hospitalisation()."', plafond = '".$i->getPlafond()."'    WHERE  id_type_hospitalisation = '".$i->getId_type_hospitalisation()."'   ");
      
    } 
    
    }
    


?>



