<?php
require_once("../Config/serveur.php");

class Affiche {
    public function read_histogramme() {
        $db = new Db();
        $h = $db->connexion()->query("
            SELECT DATE_FORMAT(date_demande, '%Y-%m') AS mois, COUNT(*) AS total_demandes 
            FROM demande 
            GROUP BY mois 
            ORDER BY mois
        ");

        $labels = [];
        $data = [];

        foreach ($h->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $labels[] = $row["mois"]; // Liste des mois
            $data[] = $row["total_demandes"]; // Nombre de demandes
        }

        // Encodage en JSON et retour
        header('Content-Type: application/json');
        echo json_encode(["dates" => $labels, "totals" => $data]);
    }
}

// Exécuter la fonction et afficher les données JSON
$affiche = new Affiche();
$affiche->read_histogramme();


?>