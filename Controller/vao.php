<?php

// Activer l'affichage des erreurs pour le débogage


require("../Config/serveur.php");
require("../fpdf/fpdf.php");


// Récupération des données POST avec validation
$societe_agent = htmlspecialchars($_POST['societe_agent'] ?? '');
$statut = htmlspecialchars($_POST['statut'] ?? '');
$datedebu = $_POST['datedebu'] ?? '';
$datefin = $_POST['datefin'] ?? '';

// Vérification de la validité des dates
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datedebu) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $datefin)) {
    header("Location: ../PagerUser/Etat.php?error=Dates invalides.");
    exit;
}

// Connexion à la base de données
$db = new Db();
$connexion = $db->connexion();
if (!$connexion) {
    header("Location: ../PagerUser/Etat.php?error=Erreur de connexion à la base de données.");
   return true;
    exit;
}

// Requête SQL sécurisée
// Préparation de la requête SQL
$query = $connexion->prepare("
    SELECT 
        p.id_paiement, 
        d.id_demande, 
        a.matricule_agent, 
        a.nom_agent, 
        a.prenom_agent, 
        a.id_societe AS societe_agent, 
        a.statut_agent AS statut, 
        a.compte_bancaire, 
        a.telephone, 
        SUM(m.quantite * m.prix_unitaire + IFNULL(c.frais_consultation, 0) + IFNULL(h.frais_hospitalisation, 0)) AS somme_total_facture
    FROM 
        paiement p
    INNER JOIN 
        demande d ON p.id_demande = d.id_demande
    INNER JOIN 
        agent a ON d.matricule_agent = a.matricule_agent
    LEFT JOIN 
        medical m ON d.id_demande = m.id_demande
    LEFT JOIN 
        consultation c ON d.id_demande = c.id_demande
    LEFT JOIN 
        hospitalisation h ON d.id_demande = h.id_demande
    WHERE 
        a.id_societe LIKE :societe_agent
        AND a.statut_agent LIKE :statut
        AND p.date_paiement BETWEEN :datedebu AND :datefin
    GROUP BY 
        p.id_paiement, 
        d.id_demande, 
        a.matricule_agent, 
        a.nom_agent, 
        a.prenom_agent, 
        a.id_societe, 
        a.statut_agent, 
        a.compte_bancaire, 
        a.telephone
");

// Exécution de la requête
$query->execute([
    ':societe_agent' => "%$societe_agent%",
    ':statut' => "%$statut%",
    ':datedebu' => $datedebu,
    ':datefin' => $datefin,
]);

// Récupération des résultats
// Récupération des résultats
$factures = $query->fetchAll(PDO::FETCH_ASSOC);


if (empty($factures)) {
    header("Location: ../PagerUser/Etat.php?error=Aucune donnée trouvée pour les critères spécifiés.");
    exit;
}

// Calcul du montant total
$montant_total = 0;
foreach ($factures as $facture) {
    $montant_total += $facture['somme_total_facture'];
}




// Classe PDF
if (!empty($factures)) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>
            <th>Id Paiement</th>
            <th>Id Demande</th>
            <th>Matricule Agent</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Société</th>
            <th>Statut</th>
            <th>Compte Bancaire</th>
            <th>Téléphone</th>
            <th>Somme Total Facture</th>
          </tr>";

    foreach ($factures as $facture) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($facture['id_paiement']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['id_demande']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['matricule_agent']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['nom_agent']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['prenom_agent']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['societe_agent']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['statut']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['compte_bancaire']) . "</td>";
        echo "<td>" . htmlspecialchars($facture['telephone']) . "</td>";
        echo "<td>" . number_format($facture['somme_total_facture'], 2) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Aucune donnée trouvée pour les critères spécifiés.</p>";
}


// Génération du PDF
$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'AGENTS', 0, 1, 'C');
$pdf->Ln();
$pdf->Cell(0, 10, 'Nous vous demandons de bien vouloir proceder au paiement de FRAIS MEDICAUX par Mobile Money de notre Direction suivant le tableau ci-apres :', 0, 1, 'L');
$pdf->Ln();

// Tableau avec les données
// $pdf->HeaderTable();
// $pdf->TableContent($factures);

// Ajout de l'arrêté
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Arrêté à la somme de : ' . nombreEnLettres($montant_total) . ' Ariary'), 0, 1, 'L');

$pdf->Ln();

$pdf->Cell(0, 10, 'Signatures', 0, 1, 'C');
$pdf->Cell(0, 10, 'L\'ADM ' .'            Le Chef Comptable', 0, 1, 'C');

// Fonction pour convertir le montant en lettres (identique à votre code)
function nombreEnLettres($nombre) {
    $unites = [
        0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 
        5 => 'cinq', 6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf', 
        10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 
        14 => 'quatorze', 15 => 'quinze', 16 => 'seize', 
        17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf', 
        20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante', 
        60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingts', 
        90 => 'quatre-vingt-dix'
    ];

    if ($nombre < 100) {
        if ($nombre < 20) {
            return $unites[$nombre];
        } else {
            $dixaines = floor($nombre / 10) * 10;
            $unités = $nombre % 10;
            return $unités === 0 ? $unites[$dixaines] : $unites[$dixaines] . '-' . $unites[$unités];
        }
    } elseif ($nombre < 1000) {
        $centaines = floor($nombre / 100);
        $reste = $nombre % 100;
        if ($centaines === 1) {
            return 'cent' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
        } else {
            return $unites[$centaines] . ' cents' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
        }
    } elseif ($nombre < 1000000) { // Gestion des milliers
        $milliers = floor($nombre / 1000);
        $reste = $nombre % 1000;
        return nombreEnLettres($milliers) . ' mille' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
    }
}

