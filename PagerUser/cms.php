

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




    <?php

require("Nav.php");
?>






    
    
    <main>

    <h4><a href="cmsTableau.php">Voir le tableau</a></h4>
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
        
         <!-- Formulair -->
         <div class="container">
            <header>Enregistrement</header>
            <div class="souligne"></div>
            

            <form action="../Controller/CMSAdd.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information paiement</span>
                        
                        <div class="fields">


                            


                            <div class="input-field">
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

                            <div class="input-field"> 
                                <label>CMS</label>
                                <input type="text" name="nom_cms" placeholder="Entré CMS TOLIARA" required>
                            </div>


                          
                            <div class="input-field"> 
                                <label>Rôle</label>
                                <select name="role_cms" id="select">
                                    <option value="Administratif">Administratif</option>
                                    
                                </select>
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


const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");


modalTriggers.forEach(trigger => trigger.addEventListener("click", ToggleModal))


function ToggleModal(){
    modalContainer.classList.toggle("active")
}
</script>    

</body>
</html>