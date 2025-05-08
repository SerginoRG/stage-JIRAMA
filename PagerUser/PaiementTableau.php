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
    
    <link rel="stylesheet" href="../Css/Paiement/tableau.css">
    <link rel="stylesheet" href="../Css/Paiement/style.css">
</head>
<body>

   
<?php

require("Nav.php");
?>


    
    <main>



       






    <div class="table">
    <div class="table_header">
    <h4><a href="Paiement.php">Retour</a></h4>

    <form action="../Controller/execlPaiement.php" method="post">
<input type="hidden" name="date_debut" value="<?php echo isset($_POST['date_debut']) ? $_POST['date_debut'] : ''; ?>">
<input type="hidden" name="date_fin" value="<?php echo isset($_POST['date_fin']) ? $_POST['date_fin'] : ''; ?>">
<input type="submit" id="btn_export" class="addExecl" style="background-color: greenyellow; padding: 5px; border :none; border-radius:5px;" value="Excel">
</form>


        <div class="meta">
            <form action="PaiementTableau.php" method="post"> 
            <input type="date" id="rech" name="date_debut">
            <input type="date" id="rech" name="date_fin">
            <input type="submit" id="btn_new" name="recherche" class="add_new" value="Rechecher">
        
            </form>
        </div>
    </div>


    <div class="table_section" >
        <table>
            <thead>
                <tr>
                <th>id paiement</th>
                            <th>rembourse</th>
                            <th>matricule</th>
                            <th>mode paiement </th>
                            <th>date paiement</th>
                            <th>montant paye </th>
                            
                            
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/paiementRecherche.php");
                $tab = new PRepository();

                $resultat = $tab->read_P();


                if(isset($_POST['recherche'])){
                    $s = new Rechercher();
                    $s->setDate_debut($_POST['date_debut']);
                    $s->setDate_fin($_POST['date_fin']);
                
                    $resultat = $tab->search_P($s);
                    }
                
                    else{
                    $resultat =$tab->read_P();
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