

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../Css/tabl.css">
    <link rel="stylesheet" href="../Css/mode.css">
    <link rel="stylesheet" href="../Css/styleK.css">


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
                
    
                <form action="../Controller/AgentControllerUpdate.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information de l'agent</span>
                        
                        <div class="fields">
                            <div class="input-field">
                                <label>Matricule</label>
                                <input type="text" name="matricule_agent" placeholder="Entré le Matricule" hidden required>
                            </div>

                            <div class="input-field">
                                <label>Nom de l'employé</label>
                                <input type="text" name="nom_agent" placeholder="Entré le nom de l'employe" required>
                            </div>

                            <div class="input-field">
                                <label>Prènom de l'employé</label>
                                <input type="text" name="prenom_agent" placeholder="Entré le prenom de l'employe" required>
                            </div>


                            <div class="input-field">
                                <label>Societe</label>
                                <input type="number" name="id_societe"  placeholder="Enrté le nom de la societe " required>
                            </div>

                            <div class="input-field">
                                <label>Adresse</label>
                                <input type="text" name="adresse_agent" placeholder="Entré l'adresse"  required>
                            </div>

                            <div class="input-field">
                                <label>Sexe</label>
                                <!-- <input type="text" name="sexe_agent" placeholder="Entré le sexe" required> -->
                                <select name="sexe_agent" id="select">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>

                            
                            
                            <div class="input-field">
                                <label>Compte bancaire</label>
                                <input type="number" name="compte_bancaire" placeholder="Entré le compte bancaire" required>
                            </div>

                           

                            <div class="input-field">
                                <label>Statut</label>
                                <!-- <input type="text" name="statut" placeholder="Entré statut" required> -->
                                <select name="statut" id="select">
                                    <option value="Actif">Actif</option>
                                    <option value="Retraite">Retraite</option>
                                    <option value="Décédé">Décédé</option>
                                    
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Téléphone</label>
                                <input type="number" name="telephone" placeholder="Entré le telephone" required>
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
        <p>Page des agents</p>
        <div class="meta">
            <form action="Agent.php" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>

    <?php
    require("../Repository/AgentRepository.php");
    $tab = new AgentRepository();
    
    // Initialisation de la variable pour afficher ou non le tableau
    $afficherTableau = false;

    // Vérifier si une recherche a été effectuée
    if (isset($_POST['recherche']) && !empty($_POST['rech'])) {
        $s = new Agent();
        $s->setMatriculeAgent($_POST['rech']);
        
        // Rechercher par matricule
        $resultat = $tab->search_Agent($s);
        
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
                    <th>Matricule</th>
                    <th>Société</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Sexe</th>
                    <th>Statut</th>
                    <th>telephone</th>
                    <th>Numéro de compte</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($afficherTableau) {
                    // Afficher les résultats
                    foreach ($resultat as $r) {
                        ?>
                        <tr data-matricule="<?= $r[0] ?>"
                        data-societe="<?= $r[1] ?>"
                            data-nom="<?= $r[2] ?>"
                            data-prenom="<?= $r[3] ?>"
                            data-adresse="<?= $r[4] ?>"
                            data-sexe="<?= $r[5] ?>"
                            data-statut="<?= $r[6] ?>"
                            data-telephone="<?= $r[7] ?>"
                            data-compte="<?= $r[8] ?>">
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
                                <form class="simple" action="../Controller/AgentControllerDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="matricule_agent" value="<?= $r[0] ?>">
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
            

            <form action="../Controller/AgentController.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information de l'agent</span>
                        
                        <div class="fields">
                            <!-- <div class="input-field">
                                <label>Matricule</label>
                                <input type="text" name="matricule_agent" placeholder="Entré le Matricule" required>
                            </div> -->

                            <div class="input-field">
                                <label>Nom de l'employé</label>
                                <input type="text" name="nom_agent" placeholder="Entré le nom de l'employe" required>
                            </div>

                            <div class="input-field">
                                <label>Prènom de l'employé</label>
                                <input type="text" name="prenom_agent" placeholder="Entré le prenom de l'employe" required>
                            </div>
                
                
                
                            <div class="input-field"> 
                            <label for="select-societe">Société</label>
                            <select name="id_societe" id="select">
                                <?php
                                    require("../Repository/SocieteRepository.php");
                                    $tab = new SocieteRepository();
                                    $resultat = $tab->read_Societe();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[1]?></option>
                                <?php } ?>
                            </select>
                            </div>



                            <div class="input-field">
                                <label>Adresse</label>
                                <input type="text" name="adresse_agent" placeholder="Entré l'adresse"  required>
                            </div>

                            <div class="input-field">
                                <label>Sexe</label>
                                <!-- <input type="text" name="sexe_agent" placeholder="Entré le sexe" required> -->
                                <select name="sexe_agent" id="select">
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Statut</label>
                                <select name="statut" id="select">
                                    <option value="Actif">Actif</option>
                                    <option value="Retraite">Retraite</option>
                                    <option value="Décédé">Décédé</option>
                                    
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Compte bancaire</label>
                                <input type="number" name="compte_bancaire" placeholder="Entré le compte bancaire" required>
                            </div>

                            <!-- <div class="input-field">
                                <label>CIN</label>
                                <input type="number" name="cin" placeholder="Entré le CIN" required>
                            </div> -->

                            <div class="input-field">
                                <label>Téléphone</label>
                                <input type="number" name="telephone" placeholder="034 " required>
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
    const matriculeField = document.querySelector('input[name="matricule_agent"]');
    const nomField = document.querySelector('input[name="nom_agent"]');
    const prenomField = document.querySelector('input[name="prenom_agent"]');
    const societeField = document.querySelector('input[name="id_societe"]');
    const adresseField = document.querySelector('input[name="adresse_agent"]');
    const sexeField = document.querySelector('select[name="sexe_agent"]');
    const telephoneField = document.querySelector('input[name="telephone"]');
    
    const compteField = document.querySelector('input[name="compte_bancaire"]');
    
    
    const statutField = document.querySelector('select[name="statut"]');

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const matricule = row.dataset.matricule;
            const nom = row.dataset.nom;
            const prenom = row.dataset.prenom;
            const societe = row.dataset.societe;
            
            const adresse = row.dataset.adresse;
            const sexe = row.dataset.sexe;
            const compte = row.dataset.compte;
            
           
            const statut = row.dataset.statut;
            const telephone = row.dataset.telephone;

            // Remplir les champs du modal avec les valeurs extraites
            matriculeField.value = matricule;
            nomField.value = nom;
            prenomField.value = prenom;
            societeField.value = societe;
            
            adresseField.value = adresse;
            sexeField.value = sexe;
            compteField.value = compte;
          
            
            statutField.value = statut;
            telephoneField.value = telephone;

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