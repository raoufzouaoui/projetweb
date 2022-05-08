<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {




include("connexion.php");
         
         $classe=$_REQUEST['classe'];
         
         $id_ense=$_SESSION["id"]; //on va recuperer l id de lensengenant qui est connecté maintenant
         
         
         // on fait sa pour tester si le classe exsiste dans le table ou non 
         $sel=$pdo->prepare("select Classe,id_ense from enseignant_classe where Classe=? and id_ense=? limit 1 "); // le point d'interrogation en le remplace par la valeur que on va execute
         $sel->execute(array($classe,$id_ense));
         $tab=$sel->fetchAll();
         if(count($tab)>0)
            $erreur="NOT OK";// groupe existe déja
         else{
            $req="insert into enseignant_classe values ($id_ense,'$classe')";
            $reponse = $pdo->exec($req) or die("error");
            $erreur ="OK";
         }
         echo $erreur;
         
              }     
?>
