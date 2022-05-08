<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
    else{
      include('connexion.php');
      $login=$_SESSION["Login"];
      $req="select id from enseignant where login='$login'";
      $rs=$pdo->query($req);
      $ense=$rs->fetch();
    }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      
      " dans votre espace personnel";
      $id= $ense['id']; // 
      $_SESSION["id"]=$id; // on met dans $id l'id de l'ensenginant qu' il est connecté mn lpage login.php
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Walid SAAD">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR</title>
 
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
<script src="../assets/dist/js/jquery.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    
<link href="../assets/jumbotron.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body onLoad="document.fo.login.focus()">
    
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
        <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
          <a class="dropdown-item" href="EtudiantParGroupe.php">Etudiants par Groupe</a>
                <a class="dropdown-item" href="ajouterGroupe.php">Ajouter Groupe</a>
                <a class="dropdown-item" href="modifierGroupe.php">Modifier Groupe</a>
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
          <a class="dropdown-item" href="etatAbsence.html">État des absences pour un groupe</a>
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
      <h1 class="display-3"><?=  $bienvenue?></h1>
      <h2><?= $id ?></h2>
              <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://www.medianet.tn/assets/public/images/jpg/MEDIANET/ms3.jpg" style="height:450px; margin-bottom:20px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://scontent.ftun16-1.fna.fbcdn.net/v/t1.15752-9/279886673_326395089608079_5786698924157377530_n.jpg?_nc_cat=100&ccb=1-6&_nc_sid=ae9488&_nc_ohc=-vT_pO_eoz0AX9dNnc_&_nc_ht=scontent.ftun16-1.fna&oh=03_AVKPaBZKK_4XGwPtA8UmI6XohUipvQc1CKvLPuiMiIodpQ&oe=6299D65C" style="height:450px; margin-bottom:20px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://www.medianet.tn/assets/public/images/jpg/MEDIANET/ms2.jpg" style="height:450px; margin-bottom:20px;" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>      
      <p><a class="btn btn-primary btn-lg" href="mesGRP.php?code=<?=" + $id + "?>"  role="button">Mes Groupes &raquo;</a></p>
      
    </div>
  </div>

  <div class="container">
    
    <div class="row">
      <div class="col-md-4">
        <h2>INFO1</h2>
        <img src="https://scontent.ftun16-1.fna.fbcdn.net/v/t39.30808-6/278971074_4766915950086814_8286307605407257963_n.jpg?_nc_cat=109&ccb=1-6&_nc_sid=5cd70e&_nc_ohc=KTVbd54EDLwAX_FUAYW&_nc_ht=scontent.ftun16-1.fna&oh=00_AT86oiuGtkK6CjWsUshj6RHFnmGwhM2CKCPTQ5NA9MFbwg&oe=627AA456" style="height:140px;width:150px; margin-bottom:20px;" class="d-block w-100" alt="...">
        <p><a class="btn btn-primary btn-lg" href="info1.php?code=<?="+ $id + "?>" role="button">Voir les Groupes &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>INFO2</h2>
        <img src="https://scontent.ftun16-1.fna.fbcdn.net/v/t39.30808-6/278790098_1155258205324192_1131962617699472646_n.jpg?_nc_cat=111&ccb=1-6&_nc_sid=8bfeb9&_nc_ohc=emX0XWConHIAX_g3bc3&_nc_ht=scontent.ftun16-1.fna&oh=00_AT9hQbbJ4DFf-JhnXDGijXqLO4nermMsvQIFw0XxHtA0iQ&oe=627A7A5B" style="height:140px;width:150px; margin-bottom:20px;" class="d-block w-100" alt="...">
        <p><a class="btn btn-primary btn-lg" href="info2.php?code=<?="+ $id + "?>" role="button">Voir les Groupes &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>INFO3</h2>
        <img src="https://scontent.ftun16-1.fna.fbcdn.net/v/t39.30808-6/263756481_3077811565791361_6321135041168413955_n.jpg?_nc_cat=102&ccb=1-6&_nc_sid=825194&_nc_ohc=d5WDlv4FMCsAX-8DDQs&_nc_ht=scontent.ftun16-1.fna&oh=00_AT8PuPy-AK4h86Eh5w_SNVA7JSGdvdaJslQmobadualpng&oe=6279FB24" style="height:140px;width:150px; margin-bottom:20px;" class="d-block w-100" alt="...">
        <p><a class="btn btn-primary btn-lg" href="info3.php?code=<?="+ $id + "?>" role="button" >Voir les Groupes &raquo;</a></p>
      </div>
    </div>
    <hr>
    
  </div> 

</main>


<footer class="container">
  <p>&copy; ENICAR 2021-2022</p>
</footer>


  </body>
</html>
   
