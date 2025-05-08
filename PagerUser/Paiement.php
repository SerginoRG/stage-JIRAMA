

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/Paiement/model.css">
    <link rel="stylesheet" href="../Css/Paiement/tabl.css">
    <link rel="stylesheet" href="../Css/Paiement/style.css">


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
                <header>Modification</header>
                <div class="souligne"></div>
                
    
                <form action="../Controller/PaiementUpdate.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Information paiement</span>
                            
                            <div class="fields">


                                <div class="input-field">
                                    <label>Id paiement</label>
                                    <input type="text" hidden name="id_paiement" placeholder="Entré le Matricule" required>
                                </div>
    
    
    
                                <div class="input-field">
                                    <label>Id remboursement</label>
                                    <input type="text" hidden name="id_remboursement" placeholder="Entré le Matricule" required>
                                </div>
    
    
                                <div class="input-field"> 
                                    <label>mode_paiement</label>
                                    <input type="text" name="mode_paiement" placeholder="Entré le mode paiement "  required>
                                </div>
    
                                <div class="input-field"> 
                                    <label>date paiement</label>
                                    <input type="date" name="date_paiement"  required>
                                </div>
    
    
    
                             
    
                              
    
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

require("Nav.php");
?>






    
    
    <main>



       



    <div class="table">
    <div class="table_header">
    <h4><a href="PaiementTableau.php">Voir le tableau</a></h4>
        <div class="meta">
            <form action="Paiement.php" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>

    <?php
    require("../Repository/PaiementRepository.php");
    $tab = new PaiementRepository();
    
    // Initialisation de la variable pour afficher ou non le tableau
    $afficherTableau = false;

    // Vérifier si une recherche a été effectuée
    if (isset($_POST['recherche']) && !empty($_POST['rech'])) {
        $s = new Paiement();
        $s->setId_remboursement($_POST['rech']);
        
        // Rechercher par matricule
        $resultat = $tab->search_Paiement($s);
        
        // Si des résultats sont trouvés, afficher le tableau
        if (!empty($resultat)) {
            $afficherTableau = true;
        }
    }
    ?>

    <div class="table_section" <?php if (!$afficherTableau) { echo 'style="display:none;"'; } ?>>
        <table>
            <thead>
                <tr>
                            <th>id paiement</th>
                            <th>id remboursement</th>
                            <th>mode paiement </th>
                            <th>date paiement</th>
                            <!-- <th>montant paye </th> -->
                    <th>Action</th>
                    <th>Facture</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($afficherTableau) {
                    // Afficher les résultats
                    foreach ($resultat as $r) {
                        ?>
                        <tr data-id="<?= $r[0] ?>"
                            data-remboursement="<?= $r[1] ?>"
                            data-mode_paiement="<?= $r[2] ?>"
                            data-date_paiement="<?= $r[3] ?>">
                            <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            <td><?= $r[2] ?></td>
                            <td><?= $r[3] ?></td>
                            
                          
                            <td>
                                <button class="modal-btn modal-trigger"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/PaiementDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id_paiement" value="<?= $r[0] ?>">
                                    <input type="hidden" name="id_remboursement" value="<?= $r[1] ?>">
                                
                                    <button type="submit" style="background-color: #f80000;"><i class="fa-solid fa-trash"></i></button>
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

                            <td>
                                <form action="../Controller/Pdf.php" method="post">
                                <input type="hidden" name="id_paiement" value="<?= $r[0] ?>">
                                <input type="hidden" name="id_remboursement" value="<?= $r[1] ?>">

                                    <button style="background-color: burlywood;" >Facture</button>
                                </form>
                               
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>Aucun employé trouvé. Veuillez effectuer une recherche.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>







      



<!--         
// Afficher un message d'erreur dans une boîte à l'écran si un paramètre d'erreur est présent
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']);
    echo "<div class='error-box'>Erreur: $error</div>";
}


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
</style> -->



        
         <!-- Formulair -->
         <div class="container">
            <header>Enregistrement</header>
            <div class="souligne"></div>
            

            <form action="../Controller/PaiementController.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information paiement</span>
                        
                        <div class="fields">


                            


                            <div class="input-field">
                                <label>Id demande</label>

                                <select name="id_remboursement" id="selecte">
                    <?php
                    require("../Repository/RemboursementRepository.php");
                    $tab = new RemboursementRepository();

                    $resultat = $tab->read_Remboursement();

                    
                    foreach($resultat as $key){   ?>
                    <option value="<?=$key[0]?>"><?=$key[0]?> </option>
                    <?php   }  ?>          
                </select>


                                <!-- <input type="number" name="id_remboursement" placeholder="Entré le Matricule" required> -->
                            </div>
                            <style>
   

   select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
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

                            <div class="input-field"> 
                                <label>mode_paiement</label>
                                <!-- <input type="text" name="mode_paiement" placeholder="Entré le mode paiement "  required> -->
                            <select name="mode_paiement" id="">
                                <option value="Money Mobile">Money Mobile</option>
                                <option value="chéque">chéque</option>
                            </select>
                            </div>

                            <div class="input-field"> 
                                <label>date paiement</label>
                                <input type="date" name="date_paiement"  required>
                            </div>



                         

                          

                        </div>
                    </div>





                    

                        <button class="nextBtn">
                            <span class="btnText">Valide</span>
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>


                    
                </div>
            </form>
        </div>
        
        
        
        
        
        
        
       
        
    </main>


    <script>
    // Sélectionner tous les boutons de mise à jour
    const updateButtons = document.querySelectorAll('.modal-btn');

    // Sélectionner le modal et ses champs
    const modal = document.querySelector('.modal-container');
    const idField = document.querySelector('input[name="id_paiement"]');
    const remboursementField = document.querySelector('input[name="id_remboursement"]');
    const mode_paiementField = document.querySelector('input[name="mode_paiement"]');
    const date_paiementField = document.querySelector('input[name="date_paiement"]');

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const id = row.dataset.id;
            const remboursement = row.dataset.remboursement;
            const mode_paiement = row.dataset.mode_paiement;
            const date_paiement = row.dataset.date_paiement;
            

            // Remplir les champs du modal avec les valeurs extraites
            idField.value = id;
            remboursementField.value = remboursement;
            mode_paiementField.value = mode_paiement;
            date_paiementField.value = date_paiement;
         

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