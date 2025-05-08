<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="../Css/Etat/form.css">
    <link rel="stylesheet" href="../Css/styleK.css">


    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
if (isset($_GET['error'])) {
    $errorMessage = htmlspecialchars($_GET['error']);
?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: "Erreur",
                text: "<?php echo $errorMessage; ?>",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    </script>
<?php
}
?>





</head>
<body>

<?php

require("Bar.php");
?>

    


    <main>



       










        








        
         <!-- Formulair -->
         <div class="contai">
            <header>PASSWORD</header>
            <div class="soulign"></div>
            

            <form action="../Controller/PassWordAdmin.php" method="post">
                <div class="form firs">
                    <div class="detail persona">
                        <span class="titl">Information </span>
                        
                        <div class="field">
                            
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


                            

                           
                            
                            <div class="input-fiel">
                                <label>Le nouveau PassWord </label>
                                <input type="password" name="passwordUpdate" placeholder="Nouveau mot de passe"  required>
                            </div>

                            <div class="input-fiel">
                                <label>Confirme le nouveau PassWord</label>
                                <input type="password" name="passwordConfirme" placeholder="Confirme de la mot de passe" required>
                            </div>


                            

                            
                            
                            


                        </div>
                    </div>






                        <button class="nextBt">
                            <span class="btnTex">Confirme</span>
                            <i class="fa-solid fa-file-lines"></i>
                        </button>


                    
                </div>
            </form>
        </div>
        
        
        
        
        
        
        
      
       
        
    </main>
    
   
       
       
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.querySelector("input[name='passwordUpdate']");
    const passwordConfirmation = document.querySelector("input[name='passwordConfirme']");

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

</body>
</html>