<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/Facture/style.css">
   
    <link rel="stylesheet" href="../Css/Facture/model.css">
    <link rel="stylesheet" href="../Css/Facture/max.css">


    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Affiche une boîte de dialogue si un employé a été ajouté ou modifié avec succès
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'opération a été effectuée avec succès !',
                showConfirmButton: true,
                // timer: 2000
            });
        } else if (urlParams.has('error')) {
            const errorMessage = urlParams.get('error');
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Une erreur est survenue : ' + errorMessage,
                showConfirmButton: true,
            });
        }
    };
</script>

    
 
</head>
<body>

  




    <div class="modal-container">
         
        <div class="overlay modal-trigger"></div> 
        
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>

            <!-- Formulair -->
            <div class="container">
                <header>Contrôle</header>
                <div class="souligne"></div>
                
    
                <form action="../Controller/LoginAfficheUpdate.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Information Login</span>
                            
                            <div class="fields">

                                

                                <div class="input-field">
                                    <label>matricule_agent</label>
                                    <input type="text"  name="matricule_agent"  required>
                                </div>
    
                                <div class="input-field">
                                    <label>User Name</label>
                                    <input type="text"  name="username" placeholder="Entré user name" required>
                                </div>
    
    
                                <div class="input-field">
                                <label>Rôle</label>
                                <select name="role" id="select">
                                    <option value="Admin">Admin</option>
                                    <option value="Utilisateur">Utilisateur</option>
                                </select>
                            </div>
    
                                <div class="input-field">
                                <label>Statut</label>
                                <select name="statut" id="select">
                                    <option value="Actif">Actif</option>
                                    <option value="Bloquer">Bloquer</option>                                    
                                </select>
                                </div>
    
                               

                                <style>
   

   select {
      width: 100%;
      padding: 10px;
      /* border: 1px solid #ccc; */
      border-radius: 4px;
      
      font-size: 1em;
      color: #333;
  }

  /* Style spécifique pour les menus déroulants */
   select {
      appearance: none;
      background-color: #fff;
      background-image: url('data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"%3E%3Cpath fill="%23aaa" d="M7 10l5 5 5-5z"/%3E%3C/svg%3E');
      background-repeat: no-repeat;
      background-position: right 10px center;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.13);
      padding-right: 30px;
  }

</style>
                              
                            </div>
                        </div>
    
    
    
    
    
                        
    
                            <button class="nextBtn">
                                <span class="btnText">Valide</span>
                                <i class="fa-regular fa-paper-plane"></i>
                            </button>
    
    
                        
                    </div>
                </form>
            </div>

            <!--Fin de la Formulair -->
            
        </div>

    </div>




   
    <?php

require("Bar.php");
?>

    
   

    <main>

    <?php
// Afficher un message d'erreur dans une boîte à l'écran si un paramètre d'erreur est présent
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<div class='error-box'>Erreur: $error</div>";
}
?>


<style>


/* CSS pour la boîte d'erreur */
.error-box {
    color: red;
    font-weight: bold;
    background-color: #fdd;
    padding: 10px;
    border: 1px solid red;
    width: 50%;
    margin: 20px auto;
    text-align: center;
    border-radius: 5px;
}
.addExcel{
    padding: 2px 5px; 
    width: 10px;
}
</style>
        

    <div class="table">
    


    <div class="table_section" >
        <table>
            <thead>
                <tr>
                             <th>matricule</th>
                            <th>user name</th>
                            <th>role</th>
                            <th>statut</th>
                            <th>date_creation </th>
                            <th>Action</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/LoginControle.php");
                $tab = new loginControle_Affiche();

                $resultat = $tab->read_controle_Affiche();            
                                      
                    foreach ($resultat as $r) {
                        ?>
                        <tr data-matricule_agent="<?= $r[0] ?>"
                            data-username="<?= $r[1] ?>"
                            data-role="<?= $r[2] ?>"
                            data-statut="<?= $r[3] ?>">
                            
                        <td><?= $r[0] ?></td>
                        <td><?= $r[1] ?></td>
                        <td><?= $r[2] ?></td>
                        <td><?= $r[3] ?></td>
                        <td><?= $r[4] ?></td>
                    

                        <td>
                                <button class="modal-btn modal-trigger" ><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/LoginAfficheDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="matricule_agent" value="<?= $r[0] ?>">
                                  
                                    <button type="submit" style="background-color:  #f80000;"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                <script>
function confirmDelete(event, form) {
    event.preventDefault(); // Empêche l'envoi automatique du formulaire
    
    Swal.fire({
        title: 'Êtes-vous sûr ?',
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, supprimer !',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); // Soumet le formulaire si confirmé
        }
    });
}
</script>
                            </td>
                            
                        </tr>
                        <?php
                   }
                ?>
            </tbody>
        </table>
    </div>
</div>  
        
        
        
        
        
        
        
    </main>


    <script>
    // Sélectionner tous les boutons de mise à jour
    const updateButtons = document.querySelectorAll('.modal-btn');

    // Sélectionner le modal et ses champs
    const modal = document.querySelector('.modal-container');
    const matricule_agentField = document.querySelector('input[name="matricule_agent"]');
    const usernameField = document.querySelector('input[name="username"]');
    const roleField = document.querySelector('select[name="role"]');

    const statutField = document.querySelector('select[name="statut"]');
    
  

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const matricule_agent = row.dataset.matricule_agent;
            const username = row.dataset.username;
            const role = row.dataset.role;
            const statut = row.dataset.statut;
          


           
           
        
            // Remplir les champs du modal avec les valeurs extraites
            matricule_agentField.value = matricule_agent;
            usernameField.value = username;
            roleField.value = role;
            statutField.value = statut;
            
            

            // Afficher le modal
            modal.style.display = 'block';
        });
    });

    // Fermer le modal
    document.querySelector('.close-modal').addEventListener('click', function() {
        modal.style.display = 'none';
    });
</script>





    
    <script>


const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");


modalTriggers.forEach(trigger => trigger.addEventListener("click", ToggleModal))


function ToggleModal(){
    modalContainer.classList.toggle("active")
}
</script>   

</body>
</html>