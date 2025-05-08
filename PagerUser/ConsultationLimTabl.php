

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Css/Anlytique/style.css">
    <link rel="stylesheet" href="../Css/Anlytique/modalAdd.css">
   
</head>
<body>

   


    
<?php

require("Nav.php");
?>



    <main>



       










    <div class="table">
    <div class="table_header">
    <h4><a href="ConsultationLimite.php">Retour</a></h4>
        <div class="meta">
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
                <th>id type consultation</th>
                            <th>nom consultation</th>
                            <th>plafond</th>
                           
                            
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/TypeconsultationRepository.php");
                $tab = new TypeConsultRepository();

                $resultat = $tab->read_Type_Consultation();


                if(isset($_POST['recherche'])){
                    $s = new TypeConsultationEntity();
                    $s->setId_type_consultation($_POST['rech']);
                    // $s->setcolis($_POST['rech']);
                
                    $resultat = $tab->search_Type_Consultation($s);
                    }
                
                    else{
                    $resultat =$tab->read_Type_Consultation();
                    } 
                
                    
                    foreach ($resultat as $r) {
                        ?>
                        <tr >
                        <td><?= $r[0] ?></td>
                        <td><?= $r[1] ?></td>
                        <td><?= $r[2] ?></td>
                            
                        </tr>
                        <?php
                   }
                ?>
            </tbody>
        </table>
    </div>
</div>






       
        
        
        
        
        
      
        
    </main>
    
    <script src="../JS/app.js">
       
       
    </script>

</body>
</html>