<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

require 'db.php';

$res = isset($_GET['q']) ? $_GET['q'] : '';
$sql = 'SELECT * FROM etudiant WHERE nom LIKE :res OR email LIKE :res ORDER BY nom';
$statement = $connection->prepare($sql);
$statement->execute([':res'=> '%'.$res.'%']);
$etudiant = $statement->fetchAll(PDO::FETCH_OBJ);

try {
    // Display any exceptions that might arise during the execution of the code
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}

?>

<?php require 'header.php'; ?>
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2>Résultat</h2>
            <form action="search.php" method="get">
                <div class="input-group mb-3">
                    <label for="search-query" class="visually-hidden">Recherche</label>
                    <input type="text" id="search-query" class="form-control" name="q" placeholder="Recherche" aria-label="Recherche">
                    <button type="submit" class="btn btn-primary">Recherche</button>
                </div>
            </form>

        </div>
        <div class="card-body">
            <table class="table table-bordered">
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
                            <a href="edit.php?id=<?= $person->id ?>" class="btn btn-success">Modifier</a>

                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>