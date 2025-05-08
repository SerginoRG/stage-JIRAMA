

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./Css/style.css">
    
    
</head>
<body>

 











    
    <div class="sidebar ">
        <div class="logo-dettails">
            <img src="../image/sary.png" alt="">
            <span class="logo_name">JIRAMA</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="Admin.php">
                <i class="fa-solid fa-address-card"></i>
                    <span class="link_name">Ajouter</span>
                </a>
            </li>


            <li>  
                <a href="Afficher.php">
                <i class="fa-solid fa-book-open-reader"></i>
                    <span class="link_name">Affiche</span>
                </a>
            </li>

            <li>  
                <a href="PassWordUpdate.php">
                <i class="fa-solid fa-book-open-reader"></i>
                    <span class="link_name">PassWord</span>
                </a>
            </li>
            

            <li>
                <a href="../PagerUser/Deconnect.php">
                <i class="fa-solid fa-right-to-bracket"></i> 
                    <span class="link_name">Deconnect</span>
                </a>
            </li>

           
        </ul>

    </div>


<!-- <div>

        <i class="fa-solid fa-user"></i>
        <i class="fa-solid fa-house"></i>
        <i class="fa-solid fa-trash"></i>
        <i class="fa-regular fa-pen-to-square"></i>
        <i class="fa-solid fa-circle-chevron-down"></i>
        <i class="fa-solid fa-plus"></i>

        <i class="fa-solid fa-chevron-up"></i>
        
    </div> -->
<!-- 
    <main>



       










        
        
        
        
        
        
        
        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>

        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>

        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>


        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>

        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>

        <div class="containe">
            <h2>Hello </h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro quis eum praesentium iusto dolores? Iusto perspiciatis quo consequatur ullam necessitatibus! Autem voluptatum repudiandae ea eaque ex quidem temporibus voluptas fugit?</p>
        </div>
       
        
    </main> -->
    
    <script >
       let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++ ) {
    
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;
        console.log(arrowParent);
        arrowParent.classList.toggle("showMenu");

    });         
    
}




       
    </script>

</body>
</html>