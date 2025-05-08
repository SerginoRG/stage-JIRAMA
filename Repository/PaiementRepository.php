<?php





require_once("../Config/serveur.php");
require("../Entity/PaiementEntity.php");


class PaiementRepository{

public function create_Paiement(Paiement $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO paiement VALUES( null, '".$i->getId_remboursement()."' , '".$i->getMode_paiement()."', '".$i->getDate_paiement()."'  ) ");
 
// PAIEMENT EMAIL 
// SELECT agent.matricule_agent,nom_agent , prenom_agent,societe_agent,email_agent FROM  demande   JOIN agent ON agent.matricule_agent=demande.matricule_agent WHERE  id_remboursement = 12;

  
}
public function search_Paiement(Paiement $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM paiement WHERE id_demande like '%".$i->getId_remboursement()."%' ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_paiement"],$key["id_demande"],$key["mode_paiement"],$key["date_paiement"]);
  }
return $af;

}
// public function read_Paiement(){
//   $db= new Db();
//     $h=$db->connexion()->query("SELECT * FROM paiements  ");

//     $af = array();
//     foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
// $af[]= array($key["id_paiement"],$key["id_remboursement"],$key["mode_paiement"],$key["date_paiement"]);
// }
// return $af;

// }



public function read_Paiement(){
  $db= new Db();
    $h=$db->connexion()->query("
    select paiement.id_paiement, paiement.id_demande,agent.matricule_agent, paiement.mode_paiement,paiement.date_paiement, SUM(facture.montant_facture) AS somme_total_facture from paiement join facture on paiement.id_demande=facture.id_demande join demande on demande.id_demande=facture.id_demande join agent on agent.matricule_agent=demande.matricule_agent GROUP BY paiement.id_paiement,paiement.id_demande, agent.matricule_agent,paiement.mode_paiement,paiement.date_paiement;  ");
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_paiement"],$key["id_demande"],$key["matricule_agent"],$key["mode_paiement"],$key["date_paiement"], $key["somme_total_facture"]);

}
return $af;

}

// select paiements.id_paiement, paiements.id_remboursement,agent.matricule_agent, paiements.mode_paiement,paiements.date_paiement, SUM(factures.montant_facture) AS somme_total_facture from paiements join factures on paiements.id_remboursement=factures.id_remboursement join demande on demande.id_remboursement=factures.id_remboursement join agent on agent.matricule_agent=demande.matricule_agent GROUP BY paiements.id_paiement,paiements.id_remboursement, agent.matricule_agent,paiements.mode_paiement,paiements.date_paiement;







public function delete_Paiement(Paiement $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM paiement WHERE id_paiement = '".$i->getId_paiement()."'  AND id_demande = '".$i->getId_remboursement()."' ");
  

}
public function update_Paiement(Paiement $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE paiement SET mode_paiement = '".$i->getMode_paiement()."' ,date_paiement = '".$i->getDate_paiement()."'   WHERE  id_paiement = '".$i->getId_paiement()."' AND id_demande = '".$i->getId_remboursement()."'  ");
  
} 

}



?>




<!-- select  demande.id_remboursement,agent.prenom_agent ,demande.date_demande, paiement.date_paiement, 
facture.numero_facture, facture.date_facture, facture.description,facture.montant_facture  from demande
join facture on demande.id_remboursement=facture.id_remboursement join paiement on demande.id_remboursement
=paiement.id_remboursement join agent on agent.matricule_agent=demande.matricule_agent join analytique on 
analytique.id_analytique=facture.id_analytique  where demande.matricule_agent=1; -->



<!-- select SUM(facture.montant_facture) AS total_facture  from demande join facture on demande.id_remboursement=
facture.id_remboursement join paiement on demande.id_remboursement=paiement.id_remboursement join agent on 
agent.matricule_agent=demande.matricule_agent join analytique on analytique.id_analytique=facture.id_analytique 
 where demande.matricule_agent=1; -->