<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
$groupe=$_REQUEST['classe'];
$nom=$_REQUEST['nom'];

include("connexion.php");
$req="update etudiant set Classe = '$nom' where Classe = '$groupe'";
                  
$reponse = $pdo->exec($req) or die("error");
header("location:ModifierGroupe.php");
}
?>