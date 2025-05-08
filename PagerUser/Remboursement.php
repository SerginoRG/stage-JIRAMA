

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../Css/Remboursement/Cool.css">
    <link rel="stylesheet" href="../Css/Remboursement/tabl.css">
    <link rel="stylesheet" href="../Css/Remboursement/model.css">


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
                
    
                <form action="../Controller/RemboursementUpdate.php" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Information de Remboursement</span>
                            
                            <div class="fields">
    
    
                                <div class="input-field">
                                    <label>Id</label>
                                    <input type="number" name="id_remboursement" hidden placeholder="Entré l'id" required>
                                </div>
    
    
                                <div class="input-field">
                                    <label>Matricule</label>
                                    <input type="number" name="matricule_agent"  hidden placeholder="Entré le Matricule" required>
                                </div>

                                <div class="input-field">
                                    <label>CMS</label>
                                    <input type="number" name="id_cms"  hidden placeholder=" " required>
                                </div>
    
    
                                <div class="input-field"> 
                                    <label>Date de demande</label>
                                    <input type="date" name="date_demande"  required>
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
    <h4><a href="RemboursementTableau.php">Voir le tableau</a></h4>
        <div class="meta">
            <form action="Remboursement.php" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>

    <?php
    require("../Repository/RemboursementRepository.php");
    $tab = new RemboursementRepository();
    
    // Initialisation de la variable pour afficher ou non le tableau
    $afficherTableau = false;

    // Vérifier si une recherche a été effectuée
    if (isset($_POST['recherche']) && !empty($_POST['rech'])) {
        $s = new Remboursement();
        $s->setMatricule_agent($_POST['rech']);
        
        // Rechercher par matricule
        $resultat = $tab->search_Remboursement($s);
        
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
                <th>id remboursement</th>
                            <th>matricule</th>
                            <th>id cms</th>
                            <th>date demande </th>
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
                            data-matricule="<?= $r[1] ?>"
                            data-idcms="<?= $r[2] ?>"
                            data-date="<?= $r[3] ?>">
                            <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            <td><?= $r[2] ?></td>
                            <td><?= $r[3] ?></td>
                            
                            <td>
                                <button class="modal-btn modal-trigger"><i class="fa-solid fa-pen-to-square"></i></button>
                                <form class="simple" action="../Controller/RemboursementDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id_remboursement" value="<?= $r[0] ?>">
                                    <input type="hidden" name="matricule_agent" value="<?= $r[1] ?>">
                                    <input type="hidden" name="id_cms" value="<?= $r[2] ?>">
                                    
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













       





        
         <!-- Formulair -->
         <div class="containe">
            <header>Enregistrement</header>
            <div class="soulign"></div>
            

            <form action="../Controller/RemboursementController.php" method="post">
                <div class="form firs">
                    <div class="detail persona">
                        <span class="titl">Information de Remboursement</span>
                        
                        <div class="field">

                        <div class="input-fiel">
                                <label>Matricule</label>
                                <select name="matricule_agent" id="select">
                                <?php
                                    require("../Repository/AgentRepository.php");
                                    $tab = new AgentRepository();
                                    $resultat = $tab->read_Agent();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[0]?></option>
                                <?php } ?>
                            </select>
                        </div>


                            <div class="input-fiel">
                                <label>CMS</label>
                                <select name="id_cms" id="select">
                                <?php
                                    require("../Repository/CmsRepository.php");
                                    $tab = new CMSRepository();
                                    $resultat = $tab->read_CMS();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[2]?></option>
                                <?php } ?>
                            </select>
                        
                        </div>

                            


                            <div class="input-fiel"> 
                                <label>Date de demande</label>
                                <input type="date" name="date_demande"  required>
                            </div>


                            
                          

                        </div>
                    </div>





                    

                        <button class="nextBt">
                            <span class="btnTex">Valide</span>
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
    const idField = document.querySelector('input[name="id_remboursement"]');
    const matriculeField = document.querySelector('input[name="matricule_agent"]');
    const idcmsField = document.querySelector('input[name="id_cms"]');
    const dateField = document.querySelector('input[name="date_demande"]');

    // Parcourir chaque bouton
    updateButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer la ligne parent du bouton
            const row = this.closest('tr');
            
            // Extraire les données des attributs data-*
            const id = row.dataset.id;
            const matricule = row.dataset.matricule;
            const idcms = row.dataset.idcms;
            const date = row.dataset.date;
            

            // Remplir les champs du modal avec les valeurs extraites
            idField.value = id;
            matriculeField.value = matricule;
            idcmsField.value = idcms;
            dateField.value = date;
         

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