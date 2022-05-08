<?php 
session_start();
if($_SESSION["autoriser"]!="oui"){
   header("location:login.php");
   exit();
}
else {
//ouverture d'une connexion à la bd etudiant
include("connexion.php");

$cin=$_POST["cin"];
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$password=$_POST["pwd"];
$cpassword=$_POST["cpwd"];
$email=$_POST["email"];
$adresse=$_POST["adresse"];
$classe=$_POST["classe"];


$sel="UPDATE etudiant SET  nom='$nom', prenom='$prenom',
password='$password', cpassword='$cpassword', email='$email', adresse='$adresse',
Classe='$classe' WHERE cin='$cin' ";
$rep=$pdo->query($sel);
if($rep){
    echo "mise à jour réussie";
}else{
    echo "echec de modification";
}

}
?>

