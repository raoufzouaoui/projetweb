<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }else{
   
   
        if(date("H")<18)
        $bienvenue="Bonjour et bienvenue ".
        $_SESSION["prenomNom"].
        " dans votre espace personnel";
        else
        $bienvenue="Bonsoir et bienvenue ".
        $_SESSION["prenomNom"].
        " dans votre espace personnel";


       include('connexion.php');
       $login=$_SESSION["Login"];
       $query="SELECT * FROM `etudiant` WHERE Classe in(select Classe from `enseignant_classe` where Classe LIKE 'INFO3%'AND id_ense in (select id from enseignant where login='$login'))" ;
       $allGroups=$pdo->query($query);
   
   
    
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
<body>
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
                <a class="dropdown-item" href="ajoutergroupe.php">Ajouter Groupe</a>
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
                <h1><?= $bienvenue ?></h1>
              <h5 class="display-4">Mes etudiants INFO3</h5>
              
            </div>
          </div>

<div class="container">
<div class="row">
<div class="table-responsive"> 
    
    

  <br>




    <?php 
       if($allGroups->rowCount()>0){
        ?>
        
        <br>
        <table class='table table-striped table-hover'>
            <th>
            <tr>
            <th>CIN</th>
            <th>NOM</th>
            <th>prenom</th>
            <th>adresse</th>
            <th>email</th> 
            <th>classe</th>
    </tr>
    </th>
    <td>
        <?php
        while($row = $allGroups ->fetch(PDO::FETCH_ASSOC)){
           /* $cin=$row['cin'];
            $nom=$row['nom'];
            $prenom=$row['prenom'];
            $email=$row['email'];
            $adresse=$row['adresse']; */
           

       
        ?>
           <tr>
            <td><?php echo $row["cin"];?> </td>
                <td><?php echo $row["nom"];?> </td>
                <td><?= $row["prenom"];?> </td>
                <td><?php echo $row["adresse"];?> </td>
                 <td><?php echo $row["email"];?> </td>
                <td><?php echo $row["Classe"];?> </td>
        <?php
        }
        ?>
    </td>
    </table>
    <?php

    }else{
        echo "<h6 class='text-danger text-center mt-3'>aucun groupe trouvé</h6>";
    }
}



?>
    

</body>
</html>


