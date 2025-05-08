

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/styleK.css">
    <link rel="stylesheet" href="../Css/tabl.css">
    <link rel="stylesheet" href="../Css/mode.css">

   



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Affiche une boîte de dialogue si un employé a été ajouté ou modifié avec succès
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            const message = urlParams.get('message');
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: message || 'L\'opération a été effectuée avec succès !',
                showConfirmButton: true,
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
                
    
                <form action="../Controller/HospitalisationUpdate.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information de l'agent</span>
                        
                        <div class="fields">

                              

                                <div class="input-field">
                                    
                                    <input type="number"  name="id_hospitalisation" required>
                 
                                    
                                
                                </div>
                            <div class="input-field">
                               
                                <input type="number"  name="id_demande"  required>
                         
                                </div>

                                <div class="input-field">
                               
                               <input type="text"  name="id_type_hospitalisation"  required>
                        
                               </div>
                                




                                
                                <div class="input-field">
                                  <label>Numero piécé</label>
                                 <input type="number" name="numero_piece" placeholder="Entré le Numero piécé" required>
                            </div>

                            <div class="input-field">
                                <label>Date d'entrée</label>
                                <input type="date" name="date_entree"  required>
                            </div>


                            <div class="input-field">
                                <label>Date de sortie</label>
                                <input type="date" name="date_sortie"  required>
                            </div>


                           

                            <div class="input-field">
                                <label>Frais</label>
                                <input type="number" name="frais_hospitalisation" placeholder="Entré le frais de hospitalisation"  required>
                            </div>
                            
                            <div class="input-field">
                                <label>Remarque</label>
                                <!-- <input type="text" name="remarque" placeholder="Entré la remarque" required> -->
                                <select name="remarque" id="">
                                    <option value="Agent">Agent</option>
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="Enfant">Enfant</option>
                                </select>
                            </div>
                            
                            
                            <div class="input-field">
                                <label>Lieu de la hospitalisation</label>
                                <input type="text" name="lieu_hospitalisation" placeholder="Entré le lieu de la hospitalisation" required>
                                                            
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
    <h4><a href="HospitalisationTable.php">Voir le tableau</a></h4>
        <div class="meta">
            <form action="" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>

    <?php
    require("../Repository/HospitalisationRepository.php");
    $tab = new HospitalisationRepository();
    
    // Initialisation de la variable pour afficher ou non le tableau
    $afficherTableau = false;

    // Vérifier si une recherche a été effectuée
    if (isset($_POST['recherche']) && !empty($_POST['rech'])) {
        $s = new HospitalisationEntity();
        $s->setIddemande($_POST['rech']);
        
        // Rechercher par matricule
        $resultat = $tab->search_Hospitalisation($s);
        
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
                    <th>id</th>
                    <th>Id Demande</th>
                    <th>Type hospitalisation</th>
                    <th>numero piece</th>
                    <th>date entree</th>
                    <th>date sortie</th>
                    <th>frais</th>
                    <th>Remarque</th>
                    <th>Lieu </th>
                    
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($afficherTableau) {
                    // Afficher les résultats
                    foreach ($resultat as $r) {
                        ?>
                        <tr data-id="<?= $r[0] ?>"
                            data-demande="<?= $r[1] ?>"
                            data-hospitalisation="<?= $r[2] ?>"
                            data-piece="<?= $r[3] ?>"
                            data-entree="<?= $r[4] ?>"
                            data-sortie="<?= $r[5] ?>"
                            data-frais="<?= $r[6] ?>"
                            data-remarque="<?= $r[7] ?>"
                            data-lieu="<?= $r[8] ?>">
                            <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            <td><?= $r[2] ?></td>
                            <td><?= $r[3] ?></td>
                            <td><?= $r[4] ?></td>
                            <td><?= $r[5] ?></td>
                            <td><?= $r[6] ?></td>
                            <td><?= $r[7] ?></td>
                            <td><?= $r[8] ?></td>
                          
                            <td>
                                <button class="modal-btn modal-trigger"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/HospitalisationDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id" value="<?= $r[0] ?>">
                                    <input type="hidden" name="demande" value="<?= $r[1] ?>">
                                    <input type="hidden" name="type" value="<?= $r[2] ?>">

                                    <button type="submit" class="delete-btn"><i class="fa-solid fa-trash"></i></button>
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
</style>
         -->
         <!-- Formulair -->
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

         <div class="container">
            <header>Enregistrement</header>
            <div class="souligne"></div>
            

            <form action="../Controller/HospalisationAdd.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information de la Hospitalisation</span>
                        
                        <div class="fields">
                            <div class="input-field">
                                <label>Id Demande</label>
                                <!-- <input type="number" name="id_demande" placeholder="Entré l'id de la Demande" required> -->
                                <select name="id_demande" id="select">
                                <?php
                                    require("../Repository/RemboursementRepository.php");
                                    $tab = new RemboursementRepository();
                                    $resultat = $tab->read_Remboursement();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[0]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="input-field">
                                    <label>Type Hospitalisation</label>
                                    <!-- <input type="text" name="type_consultation" placeholder="Entré le Type Consultation" required> -->
                                    <select name="id_type_hospitalisation" id="select">
                                <?php
                                    require("../Repository/TypeHospitalistionRepo.php");
                                    $tab = new TypeHopistalRepository();
                                    $resultat = $tab->read_Type_Hospitalisation();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[1]?></option>
                                        <?php } ?>
                                    </select>
                                    
                                
                                </div>


                                
                               <div class="input-field">
                                  <label>Numero piécé</label>
                                 <input type="number" name="numero_piece" placeholder="Entré le Numero piécé" required>
                            </div>

                            <div class="input-field">
                                <label>Date d'entrée</label>
                                <input type="date" name="date_entree"  required>
                            </div>


                            <div class="input-field">
                                <label>Date de sortie</label>
                                <input type="date" name="date_sortie"  required>
                            </div>


                           

                            <div class="input-field">
                                <label>Frais</label>
                                <input type="number" name="frais_hospitalisation" placeholder="Entré le frais de hospitalisation"  required>
                            </div>
                            
                            <div class="input-field">
                                <label>Remarque</label>
                                <!-- <input type="text" name="remarque" placeholder="Entré la remarque" required> -->
                                <select name="remarque" id="">
                                    <option value="Agent">Agent</option>
                                    <option value="Conjoint">Conjoint</option>
                                    <option value="Enfant">Enfant</option>
                                </select>
                            </div>
                            
                            
                            <div class="input-field">
                                <label>Lieu de la hospitalisation</label>
                                <input type="text" name="lieu_hospitalisation" placeholder="Entré le lieu de la hospitalisation" required>
                                                            
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
    const idField = document.querySelector('input[name="id_hospitalisation"]');
    const demandeField = document.querySelector('input[name="id_demande"]');
    const hospitalisationField = document.querySelector('input[name="id_type_hospitalisation"]');
    const pieceField = document.querySelector('input[name="numero_piece"]');
    const entreeField = document.querySelector('input[name="date_entree"]');
    const sortieField = document.querySelector('input[name="date_sortie"]');
    
    const fraisField = document.querySelector('input[name="frais_hospitalisation"]');
    const remarqueField = document.querySelector('select[name="remarque"]');
    const lieuField = document.querySelector('input[name="lieu_hospitalisation"]');
    


    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const id = row.dataset.id;
            const demande = row.dataset.demande;
            const hospitalisation = row.dataset.hospitalisation;
            const piece = row.dataset.piece;
            
            const entree = row.dataset.entree;
            const sortie = row.dataset.sortie;
            const frais = row.dataset.frais;
            const remarque = row.dataset.remarque;
            const lieu = row.dataset.lieu;
           
            

            // Remplir les champs du modal avec les valeurs extraites
            idField.value = id;
            demandeField.value = demande;
            hospitalisationField.value = hospitalisation;
            pieceField.value = piece;
            
            entreeField.value = entree;
            sortieField.value = sortie;
            fraisField.value = frais;
            remarqueField.value = remarque;
            lieuField.value = lieu;
            
           

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




    <!-- <script src="../JS/app.js">
       
       
    </script> -->

</body>
</html>