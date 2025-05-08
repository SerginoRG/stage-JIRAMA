<?php 

function facture() {
    // Inclusion de la bibliothèque FPDF
    require("../Config/serveur.php");
    require("../fpdf/fpdf.php");

    // Récupération des données POST
    $id_paiement = $_POST['id_paiement'] ?? null;
    $id_remboursement = $_POST['id_remboursement'] ?? null;

    if (!$id_paiement || !$id_remboursement) {
        die("Erreur : ID paiement ou remboursement non défini.");
    }

    // Connexion à la base de données
    $db = new Db();

    // Requête principale pour récupérer les factures
    $query = $db->connexion()->prepare("
        SELECT p.id_paiement, p.id_demande, p.mode_paiement, p.date_paiement,
               c.nom_cms, d.matricule_agent, a.id_societe, a.compte_bancaire, 
               a.nom_agent, a.prenom_agent, a.statut_agent, a.sexe_agent,
               q.nom_analytique, m.date_piece, m.remarque, m.numero_piece,
               SUM(m.quantite * m.prix_unitaire) AS total_facture
        FROM paiement p
        INNER JOIN demande d ON p.id_demande = d.id_demande
        INNER JOIN medical m ON d.id_demande = m.id_demande
        INNER JOIN cms c ON d.id_cms = c.id_cms
        INNER JOIN agent a ON d.matricule_agent = a.matricule_agent
        INNER JOIN analytique q ON m.id_analytique = q.id_analytique
        WHERE p.id_paiement = :id_paiement AND p.id_demande = :id_demande
        GROUP BY p.id_paiement, p.id_demande, p.mode_paiement, p.date_paiement,
                 c.nom_cms, d.matricule_agent, a.id_societe, a.compte_bancaire,
                 a.nom_agent, a.prenom_agent, a.statut_agent, a.sexe_agent,
                 q.nom_analytique, m.date_piece, m.remarque, m.numero_piece
    ");

    // Requête pour les consultations
    $queryConsultation = $db->connexion()->prepare("
        SELECT o.date_consultation, o.numero_piece, o.remarque,
               SUM(o.frais_consultation) AS total_consultation
        FROM paiement p
        INNER JOIN demande d ON p.id_demande = d.id_demande
        INNER JOIN cms c ON d.id_cms = c.id_cms
        INNER JOIN consultation o ON o.id_demande = d.id_demande
        WHERE p.id_paiement = :id_paiement AND p.id_demande = :id_demande
        GROUP BY o.date_consultation, o.numero_piece, o.remarque
    ");

     // Requête pour les consultations
   // Requête pour les hospitalisations
$queryHospitalisation = $db->connexion()->prepare("
SELECT 
    h.date_entree, 
    h.numero_piece, 
    h.remarque, 
    SUM(h.frais_hospitalisation) AS total_hospitalisation 
FROM 
    paiement p
INNER JOIN 
    demande d ON p.id_demande = d.id_demande  -- Correction ici
INNER JOIN 
    cms c ON d.id_cms = c.id_cms
INNER JOIN 
    hospitalisation h ON h.id_demande = d.id_demande  -- Correction ici
WHERE p.id_paiement = :id_paiement AND p.id_demande = :id_demande
GROUP BY h.date_entree, 
         h.numero_piece, 
         h.remarque
");

    // Exécution des requêtes
    $query->execute([
        ':id_paiement' => $id_paiement,
        ':id_demande' => $id_remboursement
    ]);

    $queryConsultation->execute([
        ':id_paiement' => $id_paiement,
        ':id_demande' => $id_remboursement
    ]);
    $queryHospitalisation->execute([
        ':id_paiement' => $id_paiement,
        ':id_demande' => $id_remboursement
    ]);

    // Récupération des données
    $factures = $query->fetchAll(PDO::FETCH_ASSOC);
    $consultations = $queryConsultation->fetchAll(PDO::FETCH_ASSOC);
    $hospitalisation = $queryHospitalisation->fetchAll(PDO::FETCH_ASSOC);

    // Création du PDF
    $pdf = new FPDF('P', 'cm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Courier', 'B', 10);

    // Logo
    $pdf->Image('../image/sary.png', 1, 0.5, 1.5);

    
    // En-têtes du PDF
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'PIECE POUR REGLEMENT    Lot : '. $factures[0]['id_paiement'].'  '.'Doc: '. $factures[0]['id_demande']), 0, 1, 'C');
    
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Matricule : '. $factures[0]['matricule_agent'].'  Classification de l\'agent : '.$factures[0]['statut_agent'],), 0, 1, 'L');
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Bénéficiaire : '. $factures[0]['nom_agent'].' ' . $factures[0]['prenom_agent']), 0, 1, 'L');
 
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Numero de la Societe : '. $factures[0]['id_societe']), 0, 1, 'L');
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Nom du Centre Medicaux Social : '. $factures[0]['nom_cms']), 0, 1, 'L');
    
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Sexe : '. $factures[0]['sexe_agent']), 0, 1, 'L');
    
    



    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Date de paiement : ' . $factures[0]['date_paiement'].'   '.'Mode de réglement : ' . $factures[0]['mode_paiement']), 0, 1, 'L');
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Frais médicaux  Clé GL : S30 '), 0, 1, 'L');

    
// Vérification et affichage des factures si elles existent
if (!empty($factures)) {
    // En-tête du tableau pour les factures
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Factures :'), 0, 1, 'L');
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Remarque'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Analytique'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'N° Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Date Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant'), 1, 1, 'C');

    $montant_total = 0;
    foreach ($factures as $facture) {
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['remarque']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['nom_analytique']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['numero_piece']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['date_piece']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($facture['total_facture'], 2)), 1, 1, 'C');
        $montant_total += $facture['total_facture'];
    }

    // Ligne pour le total
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(11.4, 1.5, '', 0, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant Total'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($montant_total, 2)), 1, 1, 'C');
}
else {
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(0, 1, "Aucune facture trouvee.", 0, 1, 'L');
}

