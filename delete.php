<?php 

session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
}

require'db.php'; 
$id = $_GET['id']; 
$sql = 'DELETE FROM etudiant WHERE id=:id'; 
$statement= $connection->prepare($sql); 

if($statement->execute([':id'=> $id])) 
{ 
    header("Location: ./index.php"); 
}
