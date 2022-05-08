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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Afficher Etudiants</title>
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="../assets/dist/js/jquery.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="../assets/jumbotron.css" rel="stylesheet">

    <style>
      #search{
     
     padding:15px;
     border-radius: 10px;
     width:50%;
   }
        h1 {
            border-bottom: 3px solid #1a2d53;
            color: #1a2d53;
            font-size: 30px;
        }
        table, th , td {
            border: 1px solid grey;
            border-collapse: collapse;
            padding: 5px;
        }
        table tr:nth-child(odd) {
            background-color: #f1f1f1;
        }
        table tr:nth-child(even) {
            background-color: #ffffff;
        }
    </style>

</head>
<body onload="refresh()">
  <nav style="background-color: #1a2d53;color: white;font-size: 20px;" class="navbar navbar-expand-md navbar-dark fixed-top ">
    <a class="navbar-brand" href="index.php">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                <a class="dropdown-item" href="EtudiantParGroupe.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="#">Ajouter Groupe</a>
                <a class="dropdown-item" href="#">Modifier Groupe</a>
                <a class="dropdown-item" href="supprimerGroupe.php">Supprimer Groupe</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                <a class="dropdown-item" href="chercherEtudiant.php">Chercher Etudiant</a>
                <a class="dropdown-item" href="modifierEtudiant.php">Modifier Etudiant</a>
                <a class="dropdown-item" href="supprimerEtudiant.php">Supprimer Etudiant</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="saisirabsence.php">Saisir Absence</a>
                <a class="dropdown-item" href="/mini-projet-info1/etatAbsence.html">État des absences pour un groupe</a>
              </div>
            </li>
      
            <li class="nav-item active">
              <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
          <form methode="GET" action="chercherGroupe.php"  class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="s" placeholder="Saisir un groupe" aria-label="Chercher un groupe" required id="search" autocomplete="off">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
          </form>
        </div>
      </nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
                <br>
                <br>
                <h1><?= $bienvenue ?></h1>
                
              <h5 class="display-4">supprimer des groupes</h5>
              
            </div>
          </div>

<div class="container">
<div class="row">
<div class="table-responsive"> 







<h1 style="color:black">Liste des classe </h1>
<br>

<form action="supprimerGrp.php" methode="GET" id="myform">
<select  id="classe" name="classe" class="form-control" required >
       <?php foreach($outputs["groupes"] as $tab): ?>
          <option value="<?= $tab['Classe'] ?>" ><?= $tab['Classe'] ?></option>
       <?php endforeach ?>
       </select>
       <button type="submit" name="supprimer" onclick="confirm('are you sure')" >supprimer</button>
</form>





</body>
</html>