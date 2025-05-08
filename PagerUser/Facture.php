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
    <link rel="stylesheet" href="../Css/Facture/style.css">
    <!-- <link rel="stylesheet" href="../Css/Facture/model.css"> -->

    <link rel="stylesheet" href="../Css/Facture/Formulaire.css">

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



       










        
        
        
        
        
        
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            #dataTable {
                width: 10px;
                table-layout: fixed;
                min-width: 900px;
                border-collapse: collapse;
                margin-bottom: 0;
            }
            #dataTable, th, td {
                /* background-color: #45a049; */
                /* border: none; */
        
                /* border: 1px solid black; */
                
                align-items: center;
            }
            th{
                background-color: #009879;
                color: #fff;
                font-size: 15px;
                text-transform: uppercase;
            }
            td {
                /* padding: 10px; */
                color: black;
                text-align: center;
                border-bottom: 1px solid black;
               
            }
            /* input[type="text"], input[type="email"], input[type="date"] {
                width: 90%;
                padding: 5px;
                margin: 0;
            } */
            #dataTable , button {
                /* margin: 10px 5px;
                padding: 10px 15px; */
                /* background-color: #4CAF50; */
                color: white;
                border: none;
                cursor: pointer;
            }
            button:hover {
                background-color: #45a049;
            }
            .remove-btn {
                background-color: #f44336; /* Rouge */
            }
            .remove-btn:hover {
                background-color: #d32f2f; /* Rouge plus foncé */
            }
        </style>
        
        
        
        <h4><a href="Facturetableau.php">Voir le tableau</a></h4>


       
        
        <!-- Formulair -->
        <div class="container">
            <header>Enregistrement</header>
            <div class="souligne"></div>
            
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
      padding-right: 30px;
  }

</style>
            <form action="../Controller/FactureController.php" method="post">
    <div class="form first">
        <div class="details personal">
            <span class="title">Information</span>
            <div class="fields">
                <div class="input-field">
                    <label>Id Demande</label>

                    <select name="id_remboursement" id="selecte">
                    <?php
                    require("../Repository/RemboursementRepository.php");
                    $tab = new RemboursementRepository();

                    $resultat = $tab->read_Remboursement();

                    
                    foreach($resultat as $key){   ?>
                    <option value="<?=$key[0]?>"><?=$key[0]?> </option>
                    <?php   }  ?>          
                </select>
                    

                    <!-- <input type="number" name="id_remboursement" placeholder="Entré l'id" required> -->
                </div>

                <div class="input-field">
                    <label>Id analytique</label>


                    <select name="id_analytique" id="selecte">
                    <?php
                    require("../Repository/AnalytiqueRepository.php");
                    $tab = new AnalytiqueRepository();

                    $resultat = $tab->read_Analytique();

                    
                    foreach($resultat as $key){   ?>
                    <option value="<?=$key[0]?>"><?=$key[1]?> </option>
                    <?php   }  ?>          
                </select>



                    <!-- <input type="number" name="id_analytique" placeholder="Entré l'id" required> -->
                </div>

                <div class="input-field">
                    <label>Numero de la piécé</label>
                    <input type="number" name="numero_facture" placeholder="Entré le numero de la facture" required>
                </div>

                <div class="input-field">
                    <label>Date de la piécé</label>
                    <input type="date" name="date_facture" required>
                </div>

                <div class="input-field">
                    <label>Remarque</label>
                    <!-- <input type="text" name="remarque" placeholder="Entré la remarque" required> -->
                    <select name="remarque" id="">
                        <option value="Agent">Agent</option>
                        <option value="Conjoint">Conjoint</option>
                        <option value="Enfant">Enfant</option>
                    </select>
                </div>
            </div>
        </div>

        <button class="plus" type="button" onclick="addRow()">+</button>

        <table id="dataTable">
            <thead>
                <tr>
                    <th>Medicament</th>
                    <th>Quantite</th>
                    <th>Categorie</th>
                    <th>Prix Untitaire</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="input-max">
                        <select name="id_medicament[]" id="selecte">
                    <?php
                    require("../Repository/MedicamentRepo.php");
                    $tab = new MedicamentRepository();

                    $resultat = $tab->read_Medicament();

                    
                    foreach($resultat as $key){   ?>
                    <option value="<?=$key[0]?>"><?=$key[1]?> </option>
                    <?php   }  ?>          
                </select>
                           
                        </div>
                    </td>

                    <td>
                        <div class="input-max">
                            <input type="number" name="quantite[]" placeholder="Entré la quantite" required>
                        </div>
                    </td>

                    <td>
                        
                        <select name="categorie[]" id="">
                        <option value="Boite">Boite</option>
                        <option value="Plaquette">Plaquette</option>
                        <option value="Autre">Autre</option>
                        </select>

                        </div>
                    </td>

                    <td>
                        <div class="input-max">
                            <input type="number" name="prix_unitaire[]" placeholder="Entré le montant" required>
                        </div>
                    </td>
                    <td><button type="button" class="remove-btn" onclick="removeRow(this)">X</button></td>
                </tr>
            </tbody>
        </table>

        <button class="nextBtn" type="submit">
            <span class="btnText">Valide</span>
        </button>
    </div>
</form>

        </div>
        
        
        
        
        
        
        
        
        
    </main>

    <script>
    // Fonction pour ajouter une ligne
    function addRow() {
        const table = document.getElementById("dataTable").getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        newRow.innerHTML = `
            <td>
                <div class="input-max">
                    ${getMedicamentOptions()}
                </div>
            </td>
            <td>
                <div class="input-max">
                    <input type="number" name="quantite[]" placeholder="Entrer la quantité" required>
                </div>
            </td>
            <td>
                <div class="input-max">
                    <select name="categorie[]" id="">
                        <option value="Boite">Boîte</option>
                        <option value="Plaquette">Plaquette</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="input-max">
                    <input type="number" name="prix_unitaire[]" placeholder="Entrer le montant" required>
                </div>
            </td>
            <td>
                <button type="button" class="remove-btn" onclick="removeRow(this)">X</button>
            </td>
        `;
    }

    // Fonction pour supprimer une ligne
    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    // Génère les options du médicament (PHP injecté côté serveur)
    function getMedicamentOptions() {
        return `
            <select name="id_medicament[]" id="selecte">
                <?php foreach ($resultat as $key) { ?>
                    <option value="<?= $key[0] ?>"><?= $key[1] ?></option>
                <?php } ?>
            </select>
        `;
    }
</script>
    
    <script src="../JS/app.js">
       
       
    </script>

</body>
</html>