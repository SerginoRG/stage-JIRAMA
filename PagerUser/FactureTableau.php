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
                <header>Modification</header>
                <div class="souligne"></div>
                
    
                <form action="../Controller/FactureUpdate.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Information facture</span>
                            
                            <div class="fields">

                                <div class="input-field">
                                    <!-- <label>Id facture</label> -->
                                    <input type="text" hidden name="id_facture" placeholder="Entré l'id" required>
                                </div>


                                <div class="input-field">
                                    <!-- <label>Id remboursement</label> -->
                                    <input type="text" hidden  name="id_remboursement" placeholder="Entré l'id" required>
                                </div>
    
                                <div class="input-field">
                                    <!-- <label>Id analytique</label> -->
                                    <input type="text" hidden name="id_analytique" placeholder="Entré l'id" required>
                                </div>
    
    
                                <div class="input-field">
                                    <label>ID Medicament </label>
                                    <input type="text" hidden name="id_medicament" placeholder="Entré le Matricule" required>
                                </div>
    
                                <div class="input-field">
                                    <label>Numero de la Piécé</label>
                                    <input type="number" name="numero_facture" placeholder="Entré le montant" required>
                                </div>
    
                                <div class="input-field">
                                    <label>Date de la Piécé</label>
                                    <input type="date" name="date_facture"  required>
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
    
                                <div class="input-field">
                                    <label>Remarque</label>
                                <select name="remarque" id="">
                                <option value="Agent">Agent</option>
                                <option value="Conjoint">Conjoint</option>
                                <option value="Enfant">Enfant</option>
                            </select>
                            </div>
    
                                <div class="input-field">
                                    <label>Quantite</label>
                                    <input type="number" name="quantite" placeholder="Entré le description"  required>
                                </div>
    
    
                                <div class="input-field">
                                    <label>Categorie</label>
                                    <select name="categorie" id="">
                                    <option value="Boite">Boite</option>
                                    <option value="Plaquette">Plaquette</option>
                                    <option value="Autre">Autre</option>
                                    </select>
                      </div>


                      <div class="input-field">
                                    <label>Prix unitaire</label>
                                    <input type="number" name="prix_unitaire" placeholder="Entré le prix unitaire"  required>
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
    <div class="table_header">
    <h4><a href="Facture.php">Retour</a></h4>
    <form action="../Controller/export_excel.php" method="post">
<input type="hidden" name="date_debut" value="<?php echo isset($_POST['date_debut']) ? $_POST['date_debut'] : ''; ?>">
<input type="hidden" name="date_fin" value="<?php echo isset($_POST['date_fin']) ? $_POST['date_fin'] : ''; ?>">
<input type="submit" id="btn_export" class="addExecl" style="background-color: greenyellow; padding: 5px; border :none; border-radius:5px;" value="Excel">
</form>
        <div class="meta">
 
            <form action="FactureTableau.php" method="post"> 
            <input type="date" id="rech" name="date_debut">
            <input type="date" id="rech" name="date_fin">
            <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechecher">
            </form>
        </div>
    </div>


    <div class="table_section" >
        <table>
            <thead>
                <tr>
                             <th>id medical</th>
                            <th>demande</th>
                            <th>analytique</th>
                            <th>medica</th>
                            <th>numero  </th>
                            <th>date</th>
                            <th>remarque</th>
                            <th>quantite</th>
                            <th>categorie </th>
                            <th>prix unitaire</th>
                            <th>action</th>
                            
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/FactureRecherche.php");
                $tab = new RechercherRepository();

                $resultat = $tab->read_Facture();


                if(isset($_POST['recherche'])){
                    $s = new Rechercher();
                    $s->setDate_debut($_POST['date_debut']);
                    $s->setDate_fin($_POST['date_fin']);
                
                    $resultat = $tab->search_Facture($s);
                    }
                
                    else{
                    $resultat =$tab->read_Facture();
                    } 
                
                    
                    foreach ($resultat as $r) {
                        ?>
                        <tr data-facture="<?= $r[0] ?>"
                            data-rembourse="<?= $r[1] ?>"
                            data-analytique="<?= $r[2] ?>"
                            data-medica="<?= $r[3] ?>"
                            data-numero="<?= $r[4] ?>"
                            data-date="<?= $r[5] ?>"
                            data-remarque="<?= $r[6] ?>"
                            data-quantite="<?= $r[7] ?>"
                            data-categorie="<?= $r[8] ?>"
                            data-prix="<?= $r[9] ?>">
                            
                        <td><?= $r[0] ?></td>
                        <td><?= $r[1] ?></td>
                        <td><?= $r[2] ?></td>
                        <td><?= $r[3] ?></td>
                        <td><?= $r[4] ?></td>
                        <td><?= $r[5] ?></td>
                        <td><?= $r[6] ?></td>
                         <td><?= $r[7] ?></td>
                         <td><?= $r[8] ?></td>
                         <td><?= $r[9] ?></td>

                        <td>
                                <button class="modal-btn modal-trigger" ><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/FactureDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id_facture" value="<?= $r[0] ?>">
                                    <input type="hidden" name="id_remboursement" value="<?= $r[1] ?>">
                                    <input type="hidden" name="id_analytique" value="<?= $r[2] ?>">
                                    <input type="hidden" name="id_medica" value="<?= $r[3] ?>">
                                  
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
    const factureField = document.querySelector('input[name="id_facture"]');
    const rembourseField = document.querySelector('input[name="id_remboursement"]');
    const analytiqueField = document.querySelector('input[name="id_analytique"]');

    const medicaField = document.querySelector('input[name="id_medicament"]');
    
    const numeroField = document.querySelector('input[name="numero_facture"]');
    const dateField = document.querySelector('input[name="date_facture"]');
    const remarqueField = document.querySelector('select[name="remarque"]');
    
    const quantiteField = document.querySelector('input[name="quantite"]');
    const categorieField = document.querySelector('select[name="categorie"]');
    const prixField = document.querySelector('input[name="prix_unitaire"]');
    
  

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const facture = row.dataset.facture;
            const rembourse = row.dataset.rembourse;
            const analytique = row.dataset.analytique;
            const medica = row.dataset.medica;
            const numero = row.dataset.numero;
            const date = row.dataset.date;
            const remarque = row.dataset.remarque;
            const quantite = row.dataset.quantite;
            const categorie = row.dataset.categorie;
            const prix = row.dataset.prix;



           
           
        
            // Remplir les champs du modal avec les valeurs extraites
            factureField.value = facture;
            rembourseField.value = rembourse;
            analytiqueField.value = analytique;
            medicaField.value = medica;
            numeroField.value = numero ;
            
            dateField.value = date;
            remarqueField.value = remarque;
            quantiteField.value = quantite;
            categorieField.value = categorie;
            prixField.value = prix;
            

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