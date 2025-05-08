<?php
require("../Repository/FactureRepository.php");
require("../Repository/MedicamentRepo.php");

try {
    // Récupération des données du formulaire
    $id_remboursement = htmlspecialchars($_POST['id_remboursement']);
    $id_analytique = htmlspecialchars($_POST['id_analytique']);
    $numero_facture = htmlspecialchars($_POST['numero_facture']);
    $date_facture = htmlspecialchars($_POST['date_facture']);
    $remarque = htmlspecialchars($_POST['remarque']);
    $id_medicament = $_POST['id_medicament'];
    $quantite = $_POST['quantite'];
    $categorie = $_POST['categorie'];
    $prix_unitaire = $_POST['prix_unitaire'];

    // Validation des champs obligatoires
    if (empty($id_remboursement) || empty($id_analytique) || empty($numero_facture) || empty($date_facture)) {
        throw new Exception("Certains champs obligatoires sont manquants.");
    }

    if (count($id_medicament) !== count($quantite) || count($quantite) !== count($prix_unitaire)) {
        throw new Exception("Les données des médicaments ne sont pas cohérentes.");
    }

    $repo = new FactureRepository();
    $medRepo = new FactureRepository();

    $non_remboursables = []; // Liste des médicaments non remboursables

    for ($i = 0; $i < count($id_medicament); $i++) {
        // Vérifiez si le médicament est remboursable
        $medicament = $medRepo->getMedicamentById($id_medicament[$i]);
        if ($medicament['type_rembourse'] === "NON") {
            $non_remboursables[] = $medicament['nom_medicament'];
            continue; // Passer au prochain médicament
        }

        // Créer un objet Facture et remplir ses données
        $facture = new Facture();
        $facture->setId_remboursement($id_remboursement);
        $facture->setId_analytique($id_analytique);
        $facture->setNumero_facture($numero_facture);
        $facture->setDate_facture($date_facture);
        $facture->setRemarque($remarque);
        $facture->setId_medicament($id_medicament[$i]);
        $facture->setQuantite($quantite[$i]);
        $facture->setCategorie($categorie[$i]);
        $facture->setPrix_unitaire($prix_unitaire[$i]);

        // Insertion dans la base de données
        $repo->create_Facture($facture);
    }

    // Vérification et affichage des erreurs pour les médicaments non remboursables
    if (!empty($non_remboursables)) {
        $error_message = "Les médicaments suivants ne sont pas remboursables : " . implode(", ", $non_remboursables);
        throw new Exception($error_message);
    }

    header('Location: ../PagerUser/Facture.php?success=1');
    exit();
} catch (Exception $e) {
    error_log($e->getMessage(), 3, "../logs/error.log");
    header('Location: ../PagerUser/Facture.php?error=' . urlencode($e->getMessage()));
    exit();
}

?>
