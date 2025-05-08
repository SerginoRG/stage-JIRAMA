<?php

require("../Repository/LoginControle.php");



$db = new Db(); 
$pdo = $db->connexion();

try {
   

 
    $matricule_agent = $_POST['matricule_agent'];
    
    $password = $_POST['passwordUpdate']; 
  
    

    // Vérifiez que tous les champs requis sont remplis
    if (empty($matricule_agent) ||  empty($password) ) {
        throw new Exception("Tous les champs sont obligatoires !");
    }

   $i = new LoginEntity();
   $i->setMatricule_agent($matricule_agent);
   $i->setPassword($password);

   
  

   // Insertion dans la base de données
   $rep = new loginControle_Affiche();
   $rep->PasswordAdmin($i);

   // Redirection en cas de succès
   header('Location: ../PageAdiminstrateur/PassWordUpdate.php?success=1');
   exit();
} catch (Exception $e) {
   // Redirection avec un message d'erreur en cas d'exception
   header('Location: ../PageAdiminstrateur/PassWordUpdate.php?error=' . urlencode($e->getMessage()));
   exit();
}
?>
