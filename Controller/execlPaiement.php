<?php

// Start output buffering
ob_start();

require("../Repository/paiementRecherche.php");
require '../vendor/autoload.php'; // Ensure the path to autoload.php is correct

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

// Retrieve data
$tab = new PRepository();
$resultat = []; // Initialize $resultat to avoid undefined variable error

if (isset($_POST['date_debut']) && isset($_POST['date_fin'])) {
    $s = new Rechercher();
    $s->setDate_debut($_POST['date_debut']);
    $s->setDate_fin($_POST['date_fin']);
    $resultat = $tab->search_P($s);
} else {
    $resultat = $tab->read_P();
}

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Write the column headers
$sheet->setCellValue('A1', 'id paiement');
$sheet->setCellValue('B1', 'rembourse');
$sheet->setCellValue('C1', 'matricule');
$sheet->setCellValue('D1', 'mode paiement');
$sheet->setCellValue('E1', 'date paiement');
$sheet->setCellValue('F1', 'montant paye');

// Fill the table data
$row = 2;
$totalMontant = 0;

foreach ($resultat as $r) {
    $sheet->setCellValue('A' . $row, $r[0]);
    $sheet->setCellValue('B' . $row, $r[1]);
    $sheet->setCellValue('C' . $row, $r[2]);
    $sheet->setCellValue('D' . $row, $r[3]);
    $sheet->setCellValue('E' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::dateTimeToExcel(new DateTime($r[4]))); // Convert date to Excel format
    $sheet->setCellValue('F' . $row, $r[5]);

    // Ensure that montant is valid and numeric
    $montant = is_numeric($r[5]) ? (float)$r[5] : 0;
    $totalMontant += $montant;
    $row++;
}

// Write the total at the end of the table
$sheet->setCellValue('E' . $row, 'Total');
$sheet->setCellValue('F' . $row, $totalMontant);

// Format the amount column as currency
$sheet->getStyle('F2:F' . $row)->getNumberFormat()->setFormatCode('#,##0.00');

// $sheet->getStyle('F2:F' . $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
// Format the date column
// $sheet->getStyle('E2:E' . $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);


$sheet->getStyle('E2:E' . $row)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);

//  $sheet->getStyle('E2:E' . $row)->getNumberFormat()->setFormatCode('DD/MM/YYYY');

// Output the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Paiements.xlsx"');
header('Cache-Control: max-age=0');

// Use PhpSpreadsheet to generate the file
$writer = new Xlsx($spreadsheet);

// Clear the output buffer before sending the file to avoid corruption
ob_end_clean();
$writer->save('php://output');

exit;
?>
