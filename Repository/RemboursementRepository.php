<?php





require_once("../Config/serveur.php");
require("../Entity/RemboursementEntity.php");


class RemboursementRepository{

public function create_Remboursement(Remboursement $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO demande VALUES( null, '".$i->getMatricule_agent()."' ,'".$i->getid_cmsDemande()."', '".$i->getDate_demande()."'  ) ");
 
  
}
public function search_Remboursement(Remboursement $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM demande WHERE 	matricule_agent like '%".$i->getMatricule_agent()."%' ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_demande"],$key["matricule_agent"],$key["id_cms"],$key["date_demande"]);
  }
return $af;

}
public function read_Remboursement(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM demande  ");
  // select demande.id_remboursement,matricule_agent,date_demande, SUM(factures.montant_facture) as total_demande from demande JOIN factures ON demande.id_remboursement=factures.id_remboursement  GROUP BY id_remboursement,matricule_agent,date_demande;    $af = array();

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[]= array($key["id_demande"],$key["matricule_agent"],$key["id_cms"],$key["date_demande"]);
    }
return $af;

}
public function delete_Remboursement(Remboursement $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM demande WHERE id_demande  = '".$i->getIdRemboursement()."' AND matricule_agent = '".$i->getMatricule_agent()."'  AND id_cms = '".$i->getid_cmsDemande()."' ");
  

}
public function update_Remboursement(Remboursement $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE demande SET date_demande = '".$i->getDate_demande()."'   WHERE  id_demande  = '".$i->getIdRemboursement()."' AND matricule_agent = '".$i->getMatricule_agent()."' AND id_cms = '".$i->getid_cmsDemande()."' ");
  
} 

}



?>
