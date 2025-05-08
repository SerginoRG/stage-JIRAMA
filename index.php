<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./Css/Login/Log.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
</head>
<body>
    <!-- ======================= LOGIN ======================== -->
    <div class="container" id="signIn">
        <h1 class="form-title">LOGIN</h1>

        <form id="loginForm" method="POST" action="./Controller/LoginVerfication.php"> <!-- Assurez-vous que login.php est le fichier PHP de traitement -->
            <div class="input-group">
                <label for="name">Utilisateur</label>
                <input type="text" name="username" id="name" placeholder="Utilisateur" required>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
            </div>

            <input type="submit" class="btn" value="Envoyer" name="signIn">
        </form>

        <!-- <p class="or">------------or------------</p>

        <div class="icons">
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-linkedin"></i>
            <i class="fa-brands fa-facebook"></i>
        </div> -->
    </div>



     
        <!-- <p><a href="./PageAdiminstrateur/Admin.php">A</a></p>
        <p><a href="./PagerUser/Acceuiller.php">U</a></p>
         -->
    

    <!-- Script pour gérer les alertes SweetAlert -->
    <script>
    // Vérifiez si des paramètres d'URL existent (succès ou erreur)
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    // Si erreur de connexion
    if (error) {
        Swal.fire({
            title: "Erreur",
            text: decodeURIComponent(error),
            icon: "error",
            confirmButtonText: "Réessayer"
        });
    }
</script>

</body>
</html>

        
        
       


    
   