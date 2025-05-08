

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


    
 
</head>
<body>

  







    <?php

require("Nav.php");
?>


    
   

    <main>

 
    <div class="table">
    <div class="table_header">
    <h4><a href="Consultation.php">Retour</a></h4>
   
 
    <form action="" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>


    <div class="table_section" >
        <table>
            <thead>
            <tr>
                    <th>id</th>
                    <th>Type Consultation</th>
                    <th>Id Demande</th>
                    <th>Motif</th>
                    <th>Date Consultation</th>
                    <th>Remarque</th>
                    <th>Frais</th>
                    <th>Lieu de la consultation</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/ConsultationRepository.php");
                $tab = new ConsultationRepository();

                $resultat = $tab->read_Consultation();


                if(isset($_POST['recherche'])){
                    $s = new ConsultationEntity();
                    $s->setIddemande($_POST['rech']);
                    // $s->setcolis($_POST['rech']);
                
                    $resultat = $tab->search_Consultation($s);
                    }
                
                    else{
                    $resultat =$tab->read_Consultation();
                    } 
                
                    
                    foreach ($resultat as $r) {
                        ?>
                        <tr >
                        <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            <td><?= $r[2] ?></td>
                            <td><?= $r[3] ?></td>
                            <td><?= $r[4] ?></td>
                            <td><?= $r[5] ?></td>
                            <td><?= $r[6] ?></td>
                            <td><?= $r[7] ?></td>
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


const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");


modalTriggers.forEach(trigger => trigger.addEventListener("click", ToggleModal))


function ToggleModal(){
    modalContainer.classList.toggle("active")
}
</script>   

</body>
</html>                    