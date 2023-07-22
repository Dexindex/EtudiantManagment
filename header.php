<!doctype html> 
<html lang="fr"> 
    <head> 
        <title>Bonjour</title> <!--Requiredmetatags --> 
        <meta charset="utf-8"> 
        <meta name="viewport"content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        <!--Bootstrap CSS --> 
        <link rel="stylesheet"href="bootstrap.min.css"> 
        <style>
            .btn{
                background-color: #2f3640 !important;
                color: #fbc531 !important;
                border: solid 2px transparent;
                transition: 0.5s;
            }
            .btn:hover{
                background-color: #fbc531 !important;
                color: #2f3640 !important;
                border: solid 2px #2f3640 ;
            }
            a{
                color: #2f3640;
            }
        </style>
    </head> 
    <body style="background:#2f3640;"> 
    <div class="container-fluid bg-warning">
    <nav class="navbar navbar-expand-lg navbar-light bg-warning"> 
            <div class="collapse navbar-collapse"id="navbarSupportedContent"> 
                <ul class="navbar-nav mr-auto bg-warning"> 
                    <li class="nav-item active"> <a class="nav-link"href="./index.php">Accueil </a> </li> 
                    <li class="nav-item"> <a style="background:#2f3640;color:white;margin-left:80px;"class="btn nav-link"href="create.php">Créer un étudiant</a> </li>
                    <li class="nav-item"> <a style="background:#2f3640;color:white;margin-left:30px;"class="btn nav-link"href="register.php">Créer un utilisateur</a> </li>
                    <li class="nav-item "> <a style="background:#2f3640;color:white;margin-left:800px;"class="btn nav-link"href="logout.php">Logout</a> </li> 
                </ul> 
            </div> 
        </nav>


    </div>