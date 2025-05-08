<?php









$host = 'localhost';   // Hôte de la base de données
$dbname = 'server';    // Nom de votre base de données
$username = 'root';    // Utilisateur par défaut de XAMPP
$password = '';        // Mot de passe vide si vous ne l'avez pas configuré

// Connexion à la base de données


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

 // Récupérer toutes les lignes sous forme de tableau associatif

// Requête pour obtenir le nombre d'agents
$stmtAgent = $pdo->query("SELECT COUNT(*) FROM agent");
$countAgent = $stmtAgent->fetchColumn();

// Requête pour obtenir le nombre de demandes de remboursement
$stmtDemande = $pdo->query("SELECT COUNT(*) FROM demande");
$countDemande = $stmtDemande->fetchColumn();

// Requête pour obtenir le nombre de paiements
$stmtPaiement = $pdo->query("SELECT COUNT(*) FROM paiement");
$countPaiement = $stmtPaiement->fetchColumn();

// Requête pour obtenir le nombre d'utilisateurs
$stmtUsers = $pdo->query("SELECT COUNT(*) FROM login");
$countUsers = $stmtUsers->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/styleK.css">
    <link rel="stylesheet" href="../Css/cardBox.css">
    <link rel="stylesheet" href="../Css/Anlytique/tabl.css">
</head>
<body>

<?php require("Nav.php"); ?>

<main>
    <div class="carBox">
        <!-- Un card -->
        <div class="card">
            <div>
                <div class="numbers"><?php echo $countAgent; ?></div>
                <div class="cardName">Agent</div>
            </div>
            <div class="iconBox">
                <i class="fa-solid fa-users-rectangle"></i>
            </div>
        </div>

        <!-- deux card -->
        <div class="card">
            <div>
                <div class="numbers"><?php echo $countDemande; ?></div>
                <div class="cardName">Demande</div>
            </div>
            <div class="iconBox">
                <i class="fa-regular fa-credit-card"></i>
            </div>
        </div>

        <!-- trois card -->
        <div class="card">
            <div>
                <div class="numbers"><?php echo $countPaiement; ?></div>
                <div class="cardName">Paiement</div>
            </div>
            <div class="iconBox">
                <i class="fa-solid fa-cash-register"></i>
            </div>
        </div>

        <!-- quatre card -->
        <div class="card">
            <div>
                <div class="numbers"><?php echo $countUsers; ?></div>
                <div class="cardName">Utilisateur</div>
            </div>
            <div class="iconBox">
                <i class="fa-solid fa-user-tie"></i>
            </div>
        </div>
    </div>

    <div>
        <h1>Système de gestion de remboursement des frais médicaux</h1>
    </div>





    
</main>

<script src="./JS/app.js"></script>

</body>
</html>
