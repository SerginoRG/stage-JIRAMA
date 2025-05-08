

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../Css/tabl.css">
    <link rel="stylesheet" href="../Css/mode.css">
    <link rel="stylesheet" href="../Css/Admin/styleA.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = function () {
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.has('success')) {
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: 'L\'opération a été effectuée avec succès !',
                showConfirmButton: false,
                timer: 3000 // Auto-fermeture après 3 secondes
            });
        }

        if (urlParams.has('error')) {
            const errorMessage = urlParams.get('error');
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: errorMessage,
                showConfirmButton: true,
            });
        }
    };
</script>




</head>
<body>

   









    <?php

require("Bar.php");
?>
    
   

    <main>



       



       
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
            

            <form action="../Controller/LoginActive.php" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Information </span>
                        
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
                                <label>User name</label>
                                <input type="text" name="username" placeholder="Entré le nom de l'utilisateur" required>
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
                            
                            <div class="input-field">
                                <label>Date de creation </label>
                                <input type="date" name="date_creation"  required>
                            </div>
                            
                            <div class="input-field">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Entré le mot de passe"  required>
                            </div>
                           
                            <div class="input-field">
                                <label>Password Confirmation</label>
                                <input type="password" name="passwordConfirmation" placeholder="Confirme le mot de passe"  required>
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


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.querySelector("input[name='password']");
    const passwordConfirmation = document.querySelector("input[name='passwordConfirmation']");

    form.addEventListener("submit", function (event) {
        if (password.value !== passwordConfirmation.value) {
            event.preventDefault(); // Empêche l'envoi du formulaire
            Swal.fire({
                icon: "error",
                title: "Erreur",
                text: "Les mots de passe ne correspondent pas !",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK"
            });
        }
    });
});
</script>




    <!-- <script src="../JS/app.js">
       
       
    </script> -->

</body>
</html>