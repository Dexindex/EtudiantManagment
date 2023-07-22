<?php 
require 'db.php';

session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

$id = $_GET['id']; 
$sql = 'SELECT * FROM etudiant WHERE id=:id'; 
$statement= $connection->prepare($sql); 
$statement->execute([':id'=> $id ]); 
$person = $statement->fetch(PDO::FETCH_OBJ); 

if(isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['Classe']) && isset($_POST['Moyenne']) ) { 
    $nom = $_POST['nom']; 
    $email = $_POST['email'];
    $Classe = $_POST['Classe'];
    $Moyenne = $_POST['Moyenne'];

    $image_path = $person->image_path; // keep the current image path
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) { // check if a new image has been uploaded
        $image = $_FILES['image']['name']; 
        $image_path = 'uploads/'.$image; // set the new image path
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path); // move the uploaded image to the uploads folder
    }

    $sql = 'UPDATE etudiant SET nom=:nom, email=:email, image_path=:image_path, Classe=:Classe,Moyenne=:Moyenne WHERE id=:id'; 
    $statement= $connection->prepare($sql); 
    if($statement->execute([':nom'=> $nom, ':email'=> $email, ':image_path' => $image_path, ':id' => $id, ':Classe'=> $Classe, ':Moyenne'=> $Moyenne])) { 
        header("Location: ./index.php"); 
    } 
} 
?>
<?php require 'header.php'; ?> 
<div class="container"> 
    <div class="card mt-5"> 
        <div class="card-header"> 
            <h2>Mise à jour d'un étudiant</h2> 
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
                    <input value="<?= $person->nom; ?>" type="text" name="nom" id="nom" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="email">Email</label> 
                    <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="image">Image</label> 
                    <input type="file" accept="image/*" name="image" id="image" class="form-control mb-3"> 
                </div>
                <div class="form-group mb-3"> 
                    <label for="nom">Classe</label> 
                    <input value="<?= $person->Classe; ?>" type="text" name="Classe" id="Classe" class="form-control"> 
                </div> 
                <div class="form-group mb-3"> 
                    <label for="nom">Moyenne</label> 
                    <input value="<?= $person->Moyenne; ?>" type="text" name="Moyenne" id="Moyenne" class="form-control"> 
                </div> 
                <div class="form-group"> 
                    <button type="submit" class="btn btn-info">Mise à jour d'un étudiant</button> 
                </div> 
            </form> 
        </div> 
    </div> 
</div>