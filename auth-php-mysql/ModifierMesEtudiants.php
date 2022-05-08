<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
include("connexion.php");
$id_ense=$_SESSION["id"];
$req="SELECT * FROM `etudiant` WHERE Classe in(select Classe from `enseignant_classe` where id_ense=$id_ense )";  
$reponse = $pdo->query($req);
if($reponse->rowCount()>0) {
	$outputs["etudiants"]=array(); // c'est un dictionnaire comme python tq la clé sont etudiants,success,message et les valeur son de dictionnaire les clé cin ,nom.....
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
        $etudiant = array();
        $etudiant["cin"] = $row["cin"];
        $etudiant["nom"] = $row["nom"];
        $etudiant["prenom"] = $row["prenom"];
        $etudiant["adresse"] = $row["adresse"];
        $etudiant["email"] = $row["email"];
        $etudiant["classe"] = $row["Classe"];
         array_push($outputs["etudiants"], $etudiant);
    }
    // success
    $outputs["success"] = 1;
     echo json_encode($outputs);
} else {
    $outputs["success"] = 0;
    $outputs["message"] = "Pas d'étudiants";
    // echo no users JSON
    echo json_encode($outputs);
}
}
?>