// Vérification et affichage des consultations si elles existent
if (!empty($consultations)) {

    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Consultations :'), 0, 1, 'L');
        
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Frais de consultation'), 0, 1, 'L');

    // En-tête du tableau des consultations
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Remarque'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Analytique'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'N° Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Date Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant'), 1, 1, 'C');

    $totalConsultation = 0;
    foreach ($consultations as $consultation) {
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $consultation['remarque']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Consultation'), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $consultation['numero_piece']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $consultation['date_consultation']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($consultation['total_consultation'], 2)), 1, 1, 'C');
        $totalConsultation += $consultation['total_consultation'];
    }

    // Ligne pour le total des consultations
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(11.4, 1.5, '', 0, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant Total'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($totalConsultation, 2)), 1, 1, 'C');
}

else {
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(0, 1, "Aucune consultation trouvee.", 0, 1, 'L');
}



if (!empty($hospitalisation)) {

    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'hospitalisation :'), 0, 1, 'L');
        
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Frais de hospitalisation'), 0, 1, 'L');

    // En-tête du tableau des consultations
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Remarque'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Analytique'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'N° Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Date Pièce'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant'), 1, 1, 'C');

    $totalHospitalisation = 0;
    foreach ($hospitalisation as $hospitalisation) {
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $hospitalisation['remarque']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Hospitalisation'), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $hospitalisation['numero_piece']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', $hospitalisation['date_entree']), 1, 0, 'C');
        $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($hospitalisation['total_hospitalisation'], 2)), 1, 1, 'C');
        $totalHospitalisation += $hospitalisation['total_hospitalisation'];
    }

    // Ligne pour le total des consultations
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(11.4, 1.5, '', 0, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant Total'), 1, 0, 'C');
    $pdf->Cell(3.8, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($totalHospitalisation, 2)), 1, 1, 'C');
}

else {
    $pdf->SetFont('Courier', 'B', 9);
    $pdf->Cell(0, 1, "Aucune hospitalisation trouvee.", 0, 1, 'L');
}










// Initialiser les variables à 0
$montant_total = 0; // Montant total des factures
$totalConsultation = 0; // Montant total des consultations
$totalHospitalisation = 0; // Montant total des hospitalisations

// Vérification et calcul du montant total des factures
if (!empty($factures)) {
    foreach ($factures as $facture) {
        if (isset($facture['total_facture'])) {
            $montant_total += $facture['total_facture'];
        }
    }
}

// Vérification et calcul du montant total des consultations
if (!empty($consultations)) {
    foreach ($consultations as $consultation) {
        if (isset($consultation['total_consultation'])) {
            $totalConsultation += $consultation['total_consultation'];
        }
    }
}

