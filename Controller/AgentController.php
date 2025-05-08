<?php
require("../Repository/AgentRepository.php");

try {
 
    $Nom = $_POST['nom_agent'];
    $Prenom = $_POST['prenom_agent'];
    $Societe = $_POST['id_societe'];
    $Adresse = $_POST['adresse_agent'];
    $Sexe = $_POST['sexe_agent'];
    $compte = $_POST['compte_bancaire'];
   
    $statut =$_POST['statut'];
    $telephone = $_POST['telephone'];

   

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if ( empty($Nom) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new Agent();
   
    $i->setNomAgent($Nom);
    $i->setPrenomAgent($Prenom);
    $i->setIdSociete($Societe);
    $i->setAdresseAgent($Adresse);
    $i->setSexeAgent($Sexe);
    $i->setNumero_compte_Agent($compte);
    
    $i->setStatut($statut);
    $i->setTelephone($telephone);
   

    // Insertion dans la base de données
    $rep = new AgentRepository();
    $rep->create_Agent($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/Agent.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/Agent.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
