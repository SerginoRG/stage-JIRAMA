

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/Anlytique/style.css">
    <link rel="stylesheet" href="../Css/Anlytique/tabl.css">
    <link rel="stylesheet" href="../Css/Anlytique/model.css">


    
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
                
    
                <form action="../Controller/SocieteUdpate.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Information de la sociétè</span>
                            
                            <div class="fields">
                                <div class="input-field">
                                    <label>Id  </label>
                                    <input type="text" hidden name="id_societe" placeholder="Entré l'id" required>
                                </div>
    
                                <div class="input-field">
                                    <label>Nom de la sociétè</label>
                                    <input type="text" name="nom_societe" placeholder="Entré le nom de la sociétè" required>
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
    <h4><a href="SocieteTableau.php">Voir le tableau</a></h4>
        <div class="meta">
            <form action="Societe.php" method="post"> 
                <input type="number" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>

    <?php
    require("../Repository/SocieteRepository.php");
    $tab = new SocieteRepository();
    
    // Initialisation de la variable pour afficher ou non le tableau
    $afficherTableau = false;

    // Vérifier si une recherche a été effectuée
    if (isset($_POST['recherche']) && !empty($_POST['rech'])) {
        $s = new Societe();
        $s->setId_societe($_POST['rech']);
        
        // Rechercher par matricule
        $resultat = $tab->search_Societe($s);
        
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
                <th>Id</th>
                <th>Nom Societe</th>
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
                            data-societe="<?= $r[1] ?>">
                            <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            
                          
                            <td>
                                <button class="modal-btn modal-trigger"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/SocieteDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id_societe" value="<?= $r[0] ?>">
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
         <div class="container">
            <header>Enregistrement</header>
            <div class="souligne"></div>
            

            <form action="../Controller/SocieteAdd.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information de la sociétè</span>
                        
                        <div class="fields">
                        <div class="input-field">
                                    <label>Id  </label>
                                    <input type="number"  name="id_societe" placeholder="Entré l'id" required>
                                </div>
    
                                <div class="input-field">
                                    <label>Nom de la sociétè</label>
                                    <input type="text" name="nom_societe" placeholder="Entré le nom de la sociétè" required>
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
    const idField = document.querySelector('input[name="id_societe"]');
    const societeField = document.querySelector('input[name="nom_societe"]');
    
    
    

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const id = row.dataset.id;
            const societe = row.dataset.societe;
            
            // Remplir les champs du modal avec les valeurs extraites
            idField.value = id;
            societeField.value = societe;
            
          

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