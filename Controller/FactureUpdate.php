<?php
require("../Repository/FactureRepository.php");

try {
    $id_facture = $_POST['id_facture'];
    $id_remboursement = $_POST['id_remboursement'];
    $id_analytique = $_POST['id_analytique'];

    
    $numero_facture = $_POST['numero_facture'];
    $date_facture = $_POST['date_facture'];

    $remarque = $_POST['remarque'];

    
   
    $id_medicament = $_POST['id_medicament'];
    $quantite = $_POST['quantite'];
    $categorie = $_POST['categorie'];
    $prix_unitaire = $_POST['prix_unitaire'];

    // Validation des champs (tu peux ajouter plus de validations si nécessaire)
    if (empty($id_facture) ) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    // Création de l'employé
    $i = new Facture();
    $i->setId_facture($id_facture);


    $i->setId_remboursement($id_remboursement);

    $i->setId_medicament($id_medicament);



    $i->setId_analytique($id_analytique);
    
    $i->setNumero_facture($numero_facture);
    
    $i->setDate_facture($date_facture);
    $i->setRemarque($remarque);
    $i->setQuantite($quantite);
    $i->setCategorie($categorie);
    $i->setPrix_unitaire($prix_unitaire);    
    
    
   

    // Insertion dans la base de données
    $rep = new FactureRepository();
    $rep->update_Facture($i);

    // Redirection en cas de succès
    header('Location: ../PagerUser/FactureTableau.php?success=1');
    exit();
} catch (Exception $e) {
    // Redirection avec un message d'erreur en cas d'exception
    header('Location: ../PagerUser/FactureTableau.php?error=' . urlencode($e->getMessage()));
    exit();
}
?>
