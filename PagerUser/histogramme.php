<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histogramme des Demandes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../Css/Etat/form.css">
    <link rel="stylesheet" href="../Css/styleK.css">

</head>
<body>

<?php require("Nav.php"); ?>
<div style="width: 80.20%; height: 100%; margin-left: 19%;">
    <canvas id="demandeChart"></canvas>
</div>

<style>
    #demandeChart {
    width: 100% !important; /* S'adapte à la taille du div parent */
    height: 100% !important; 
}

</style>


<script>
    fetch('../Repository/Afficher.php') // Chemin mis à jour
    .then(response => response.json())
    .then(data => {
        console.log("Données reçues :", data); // Vérifier les données dans la console

        if (!data.dates || !data.totals) {
            console.error("Erreur : Données invalides");
            return;
        }

        const ctx = document.getElementById('demandeChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.dates, // Mois
                datasets: [{
                    label: 'Nombre de demandes par mois',
                    data: data.totals, // Nombre de demandes
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => console.error("Erreur lors du chargement des données:", error));

</script>

</body>
</html>


<!-- SELECT 
    DATE_FORMAT(date_demande, '%Y-%m') AS mois,
    COUNT(*) AS total_demandes
FROM demande
GROUP BY mois
ORDER BY mois; -->

