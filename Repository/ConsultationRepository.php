<?php




require_once("../Config/serveur.php");
require("../Entity/ConsultationEntity.php");


class ConsultationRepository{

  public function create_Consultation(ConsultationEntity $i) {
    $db = new Db();

    // Récupérer le plafond pour le type de consultation
    $query = $db->connexion()->prepare("SELECT plafond FROM type_consultation WHERE id_type_consultation = :id_type_consultation");
    $query->execute(['id_type_consultation' => $i->getType_consultation()]);
    $typeConsultation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$typeConsultation) {
        throw new Exception("Type de consultation introuvable.");
    }

    // Déterminer le frais à insérer
    $plafond = $typeConsultation['plafond'];
    $fraisToInsert = $i->getFrais_consultation() > $plafond ? $plafond : $i->getFrais_consultation();

    // Si les frais sont supérieurs au plafond, ajouter un message d'avertissement
    $message = '';
    if ($i->getFrais_consultation() > $plafond) {
        $message = "Attention, la limite de frais est de " . $plafond . " et a été appliquée.";
    }

    // Insertion dans la table consultation
    $query = $db->connexion()->prepare("
        INSERT INTO consultation (id_type_consultation,numero_piece, date_consultation, motif_consultation, frais_consultation, lieu_consultation, remarque, id_demande)
        VALUES (:type_consultation,:numero_piece, :date_consultation, :motif, :frais_consultation, :lieu_consultation, :remarque, :id_demande)
    ");

    $query->execute([
        'type_consultation' => $i->getType_consultation(),
        'numero_piece'=>$i->getNumero_piece(),
        'date_consultation' => $i->getDate_consultation(),
        'motif' => $i->getMotif(),
        'frais_consultation' => $fraisToInsert,
        'lieu_consultation' => $i->getLieu_consultation(),
        'remarque' => $i->getRemarque(),
        'id_demande' => $i->getIddemande(),
    ]);

    return $message;  // Retourne le message d'avertissement si nécessaire
}



public function search_Consultation(ConsultationEntity $i){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM consultation WHERE id_demande like '%".$i->getIddemande()."%' ");
 
    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
$af[]= array($key["id_consultation"],$key["id_type_consultation"],$key["id_demande"],$key["numero_piece"],$key["date_consultation"],$key["motif_consultation"],$key["frais_consultation"],$key["lieu_consultation"],$key["remarque"]);
  }
return $af;

}
public function read_Consultation(){
  $db= new Db();
    $h=$db->connexion()->query("SELECT * FROM consultation  ");

    $af = array();
    foreach($h->fetchAll(PDO::FETCH_ASSOC) as $key){
      $af[]= array($key["id_consultation"],$key["id_type_consultation"],$key["id_demande"],$key["numero_piece"],$key["date_consultation"],$key["motif_consultation"],$key["frais_consultation"],$key["lieu_consultation"],$key["remarque"]);

    }
return $af;

}
public function delete_Consultation(ConsultationEntity $i){
  $db= new Db();
    
  $db->connexion()->exec(" DELETE FROM consultation WHERE id_consultation = '".$i->getIdconsultation()."' AND id_type_consultation = '".$i->getType_consultation()."' AND id_demande = '".$i->getIddemande()."'  ");
  

}
public function update_Consultation(ConsultationEntity $i) {
  $db = new Db();
  $connexion = $db->connexion();

  // Récupérer le plafond pour le type de consultation
  $query = $connexion->prepare("
      SELECT plafond 
      FROM type_consultation 
      WHERE id_type_consultation = :id_type_consultation
  ");
  $query->execute(['id_type_consultation' => $i->getType_consultation()]);
  $typeConsultation = $query->fetch(PDO::FETCH_ASSOC);

  if (!$typeConsultation) {
      throw new Exception("Type de consultation introuvable.");
  }

  // Déterminer le frais à insérer
  $plafond = $typeConsultation['plafond'];
  $fraisToInsert = $i->getFrais_consultation() > $plafond ? $plafond : $i->getFrais_consultation();

  // Si les frais sont supérieurs au plafond, ajouter un message d'avertissement
  $message = '';
  if ($i->getFrais_consultation() > $plafond) {
      $message = "Attention, la limite de frais est de " . $plafond . " et a été appliquée.";
  }

  // Mise à jour de la consultation
  $updateQuery = $connexion->prepare("
      UPDATE consultation 
      SET 
          numero_piece = :numero_piece,
          date_consultation = :date_consultation,
          motif_consultation = :motif_consultation,
          frais_consultation = :frais_consultation,
          lieu_consultation = :lieu_consultation,
          remarque = :remarque
      WHERE 
          id_consultation = :id_consultation AND 
          id_type_consultation = :id_type_consultation AND 
          id_demande = :id_demande
  ");
  $updateQuery->execute([
      'numero_piece' => $i->getNumero_piece(),
      'date_consultation' => $i->getDate_consultation(),
      'motif_consultation' => $i->getMotif(),
      'frais_consultation' => $fraisToInsert,
      'lieu_consultation' => $i->getLieu_consultation(),
      'remarque' => $i->getRemarque(),
      'id_consultation' => $i->getIdconsultation(),
      'id_type_consultation' => $i->getType_consultation(),
      'id_demande' => $i->getIddemande(),
  ]);

  return $message;
}


}



?>
