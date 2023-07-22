<?php 
require 'header.php'; 
require 'db.php'; 

$message = ''; 

if(isset($_POST['email']) && isset($_POST['password']) ) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM users WHERE email = :email OR username = :email';
    $statement = $connection->prepare($sql);
    $statement->execute([':email' => $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Compare hashed password with password entered in login form
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
                echo '<div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> Incorrect email or password.
                    </div>';

        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> No User Found.
                    </div>';
    }
    } 
?>

<div class="container"> 
    <div class="card mt-5"> 
        <div class="card-header"> 
            <h2>Login</h2> 
        </div> 
        <div class="card-body">
            <form method="post" enctype="multipart/form-data"> 
                <div class="form-group mb-3"> 
                    <label for="nom">Email</label>
                    <input type="email" name="email" id="email" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="email">Mot de passe</label> 
                    <input type="password" name="password" id="password" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <a href="register.php">Vous n'avez pas de compte créez-en un maintenant.</a>
                </div> 

                <div class="form-group mt-5"> 
                    <button type="submit" name="" class="btn">Login</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div>