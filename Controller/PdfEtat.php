<?php

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers requis
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
$query = $connexion->prepare("
    SELECT 
        p.id_paiement, 
        d.id_demande, 
        a.matricule_agent, 
        a.nom_agent, 
        a.prenom_agent, 
        a.id_societe AS societe_agent, 
        a.statut_agent AS statut, 
        d.date_demande,
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
        d.date_demande, 
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
$factures = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($factures)) {
    header("Location: ../PagerUser/Etat.php?error=Aucune donnée trouvée pour les critères spécifiés.");
    exit;
}

// Calcul du montant total
// $montant_total = 0;
// foreach ($factures as $facture) {
//     $montant_total += $facture['somme_total_facture'];
// }

// Classe PDF
class PDF extends FPDF {

    // En-tête de tableau
    function HeaderTable() {
        $this->SetFont('Arial', 'B', 7);
        $headers = [
            'id_paiement', 'id_demande', 'matricule_agent', 'nom_agent',
            'prenom_agent', 'societe_agent', 'statut','date_demande', 'compte_bancaire',
            'telephone', 'somme_total_facture'
        ];
        foreach ($headers as $header) {
            $this->Cell(26, 10, $header, 1);
        }
        $this->Ln();
    }

    // Contenu du tableau
    function TableContent($factures) {
        $this->SetFont('Arial', '', 7);
        $total = 0;
        foreach ($factures as $row) {
            $this->Cell(26, 10, $row['id_paiement'], 1);
            $this->Cell(26, 10, $row['id_demande'], 1);
            $this->Cell(26, 10, $row['matricule_agent'], 1);
            $this->Cell(26, 10, $row['nom_agent'], 1);
            $this->Cell(26, 10, $row['prenom_agent'], 1);
            $this->Cell(26, 10, $row['societe_agent'], 1);
            $this->Cell(26, 10, $row['statut'], 1);
            $this->Cell(26, 10, $row['date_demande'], 1);
            $this->Cell(26, 10, $row['compte_bancaire'], 1);
            $this->Cell(26, 10, $row['telephone'], 1);
            $this->Cell(26, 10, number_format($row['somme_total_facture'], 2), 1);
            $this->Ln(); // Passer à la ligne suivante après chaque ligne
            $total += $row['somme_total_facture'];
        }
    
        // Ligne de total
        $this->SetFont('Arial', 'B', 7);
        $this->Cell(260, 10, 'Total:', 1, 0, 'R'); // Cellule fusionnée pour le texte "Total"
        $this->Cell(26, 10, number_format($total, 2), 1, 1, 'L'); // Cellule pour le montant total
        
        return $total;
    }
    
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
$pdf->HeaderTable();


$total = $pdf->TableContent($factures);
// Ajout de l'arrêté
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Arrêté à la somme de : ' . nombreEnLettres($total) . ' Ariary'), 0, 1, 'L');

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
    } elseif ($nombre < 1000000000) { // Gestion des millions
        $millions = floor($nombre / 1000000);
        $reste = $nombre % 1000000;
        return nombreEnLettres($millions) . ' million' . ($millions > 1 ? 's' : '') . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
    } elseif ($nombre < 1000000000000) { // Gestion des milliards
        $milliards = floor($nombre / 1000000000);
        $reste = $nombre % 1000000000;
        return nombreEnLettres($milliards) . ' milliard' . ($milliards > 1 ? 's' : '') . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
    } else {
        return 'nombre trop grand'; // À gérer si nécessaire
    }
}

$pdf->Output('D', 'frais_medicals.pdf');

?>