$pdf->Output('D', 'frais_medicals.pdf');

?>

















<!-- 
require("../Config/serveur.php");
require("../fpdf/fpdf.php");

// Récupération des données POST avec validation
$societe_agent = htmlspecialchars($_POST['societe_agent'] ?? '');
$statut = htmlspecialchars($_POST['statut'] ?? '');
$datedebu = $_POST['datedebu'] ?? '';
$datefin = $_POST['datefin'] ?? '';

// Validation des dates
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $datedebu) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $datefin)) {
    header("Location: ../PagerUser/Etat.php?error=Dates invalides.");
    exit;
}

// Connexion à la base de données
$db = new Db();
$connexion = $db->connexion();
if (!$connexion) {
    header("Location: ../PagerUser/Etat.php?error=Erreur de connexion à la base de données.");
    exit;
}

// Requête SQL sécurisée
$query = $connexion->prepare("
    SELECT 
        p.id_paiement, 
        d.id_demande, 
        a.matricule_agent, 
        a.nom_agent, 
        a.prenom_agent, 
        a.id_societe AS societe_agent, 
        a.statut_agent AS statut, 
        a.compte_bancaire, 
        a.telephone, 
        SUM(m.quantite * m.prix_unitaire + IFNULL(c.frais_consultation, 0) + IFNULL(h.frais_hospitalisation, 0)) AS somme_total_facture
    FROM 
        paiement p
    INNER JOIN 
        demande d ON p.id_demande = d.id_demande
    INNER JOIN 
        agent a ON d.matricule_agent = a.matricule_agent
    LEFT JOIN 
        medical m ON d.id_demande = m.id_demande
    LEFT JOIN 
        consultation c ON d.id_demande = c.id_demande
    LEFT JOIN 
        hospitalisation h ON d.id_demande = h.id_demande
    WHERE 
        a.id_societe LIKE :societe_agent
        AND a.statut_agent LIKE :statut
        AND p.date_paiement BETWEEN :datedebu AND :datefin
    GROUP BY 
        p.id_paiement, 
        d.id_demande, 
        a.matricule_agent, 
        a.nom_agent, 
        a.prenom_agent, 
        a.id_societe, 
        a.statut_agent, 
        a.compte_bancaire, 
        a.telephone
");
$query->execute([
    ':societe_agent' => "%$societe_agent%",
    ':statut' => "%$statut%",
    ':datedebu' => $datedebu,
    ':datefin' => $datefin,
]);

$factures = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($factures)) {
    header("Location: ../PagerUser/Etat.php?error=Aucune donnée trouvée pour les critères spécifiés.");
    exit;
}

// Génération du PDF
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Titre
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'État des Paiements'), 0, 1, 'C');
$pdf->Ln();

// Informations sur le bénéficiaire
$pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Bénéficiaire : ' . $factures[0]['nom_agent'] . ' ' . $factures[0]['prenom_agent']), 0, 1, 'L');
$pdf->Ln();

// Tableau des factures
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Id Paiement', 1, 0, 'C');
$pdf->Cell(30, 10, 'Id Demande', 1, 0, 'C');
$pdf->Cell(30, 10, 'Matricule', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nom', 1, 0, 'C');
$pdf->Cell(50, 10, 'Prénom', 1, 0, 'C');
$pdf->Cell(30, 10, 'Téléphone', 1, 0, 'C');
$pdf->Cell(50, 10, 'Somme Total', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

foreach ($factures as $facture) {
    $pdf->Cell(30, 10, $facture['id_paiement'], 1, 0, 'C');
    $pdf->Cell(30, 10, $facture['id_demande'], 1, 0, 'C');
    $pdf->Cell(30, 10, $facture['matricule_agent'], 1, 0, 'C');
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $facture['nom_agent']), 1, 0, 'C');
    $pdf->Cell(50, 10, iconv('UTF-8', 'ISO-8859-1', $facture['prenom_agent']), 1, 0, 'C');
    $pdf->Cell(30, 10, $facture['telephone'], 1, 0, 'C');
    $pdf->Cell(50, 10, number_format($facture['somme_total_facture'], 2), 1, 1, 'C');
}

// Arrêté total
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Arrêté à la somme de : ' . number_format(array_sum(array_column($factures, 'somme_total_facture')), 2) . ' Ariary'), 0, 1, 'L');

// Signatures
$pdf->Ln();
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Signatures'), 0, 1, 'C');
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'L\'ADM            Le Chef Comptable'), 0, 1, 'C');

// Générer le fichier PDF
$pdf->Output('D', 'frais_medicals.pdf'); -->

