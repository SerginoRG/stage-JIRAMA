<?php





require_once("../Config/serveur.php");
require("../Entity/FactureEntity.php");


class FactureRepository{

public function create_Facture(Facture $i){
 
  $db= new Db();
  


$db->connexion()->exec("INSERT INTO medical  VALUES( null,'".$i->getId_remboursement()."' ,'".$i->getId_analytique()."','".$i->getId_medicament()."', '".$i->getNumero_facture()."', '".$i->getDate_facture()."' , '".$i->getRemarque()."' ,'".$i->getQuantite()."', '".$i->getCategorie()."' , '".$i->getPrix_unitaire()."' ) ");
 
  
}



    
    // Méthode pour récupérer un médicament par son ID
    public function getMedicamentById($id_medicament) {
        $db = new Db();
        $query = $db->connexion()->prepare("
            SELECT id_medicament, nom_medicament, type_rembourse 
            FROM medicament 
            WHERE id_medicament = :id
        ");
        $query->execute(['id' => $id_medicament]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

     



public function delete_Facture(Facture $i){                                                                                                                                         
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM medical WHERE id_medicale = '".$i->getId_facture()."' AND id_demande = '".$i->getId_remboursement()."' AND id_analytique = '".$i->getId_analytique()."' AND id_medicament = '".$i->getId_medicament()."'  ");
  

}
public function update_Facture(Facture $i){
  $db= new Db();
    
  $db->connexion()->exec(" UPDATE medical SET numero_piece = '".$i->getNumero_facture()."', date_piece = '".$i->getDate_facture()."',remarque = '".$i->getRemarque()."' ,quantite = '".$i->getQuantite()."',categorie = '".$i->getCategorie()."',prix_unitaire = '".$i->getPrix_unitaire()."'    WHERE id_medicale = '".$i->getId_facture()."' AND id_demande = '".$i->getId_remboursement()."' AND id_analytique = '".$i->getId_analytique()."' AND id_medicament = '".$i->getId_medicament()."'  ");
  
} 

}



?>
