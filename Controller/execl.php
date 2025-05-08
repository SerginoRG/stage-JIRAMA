<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Créer un nouveau classeur
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Écrire des données
$sheet->setCellValue('A1', 'Hello World !');

// Sauvegarder le fichier
$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');

echo "Fichier Excel créé avec succès.";
?>
