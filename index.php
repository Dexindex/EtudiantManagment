<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

require 'db.php';
$sql = 'SELECT * FROM etudiant';
$statement = $connection->prepare($sql);
$statement->execute();
$etudiant = $statement->fetchAll(PDO::FETCH_OBJ);
// Utilisateur Liste :

$sql2 = 'SELECT * FROM users';
$statement1 = $connection->prepare($sql2);
$statement1->execute();
$users = $statement1->fetchAll(PDO::FETCH_OBJ);

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Tous les étudiants</h2>
            <form action="search.php" method="get">
                <div class="input-group mb-3">
                    <label for="search-query" class="visually-hidden">Recherche</label>
                    <input type="text" id="search-query" class="form-control" name="q" placeholder="Recherche" aria-label="Recherche">
                    <button type="submit" class="btn btn-primary">Recherche</button>
                </div>
            </form>

        </div>
        <div class="card-body">
            <table class="table table-bordered" style="background:#c8d6e5;">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Classe</th>
                    <th>Moyenne</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($etudiant as $person) : ?>
                    <tr>
                        <td><?= $person->id; ?></td>
                        <td><?= $person->nom; ?></td>
                        <td><?= $person->email; ?></td>
                        <td><img src="<?= $person->image_path; ?>" width="80px" height="80px" style="border-radius: 50%;border:solid 4px #111;"></td>
                        <td><?= $person->Classe; ?></td>
                        <td><?= $person->Moyenne; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $person->id ?>" class="btn btn-success">Edit</a>

                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<br><br>
<hr><br><br>

<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Tous les Utilisateurs</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><img src="<?= $user->image; ?>" width="80px" height="80px" style="border-radius: 50%;border:solid 4px #111;"></td>
                        <td>
                            <a href="edituser.php?id=<?= $user->id ?>" class="btn btn-success">Edit</a>

                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')" href="deluser.php?id=<?= $user->id ?>" class='btn btn-danger'>Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>