// Vérification et calcul du montant total des hospitalisations
if (!empty($hospitalisation)) {
    foreach ($hospitalisation as $totalHospitalisation) {
        if (isset($totalHospitalisation['total_hospitalisation'])) {
            $totalHospitalisation += $totalHospitalisation['total_hospitalisation'];
        }
    }
}

// Calcul du total à payer
$total_a_payer = $montant_total + $totalConsultation + $totalHospitalisation;

// Affichage des montants pour débogage
// echo "Montant total des factures : " . number_format($montant_total, 2) . " Ariary\n";
// echo "Montant total des consultations : " . number_format($totalConsultation, 2) . " Ariary\n";
// echo "Montant total des hospitalisations : " . number_format($totalHospitalisation, 2) . " Ariary\n";
// echo "Total à payer : " . number_format($total_a_payer, 2) . " Ariary";



// Ajouter une section pour le total général dans le PDF
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'Total à payer : ' . number_format($total_a_payer, 2) . ' Ariary'), 0, 1, 'L');

// Afficher l'arrêté de la somme en lettres
$pdf->SetFont('Courier', 'B', 10);
$pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Arrêté à la somme de : ' . nombreEnLettres($total_a_payer) . ' Ariary'), 0, 1, 'L');




    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'N° bancaire :'. $factures[0]['compte_bancaire']), 0, 1, 'L');
    // $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', 'CIN :'. $factures[0]['cin_agent']), 0, 1, 'L');
    $pdf->Cell(0, 1, iconv('UTF-8', 'ISO-8859-1', ' signatures'), 0, 1, 'L');
    // Tableau pour signatures
    $pdf->Cell(4.7, 1.5, iconv('UTF-8', 'ISO-8859-1', 'L\'agent'), 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Medecin'), 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Le Chef Comptable'), 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Bon à payer'), 1, 1, 'C');

    // Lignes vides pour les signatures
    $pdf->Cell(4.7, 1.5, '', 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, '', 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, '', 1, 0, 'C');
    $pdf->Cell(4.7, 1.5, '', 1, 1, 'C');


    
    
    
    // Générer et afficher le fichier PDF dans le navigateur avec le nom de l'agent
        $pdf->Output('I', $factures[0]['nom_agent'] . '.pdf');

}

// Fonction pour convertir le montant en toutes lettres
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


// Appel de la fonction
facture();
?>























<!-- 

// Fonction pour convertir le montant en toutes lettres
// function nombreEnLettres($nombre) {
//     $unites = [
//         0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 
//         5 => 'cinq', 6 => 'six', 7 => 'sept', 8 => 'huit', 9 => 'neuf', 
//         10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 
//         14 => 'quatorze', 15 => 'quinze', 16 => 'seize', 
//         17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf', 
//         20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante', 
//         60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingts', 
//         90 => 'quatre-vingt-dix'
//     ];

//     if ($nombre < 100) {
//         if ($nombre < 20) {
//             return $unites[$nombre];
//         } else {
//             $dixaines = floor($nombre / 10) * 10;
//             $unités = $nombre % 10;
//             return $unités === 0 ? $unites[$dixaines] : $unites[$dixaines] . '-' . $unites[$unités];
//         }
//     } elseif ($nombre < 1000) {
//         $centaines = floor($nombre / 100);
//         $reste = $nombre % 100;
//         if ($centaines === 1) {
//             return 'cent' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
//         } else {
//             return $unites[$centaines] . ' cents' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
//         }
//     } elseif ($nombre < 1000000) { // Gestion des milliers
//         $milliers = floor($nombre / 1000);
//         $reste = $nombre % 1000;
//         return nombreEnLettres($milliers) . ' mille' . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
//     } elseif ($nombre < 1000000000) { // Gestion des millions
//         $millions = floor($nombre / 1000000);
//         $reste = $nombre % 1000000;
//         return nombreEnLettres($millions) . ' million' . ($millions > 1 ? 's' : '') . ($reste > 0 ? ' ' . nombreEnLettres($reste) : '');
//     } else {
//         return 'nombre trop grand'; // À étendre pour gérer les milliards et plus
//     }
// }



