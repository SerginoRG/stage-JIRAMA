<?php




require_once("../Config/serveur.php");
require("../Entity/HospitalisationEntity.php");


class HospitalisationRepository{

  public function create_hospitalisation(HospitalisationEntity $i) {
    $db = new Db();

    // Récupérer le plafond pour le type de hospitalisation
    $query = $db->connexion()->prepare("SELECT plafond FROM type_hospitalisation WHERE id_type_hospitalisation = :id_type_hospitalisation");
    $query->execute(['id_type_hospitalisation' => $i->getId_type_hospitalisation()]);
    $hospitalisation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$hospitalisation) {
        throw new Exception("Type de hospitalisation introuvable.");
    }

    // Déterminer le frais à insérer
    $plafond = $hospitalisation['plafond'];
    $fraisToInsert = $i->getFrais_hospitalisation() > $plafond ? $plafond : $i->getFrais_hospitalisation();

    // Si les frais sont supérieurs au plafond, ajouter un message d'avertissement
    $message = '';
    if ($i->getFrais_hospitalisation() > $plafond) {
        $message = "Attention, la limite de frais est de " . $plafond . " Ar et a été appliquée.";
    }

    // Insertion dans la table consultation
    $query = $db->connexion()->prepare("
        INSERT INTO hospitalisation ( id_demande, id_type_hospitalisation, numero_piece, date_entree, date_sortie, frais_hospitalisation, remarque, lieu_hospitalisation) 
        VALUES (:id_demande, :id_type_hospitalisation, :numero_piece, :date_entree, :date_sortie, :frais_hospitalisation, :remarque, :lieu_hospitalisation)
    ");

    $query->execute([
        'id_demande' => $i->getIddemande(),
        'id_type_hospitalisation' => $i->getId_type_hospitalisation(),
        'numero_piece' => $i->getNumero_piece(),
        'date_entree' => $i->getDate_admission(),
        'date_sortie' => $i->getDate_sortie(),
        'frais_hospitalisation' => $fraisToInsert,
        'remarque' => $i->getRemarque(),
        'lieu_hospitalisation' => $i->getLieu_hospitalisation(),
    ]);

    return $message;  // Retourne le message d'avertissement si nécessaire
}



public function search_Hospitalisation(HospitalisationEntity $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM hospitalisation WHERE id_demande like '%".$i->getIddemande()."%' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_hospitalisation"],$key["id_demande"],$key["id_type_hospitalisation"],$key["numero_piece"],$key["date_entree"],$key["date_sortie"],$key["frais_hospitalisation"],$key["remarque"],$key["lieu_hospitalisation"]);
  }
return $af;

}
public function read_Hospitalisation(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM hospitalisation  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
        $af[]= array($key["id_hospitalisation"],$key["id_demande"],$key["id_type_hospitalisation"],$key["numero_piece"],$key["date_entree"],$key["date_sortie"],$key["frais_hospitalisation"],$key["remarque"],$key["lieu_hospitalisation"]);

    }
return $af;

}
public function delete_Hospitalisation(HospitalisationEntity $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM hospitalisation WHERE id_hospitalisation = '".$i->getIdhospitalisation()."' AND id_demande = '".$i->getIddemande()."' AND id_type_hospitalisation = '".$i->getId_type_hospitalisation()."'   ");
  

}
public function update_Hospitalisation(HospitalisationEntity $i) {
  $db = new Db();
  $connexion = $db->connexion();

  // Récupérer le plafond pour le type d'hospitalisation
  $query = $connexion->prepare("SELECT plafond FROM type_hospitalisation WHERE id_type_hospitalisation = :id_type_hospitalisation");
  $query->execute(['id_type_hospitalisation' => $i->getId_type_hospitalisation()]);
  $hospitalisation = $query->fetch(PDO::FETCH_ASSOC);

  if (!$hospitalisation) {
      throw new Exception("Type d'hospitalisation introuvable.");
  }

  // Déterminer le frais à insérer
  $plafond = $hospitalisation['plafond'];
  $fraisToInsert = $i->getFrais_hospitalisation() > $plafond ? $plafond : $i->getFrais_hospitalisation();

  // Si les frais sont supérieurs au plafond, ajouter un message d'avertissement
  $message = '';
  if ($i->getFrais_hospitalisation() > $plafond) {
      $message = "Attention, la limite de frais est de " . $plafond . " Ar et a été appliquée.";
  }

  // Mise à jour de l'hospitalisation
  $updateQuery = $connexion->prepare("
      UPDATE hospitalisation 
      SET 
          numero_piece = :numero_piece,
          date_entree = :date_entree,
          date_sortie = :date_sortie,
          frais_hospitalisation = :frais_hospitalisation,
          remarque = :remarque,
          lieu_hospitalisation = :lieu_hospitalisation
      WHERE 
          id_hospitalisation = :id_hospitalisation AND 
          id_demande = :id_demande AND 
          id_type_hospitalisation = :id_type_hospitalisation
  ");
  $updateQuery->execute([
      'numero_piece' => $i->getNumero_piece(),
      'date_entree' => $i->getDate_admission(),
      'date_sortie' => $i->getDate_sortie(),
      'frais_hospitalisation' => $fraisToInsert,
      'remarque' => $i->getRemarque(),
      'lieu_hospitalisation' => $i->getLieu_hospitalisation(),
      'id_hospitalisation' => $i->getIdhospitalisation(),
      'id_demande' => $i->getIddemande(),
      'id_type_hospitalisation' => $i->getId_type_hospitalisation(),
  ]);

  return $message;
}


}



?>
