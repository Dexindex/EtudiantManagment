<?php 
require 'header.php'; 
require 'db.php'; 

$message = ''; 

if(isset($_POST['email']) && isset($_POST['username']) && isset($_FILES['image']) && isset($_POST['password']) ) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $image = $_FILES['image']['name'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $image_path = 'uploads/'.$image; // chemin pour stocker l'image 
    $sql = 'INSERT INTO users(email, username, password,image) VALUES(:email, :username,:hash, :image_path)'; 
    $statement = $connection->prepare($sql); 
    try { 
        $statement->execute([':email'=> $email, ':username'=> $username , ':image_path'=> $image_path, ':hash'=> $hash]); 
        // déplacer l'image téléchargée vers le dossier uploads 
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path); 
        echo '<div class="alert alert-success" role="alert"> Créé avec succès </div>'; 
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo '<div class="alert alert-danger" role="alert"> Ce nom d\'utilisateur/email est déjà pris </div>'; 
        } else { 
            echo '<div class="alert alert-danger" role="alert"> Erreur : '.$e->getMessage().' </div>'; 
        } 
    } 
} 
?>

<div class="container"> 
    <div class="card mt-5"> 
        <div class="card-header"> 
            <h2>Inscription</h2> 
        </div> 
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"> 
                <div class="form-group mb-3"> 
                    <label for="nom">Email</label>
                    <input type="email" name="email" id="email" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="email">Nom d'utilisateur</label> 
                    <input type="text" name="username" id="username" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="image">Image</label> 
                    <input type="file" accept="image/*" name="image" id="image" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="email">Mot de passe</label> 
                    <input type="password" name="password" id="password" class="form-control"> 
                </div> 
                <div class="form-group mt-5"> 
                    <button type="submit" class="btn">S'inscrire</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div>