function facture() {
    // Inclusion de la bibliothèque FPDF
    require("../Config/Db.php");
    require("../fpdf/fpdf.php");

    $id_paiement = $_POST['id_paiement'];
    $id_remboursement  = $_POST['id_remboursement'];

    $db = new Db();
    // Exécuter la requête pour obtenir les données de facture
    $h = $db->connexion()->query("SELECT agent.nom_agent,date_paiement, facture.description, facture.numero_facture, 
                                  date_facture, facture.montant_facture 
                                  FROM paiement 
                                  JOIN facture ON paiement.id_remboursement = facture.id_remboursement 
                                  JOIN agent ON agent.matricule_agent = facture.matricule_agent 
                                  WHERE paiement.id_paiement = '" . $id_paiement . "' 
                                  AND paiement.id_remboursement = '" . $id_remboursement . "' 
                                  GROUP BY agent.nom_agent,date_paiement, date_facture, facture.description, 
                                           facture.numero_facture, facture.montant_facture");

    // Récupérer toutes les factures
    $factures = $h->fetchAll(PDO::FETCH_ASSOC);

    // Création d'un nouvel objet PDF en orientation paysage ('L'), unité en centimètres ('cm'), et format A4
    $pdf = new FPDF('P', 'cm', 'A4');
    $pdf->AddPage();

    // Définir la police, style 'B' pour gras, et taille 12
    $pdf->SetFont('Courier', 'B', 12);

    // En-têtes du PDF

    // $pdf->Image('../image/sary.png', 10, 6, 30);

    $pdf->Image('../image/sary.png', 1, 0.5, 2.5);  // 1 cm from the left and top, 5 cm width


    $pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'PIECE POUR REGLEMENT'), 0, 1, 'C');
    $pdf->Cell(0, 2, iconv('UTF-8', 'ISO-8859-1', 'Bénéficiaire : ' . $factures[0]['nom_agent']), 0, 1, 'L');
    $pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Date de paiement : '. $factures[1]['date_paiement']), 0, 1, 'L');
    $pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Frais médicaux '), 0, 1, 'L');

    // En-tête du tableau
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Description'), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'N°pièce'), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Date pièce'), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant'), 1, 1, 'C'); // 1 à la fin pour créer une nouvelle ligne

    // Afficher les données des factures
    $pdf->SetFont('Courier', '', 12); // Police normale pour les données
    $montant_total = 0; // Initialiser le montant total
    foreach ($factures as $facture) {
        $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['description']), 1, 0, 'C');
        $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['numero_facture']), 1, 0, 'C');
        $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', $facture['date_facture']), 1, 0, 'C');
        $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($facture['montant_facture'], 2)), 1, 1, 'C');
        $montant_total += $facture['montant_facture']; // Ajouter au montant total
    }

    // Ligne pour le total
    $pdf->SetFont('Courier', 'B', 12); // Police en gras pour le total
    $pdf->Cell(11, 1.5, '', 0, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Montant Total'), 1, 0, 'C'); // Cellule large pour le total
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', number_format($montant_total, 2)), 1, 1, 'C'); // Montant total

    $pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Arrete à la somme de : '), 0, 1, 'L');


    $pdf->Cell(0, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Signature '), 0, 1, 'L');
    // En-tête du tableau
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'L agent '), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Le chef hierarchique'), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Le Chef Comptable'), 1, 0, 'C');
    $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', 'Bon à payer'), 1, 1, 'C'); 


     // case de signature
     $pdf->SetFont('Courier', '', 12); 
     $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', '   '), 1, 0, 'C');
     $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', '   '), 1, 0, 'C');
     $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', '  '), 1, 0, 'C');
     $pdf->Cell(5.5, 1.5, iconv('UTF-8', 'ISO-8859-1', '  '), 1, 1, 'C');





    // Générer et afficher le fichier PDF dans le navigateur (mode 'I' pour inline)
    $pdf->Output('I', 'facture.pdf');

    // Fermeture du fichier PDF
    $pdf->Close();
}

// Appel de la fonction pour générer la facture
facture(); -->



<!-- select facture.matricule_agent,SUM(facture.montant_facture) AS total_facture from facture join
 demande on facture.id_remboursement=demande.id_remboursement join paiement on paiement.id_remboursement
 =demande.id_remboursement where facture.id_remboursement=6 and paiement.id_paiement=6; -->


 <!-- select matricule_agent,SUM(facture.montant_facture) AS total_facture from facture where id_remboursement=2; -->