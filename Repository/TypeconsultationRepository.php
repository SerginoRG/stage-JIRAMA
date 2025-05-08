<?php

require_once("../Config/serveur.php");
require("../Entity/TypeConsultationEntity.php");


class TypeConsultRepository{

    public function create_Type_Consultation(TypeConsultationEntity $i){
     
      $db= new Db();
      
    
    
    $db->connexion()->exec("INSERT INTO type_consultation VALUES(  '".$i->getId_type_consultation()."' , '".$i->getNom_consultation()."', '".$i->getPlafond()."'  ) ");
     
      
    }
    public function search_Type_Consultation(TypeConsultationEntity $i){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM type_consultation WHERE id_type_consultation like '%".$i->getId_type_consultation()."%' ");
    
        $af = array();
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
    $af[]= array($key["id_type_consultation"],$key["nom_consultation"],$key["plafond"]);
      }
    return $af;
    
    }
    

    
    
    
    public function read_Type_Consultation(){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM type_consultation ");
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
            $af[]= array($key["id_type_consultation"],$key["nom_consultation"],$key["plafond"]);
    
    }
    return $af;
    
    }
    
    
    
    public function delete_Type_Consultation(TypeConsultationEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" DELETE FROM type_consultation WHERE id_type_consultation = '".$i->getId_type_consultation()."' ");
      
    
    }
    public function update_Type_Consultation(TypeConsultationEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" UPDATE type_consultation SET nom_consultation = '".$i->getNom_consultation()."', plafond = '".$i->getPlafond()."'    WHERE  id_type_consultation = '".$i->getId_type_consultation()."'   ");
      
    } 
    
    }
    


?>



