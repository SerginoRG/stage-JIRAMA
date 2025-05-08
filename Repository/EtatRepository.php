<?php





require_once("../Config/serveur.php");
require("../Entity/RecheFacture.php");


class RechercherRepository{


public function search_Facture(Rechercher $i){
  $db= new Db();
    $h=$db->connexion()->query(" SELECT * FROM facture  WHERE  date_facture  between '".$i->getDate_debut()."' and  '".$i->getDate_fin()."' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[]= array($key["id_facture"],$key["id_demande"], $key["id_analytique"], $key["numero_facture"], $key["date_facture"],$key["remarque"], $key["description"] , $key["montant_facture"]);
    }
return $af;

}
public function read_Facture(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM facture  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_facture"],$key["id_demande"], $key["id_analytique"], $key["numero_facture"], $key["date_facture"],$key["remarque"], $key["description"] , $key["montant_facture"]);
    }
return $af;

}



}

// SELECT id_remboursement,numero_facture,SUM(montant_facture) as total 
//  FROM factures  GROUP BY id_remboursement,numero_facture ;




?>
