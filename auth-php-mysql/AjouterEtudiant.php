<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
    else{
      include('connexion.php');
      $id_ense=$_SESSION["id"];
      $req="select * from `enseignant_classe` where id_ense='$id_ense'";
      $reponse = $pdo->query($req);
if($reponse->rowCount()>0) {
	$outputs["groupes"]=array(); // c'est un dictionnaire comme python tq la clé sont etudiants,success,message et les valeur son de dictionnaire les clé cin ,nom.....
while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
        $etudiant = array();
        $etudiant["id_ense"] = $row["id_ense"];
        $etudiant["Classe"] = $row["Classe"];
         array_push($outputs["groupes"], $etudiant); // inserer dans dictionnaire "groupes" les valeur de tableau $etudiant
    }
    // success
    $outputs["success"] = 1;
     echo json_encode($outputs);
} else {
    $outputs["success"] = 0;
    $outputs["message"] = "Pas d'étudiants";
    }
  }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter Etudiant</title>
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="../assets/dist/js/jquery.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/jumbotron.css" rel="stylesheet">

    
     <style>
    h1{
        border-bottom: 3px solid #1a2d53;
        color: #1a2d53;
        font-size: 30px;
    }
    </style>  
</head>
<body>
<nav style="background-color: #1a2d53;color: white;font-size: 20px;" class="navbar navbar-expand-md navbar-dark fixed-top ">
      <a class="navbar-brand" href="index.php">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/mini-projet-info1/auth-php-mysql/index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/mini-projet-info1/auth-php-mysql/index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="/mini-projet-info1/auth-php-mysql/afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="EtudiantParGroupe.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="#">Modifier Groupe</a>
                <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="/mini-projet-info1/auth-php-mysql/ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="/mini-projet-info1/auth-php-mysql/chercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="/mini-projet-info1/auth-php-mysql/modifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="/mini-projet-info1/auth-php-mysql/supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="etatAbsence.html">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="/mini-projet-info1/auth-php-mysql/deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form methode="GET" action="chercherGroupe.php"  class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="s" placeholder="Saisir un groupe" aria-label="Chercher un groupe" id="search" autocomplete="off">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
                <br>
                <br>
              <h1 ><?php echo $bienvenue?></h1>
              <br>
              
              <h3 class="display-4">Ajouter un etudiant</h3>
            </div>
          </div>


<div class="container">
<p>
    <form id="myForm" method="POST">
   <!--
                        TODO: Add form inputs
                        Prenom - required string with autofocus
                        Nom - required string
                        Email - required email address
                        CIN - 8 chiffres
                        Password - required password string, au moins 8 letters et chiffres
                        ConfirmPassword
                        Classe - Commence par la chaine INFO, un chiffre de 1 a 3, un - et une lettre MAJ de A à E
                        Adresse - required string
                    -->
     <!--Nom-->
     <div class="form-group">
     <label for="nom">Nom:</label><br>
     <input type="text" id="nom" name="nom" class="form-control" required autofocus>
    </div>
   <!--Prénom-->
   <div class="form-group">
     <label for="prenom">Prénom:</label><br>
     <input type="text" id="prenom" name="prenom" class="form-control" required>
    </div>
   <!--CIN-->
   <div class="form-group">
     <label for="cin">CIN:</label><br>
     <input type="text" id="cin" name="cin"  class="form-control" required pattern="[0-9]{8}" title="8 chiffres"/>
    </div>
   <!--Password-->
   <div class="form-group">
     <label for="pwd">Mot de passe:</label><br>
     <input type="password" id="pwd" name="pwd" class="form-control"  required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres"/>
    </div>
    <!--ConfirmPassword-->
    <div class="form-group">
        <label for="cpwd">Confirmer Mot de passe:</label><br>
        <input type="password" id="cpwd" name="cpwd" class="form-control"  required/>
    </div>
     <!--Email-->
     <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" class="form-control" required>
       </div>
    <!--Classe-->
    <div class="form-group">
     <label for="classe">Classe:</label><br>
     <select  id="classe" name="classe" class="form-control" required >
       <?php foreach($outputs["groupes"] as $tab): ?>
          <option value="<?= $tab['Classe'] ?>" ><?= $tab['Classe'] ?></option>
       <?php endforeach ?>
       </select>
    </div>
    <!--Adresse-->
    <div class="form-group">
     <label for="adresse">Adresse:</label><br>
     <textarea id="adresse" name="adresse" rows="10" cols="30" class="form-control" required>
     </textarea>
    </div>
     <!--Bouton Ajouter-->
     <button  type="button" onclick="ajouter()" class="btn btn-primary btn-block">Ajouter</button>
    
</form>
</p>
<div id="demo"></div>
<script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini-projet-info1/auth-php-mysql/ajouter.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);

        //Traiter Res

        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    </script>
</body>
</html>