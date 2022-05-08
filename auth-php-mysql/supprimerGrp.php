<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }

 
  else {
  $groupe=$_REQUEST['classe'];
  $id_ense=$_SESSION["id"];

  
  include("connexion.php");
           $sel=$pdo->prepare("select Classe from `enseignant_classe` where Classe=? and id_ense='$id_ense' limit 1");
           $sel->execute(array($groupe));
           $tab=$sel->fetchAll();
           if(count($tab)==0){
             // Aucun groupe
              $_SESSION["suppG"]="not ok";
              header("location:SupprimerGroupe.php");
           }
           else{
              $sel=$pdo->prepare("delete from `enseignant_classe` where Classe=?");
              $sel->execute(array($groupe));
              $sel=$pdo->prepare("delete from etudiant  where Classe=?");
              $sel->execute(array($groupe));
              //$erreur ="OK";
              $_SESSION["suppG"]="ok";
              header("location:SupprimerGroupe.php");
           } 
  }
      

      


    ?>


