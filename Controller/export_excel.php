<?php

require("../Repository/FactureRecherche.php");
require '../vendor/autoload.php'; // Assurez-vous que le chemin vers le fichier autoload.php est correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Récupérer les données
$tab = new RechercherRepository();

if (isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
    $s = new Rechercher();
    $s->setDate_debut($_POST['date_debut']);
    $s->setDate_fin($_POST['date_fin']);
    $resultat = $tab->search_Facture($s);
} else {
    $resultat = $tab->read_Facture();
}

// Créer un nouveau classeur
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Écrire les en-têtes de colonnes
$sheet->setCellValue('A1', 'medicale');
$sheet->setCellValue('B1', 'demande');
$sheet->setCellValue('C1', 'analytique');
$sheet->setCellValue('D1', 'medicament');
$sheet->setCellValue('E1', 'numero piece');
$sheet->setCellValue('F1', 'date piece');
$sheet->setCellValue('G1', 'remarque');
$sheet->setCellValue('H1', 'quantite');
$sheet->setCellValue('I1', 'categorie');
$sheet->setCellValue('J1', 'prix unitaire');
$sheet->setCellValue('K1', 'total'); // Ajout de la colonne Total

// Remplir les données du tableau
$row = 2; // La première ligne est utilisée pour les en-têtes
$totalMontant = 0; // Initialiser la variable pour le total

foreach ($resultat as $r) {
    $total = floatval($r[7]) * floatval($r[9]);

    $sheet->setCellValue('A' . $row, $r[0]);
    $sheet->setCellValue('B' . $row, $r[1]);
    $sheet->setCellValue('C' . $row, $r[2]);
    $sheet->setCellValue('D' . $row, $r[3]);
    $sheet->setCellValue('E' . $row, $r[4]);
    $sheet->setCellValue('F' . $row, $r[5]);
    $sheet->setCellValue('G' . $row, $r[6]);
    $sheet->setCellValue('H' . $row, floatval($r[7]));
    $sheet->setCellValue('I' . $row, $r[8]);
    $sheet->setCellValue('J' . $row, floatval($r[9]));
    $sheet->setCellValue('K' . $row, $total); // Total = quantité * prix unitaire
    
    // Ajouter le total à la somme totale
    $totalMontant += $total;
    $row++;
}

// Écrire le total à la fin du tableau
$sheet->setCellValue('J' . $row, 'Total'); // Écrire "Total" dans la colonne J
$sheet->setCellValue('K' . $row, $totalMontant); // Écrire la somme totale dans la colonne K
$row++; // Passer à la ligne suivante si nécessaire

// Sauvegarder le fichier Excel dans le flux de sortie
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="factures.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>


















<!-- require("../Repository/FactureRecherche.php");

// Récupérer les données
$tab = new RechercherRepository();
$resultat = $tab->read_Facture();

if (isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
    $s = new Rechercher();
    $s->setDate_debut($_POST['date_debut']);
    $s->setDate_fin($_POST['date_fin']);
    $resultat = $tab->search_Facture($s);
}

// Créer le fichier Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=factures.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Écrire les données dans le fichier Excel
echo "<table>";
echo "<thead>";
echo "<tr>
        <th>id facture</th>
        <th>rembourse</th>
        <th>analytique</th>
        <th>numero</th>
        <th>date</th>
        <th>remarque</th>
        <th>description</th>
        <th>montant</th>
      </tr>";
echo "</thead>";
echo "<tbody>";

foreach ($resultat as $r) {
    echo "<tr>
            <td>{$r[0]}</td>
            <td>{$r[1]}</td>
            <td>{$r[2]}</td>
            <td>{$r[3]}</td>
            <td>{$r[4]}</td>
            <td>{$r[5]}</td>
            <td>{$r[6]}</td>
            <td>{$r[7]}</td>
          </tr>";
}

echo "</tbody>";
echo "</table>";










require '../vendor/autoload.php'; // Assurez-vous que le chemin vers le fichier autoload.php est correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Connexion à votre base de données (ajustez les paramètres selon votre configuration)
require("../Repository/FactureRecherche.php");
$tab = new RechercherRepository();
$resultat = $tab->read_Facture();

// Créer un nouveau classeur
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Écrire les en-têtes de colonnes
$sheet->setCellValue('A1', 'id facture');
$sheet->setCellValue('B1', 'rembourse');
$sheet->setCellValue('C1', 'analytique');
$sheet->setCellValue('D1', 'numero');
$sheet->setCellValue('E1', 'date');
$sheet->setCellValue('F1', 'remarque');
$sheet->setCellValue('G1', 'description');
$sheet->setCellValue('H1', 'montant');

// Remplir les données du tableau
$row = 2; // La première ligne est utilisée pour les en-têtes
foreach ($resultat as $r) {
    $sheet->setCellValue('A' . $row, $r[0]);
    $sheet->setCellValue('B' . $row, $r[1]);
    $sheet->setCellValue('C' . $row, $r[2]);
    $sheet->setCellValue('D' . $row, $r[3]);
    $sheet->setCellValue('E' . $row, $r[4]);
    $sheet->setCellValue('F' . $row, $r[5]);
    $sheet->setCellValue('G' . $row, $r[6]);
    $sheet->setCellValue('H' . $row, $r[7]);
    $row++;
}

// Sauvegarder le fichier Excel dans le flux de sortie
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="factures.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit; -->

