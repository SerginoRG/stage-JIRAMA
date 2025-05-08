<?php





require_once("../Config/serveur.php");
require("../Entity/RecheFacture.php");


class PRepository{

public function search_P(Rechercher $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT paiement.id_paiement, paiement.id_demande,agent.matricule_agent, paiement.mode_paiement,paiement.date_paiement, SUM(facture.montant_facture) AS somme_total_facture FROM paiement  join facture on paiement.id_demande=facture.id_demande join demande on demande.id_demande=facture.id_demande join agent on agent.matricule_agent=demande.matricule_agent  WHERE  date_paiement  between '".$i->getDate_debut()."' and  '".$i->getDate_fin()."'  GROUP BY paiement.id_paiement,paiement.id_demande, agent.matricule_agent,paiement.mode_paiement,paiement.date_paiement;  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
        $af[]= array($key["id_paiement"],$key["id_demande"],$key["matricule_agent"],$key["mode_paiement"],$key["date_paiement"], $key["somme_total_facture"]);
    }
return $af;

}



public function read_P() {
  $db = new Db();
  $af = []; // Initialisation du tableau

  try {
      $h = $db->connexion()->query("
          SELECT 
              paiement.id_paiement, 
              paiement.id_demande, 
              agent.matricule_agent, 
              paiement.mode_paiement, 
              paiement.date_paiement, 
              
          FROM paiement 
           
          JOIN demande ON paiement.id_demande = demande.id_demande 
          JOIN agent ON agent.matricule_agent = demande.matricule_agent 
          GROUP BY paiement.id_paiement, paiement.id_demande, agent.matricule_agent, paiement.mode_paiement, paiement.date_paiement
      ");

      if ($h) {
          foreach ($h->fetchAll(PDO::FETCH_ASSOC) as $key) {
              $af[] = array(
                  $key["id_paiement"],
                  $key["id_demande"],
                  $key["matricule_agent"],
                  $key["mode_paiement"],
                  $key["date_paiement"],
                 
              );
          }
      }
  } catch (Exception $e) {
      // Gérer les erreurs
      error_log("Erreur SQL : " . $e->getMessage());
      return [];
  }

  return $af;
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