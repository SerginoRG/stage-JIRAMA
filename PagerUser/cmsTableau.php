

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JIRAMA CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="../Css/Paiement/tableau.css">
    <link rel="stylesheet" href="../Css/Paiement/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>

   
<?php

require("Nav.php");
?>


    
    <main>



       






    <div class="table">
    <div class="table_header">
    <h4><a href="cms.php">Retour</a></h4>

   


    </div>


    <div class="table_section" >
        <table>
            <thead>
                <tr>
                <th>id cms</th>
                            <th>matricule</th>
                          
                            <th>nom cms </th>
                            <th>role</th>
                            <th>action </th>
                            
                            
                </tr>
            </thead>
            <tbody>
                <?php
                require("../Repository/CmsRepository.php");
                $tab = new CMSRepository();

                $resultat = $tab->read_CMS();


              
                
                    
                    foreach ($resultat as $r) {
                        ?>
                        <tr >
                        <td><?= $r[0] ?></td>
                        <td><?= $r[1] ?></td>
                        <td><?= $r[2] ?></td>
                        <td><?= $r[3] ?></td>
                        <td>                       
                              <form class="simple" action="../Controller/cmsDelete.php" method="post" onsubmit="return confirmDelete(event, this);">
                                    <input type="hidden" name="id_cms" value="<?= $r[0] ?>">
                                    <input type="hidden" name="matricule" value="<?= $r[1] ?>">
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