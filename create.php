<?php 

session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}
require 'db.php'; 

$message = ''; 

if(isset($_POST['nom']) && isset($_POST['email']) && isset($_FILES['image']) && isset($_POST['Classe']) && isset($_POST['Moyenne']) ) { 
    $nom = $_POST['nom']; 
    $email = $_POST['email'];
    $image = $_FILES['image']['name']; 
    $image_path = 'uploads/'.$image; // path to store the image
    $Classe = $_POST['Classe'];
    $Moyenne = $_POST['Moyenne'];
    $sql = 'INSERT INTO etudiant(nom, email, image_path,Classe,Moyenne) VALUES(:nom, :email, :image_path,:Classe,:Moyenne)'; 
    $statement = $connection->prepare($sql); 
    if($statement->execute([':nom'=> $nom, ':email'=> $email , ':image_path'=> $image_path, ':Classe'=> $Classe, ':Moyenne'=> $Moyenne])) 
    { 
        // move the uploaded image to the uploads folder
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        $message = 'Donnée créée avec succès'; 
    } 
}
?> 

<?php require 'header.php'; ?> 

<div class="container"> 
    <div class="card mt-5"> 
        <div class="card-header"> 
            <h2>Créer un étudiant</h2> 
        </div> 
        <div class="card-body"> 
            <?php if(!empty($message)): ?> 
                <div class="alert alert-success"> 
                    <?= $message; ?> 
                </div> 
            <?php endif; ?> 
            <form method="post" enctype="multipart/form-data"> 
                <div class="form-group mb-3"> 
                    <label for="nom">Nom</label> 
                    <input type="text" name="nom" id="nom" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="email">Email</label> 
                    <input type="email" name="email" id="email" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="image">Image</label> 
                    <input type="file" accept="image/*" name="image" id="image" class="form-control"> 
                </div>
                <div class="form-group mb-3"> 
                    <label for="email">Classe</label> 
                    <input type="text" name="Classe" id="email" class="form-control"> 
                </div>
                <div class="form-group mb-3"> 
                    <label for="email">Moyenne</label> 
                    <input type="text" name="Moyenne" id="email" class="form-control"> 
                </div>
                <div class="form-group mt-5"> 
                    <button type="submit" class="btn">Créer un étudiant</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div>