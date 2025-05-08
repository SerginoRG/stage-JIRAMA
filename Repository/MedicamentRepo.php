<?php

require_once("../Config/serveur.php");
require("../Entity/MedicamentEntity.php");


class MedicamentRepository{

    public function create_Medicament(MedicamentEntity $i){
     
      $db= new Db();
      
    
    
    $db->connexion()->exec("INSERT INTO medicament VALUES(  '".$i->getId_medicament()."' , '".$i->getNom_medicament()."', '".$i->getType_rembourse()."'  ) ");
     
      
    }
    public function search_Medicament(MedicamentEntity $i){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM medicament WHERE id_medicament like '%".$i->getId_medicament()."%' ");
    
        $af = array();
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
    $af[]= array($key["id_medicament"],$key["nom_medicament"],$key["type_rembourse"]);
      }
    return $af;
    
    }
    

    
    
    
    public function read_Medicament(){
      $db= new Db();
        $h=$db->connexion()->query("SELECT * FROM medicament ");
        foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
            $af[]= array($key["id_medicament"],$key["nom_medicament"],$key["type_rembourse"]);
    
    }
    return $af;
    
    }
    
    
    
    public function delete_Medicament(MedicamentEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" DELETE FROM medicament WHERE id_medicament = '".$i->getId_medicament()."' ");
      
    
    }
    public function update_Medicament(MedicamentEntity $i){
      $db= new Db();
        
      $db->connexion()->exec(" UPDATE medicament SET nom_medicament = '".$i->getNom_medicament()."', type_rembourse = '".$i->getType_rembourse()."'    WHERE  id_medicament = '".$i->getId_medicament()."'   ");
      
    } 
    
    }
    


?>



