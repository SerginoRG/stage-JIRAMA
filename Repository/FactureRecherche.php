<?php





require_once("../Config/serveur.php");
require("../Entity/RecheFacture.php");


class RechercherRepository{


public function search_Facture(Rechercher $i){
  $db= new Db();
    $h=$db->connexion()->query(" SELECT * FROM medical  WHERE  date_piece  between '".$i->getDate_debut()."' and  '".$i->getDate_fin()."' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[]= array($key["id_medicale"],$key["id_demande"], $key["id_analytique"], $key["id_medicament"], $key["numero_piece"],$key["date_piece"], $key["remarque"] , $key["quantite"] , $key["categorie"] , $key["prix_unitaire"]);
    }
return $af;

}
public function read_Facture(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM medical  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_medicale"],$key["id_demande"], $key["id_analytique"], $key["id_medicament"], $key["numero_piece"],$key["date_piece"], $key["remarque"] , $key["quantite"] , $key["categorie"] , $key["prix_unitaire"]);
    }
return $af;

}



}

// SELECT id_remboursement,numero_facture,SUM(montant_facture) as total 
//  FROM factures  GROUP BY id_remboursement,numero_facture ;




?>
