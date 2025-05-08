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

require("Nav.php");
?>
    


    <main>



       










        








        
         <!-- Formulair -->
         <div class="contai">
            <header>Rapport en Etat</header>
            <div class="soulign"></div>
            

            <form action="../Controller/PdfEtat.php" method="post">
                <div class="form firs">
                    <div class="detail persona">
                        <span class="titl">Information </span>
                        
                        <div class="field">
                            
                            <div class="input-fiel">
                                <label>Societe </label>
                                <select name="societe_agent" id="select">
                                <?php
                                    require("../Repository/SocieteRepository.php");
                                    $tab = new SocieteRepository();
                                    $resultat = $tab->read_Societe();

                                    foreach($resultat as $key) { ?>
                                        <option value="<?=$key[0]?>"><?=$key[1]?></option>
                                <?php } ?>
                            </select>
                            </div>


                            <div class="input-fiel">
                                <label>Statut</label>
                                <select name="statut" id="select">
                                    <option value="Actif">Actif</option>
                                    <option value="Retraite">Retraite</option>
                                    <option value="Décédé">Décédé</option>
                                    
                                </select>
                            </div>


                           
                            
                            <div class="input-fiel">
                                <label>Date initiale </label>
                                <input type="date" name="datedebu"  required>
                            </div>

                            <div class="input-fiel">
                                <label>Date finale</label>
                                <input type="date" name="datefin" required>
                            </div>


                            

                            
                            
                            


                        </div>
                    </div>






                        <button class="nextBt">
                            <span class="btnTex">PDF</span>
                            <i class="fa-solid fa-file-lines"></i>
                        </button>


                    
                </div>
            </form>
        </div>
        
        
        
        
        
        
        
      
       
        
    </main>
    
   
       
       
    </script>

</body>
</html>