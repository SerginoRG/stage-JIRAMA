<?php
session_start();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../Css/TableauAgent.css">
    <link rel="stylesheet" href="../Css/styleK.css">
    
</head>
<body>

   
<?php

require("Nav.php");
?>










    
    
    <main>



       










    <div class="table">
    <div class="table_header">
    <h4><a href="Remboursement.php">Retour</a></h4>
        <div class="meta">
            <form action="RemboursementTableau.php" method="post"> 
                <input type="text" name="rech" id="rech" placeholder="Rechercher">
                <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechercher">
            </form>
        </div>
    </div>


    <div class="table_section" >
        <table>
            <thead>
                <tr>
                <th>id remboursement</th>
                            <th>matricule</th>
                            <th>cms</th>

                            <th>date demande </th>
                            
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/RemboursementRepository.php");
                $tab = new RemboursementRepository();

                $resultat = $tab->read_Remboursement();


                if(isset($_POST['recherche'])){
                    $s = new Remboursement();
                    $s->setMatricule_agent($_POST['rech']);
                    // $s->setcolis($_POST['rech']);
                
                    $resultat = $tab->search_Remboursement($s);
                    }
                
                    else{
                    $resultat =$tab->read_Remboursement();
                    } 
                
                    
                    foreach ($resultat as $r) {
                        ?>
                        <tr >
                            <td><?= $r[0] ?></td>
                            <td><?= $r[1] ?></td>
                            <td><?= $r[2] ?></td>
                            <td><?= $r[3] ?></td>
                            
                            
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