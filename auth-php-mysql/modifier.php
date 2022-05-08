<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
else {
    include("connexion.php");
      $sel=$pdo->prepare("SELECT * FROM etudiant WHERE cin=:num ");
        $sel->bindValue(':num',$_GET['code'],PDO::PARAM_INT);

        $executeIsOk= $sel->execute();

        $etudiant = $sel->fetch();

    
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
                <br>
              <h3 class="display-4">Modifier etudiant</h5>
              
            </div>
          </div>

          <div class="container">
<form id="myForm" method="POST" >
    <div class="form-group">
    <input type="hidden" id="cin" name="code" value="<?= $etudiant['cin']; ?> "  class="form-control" required/><br>
    </div>

    <div class="form-group">
    Nom:
    <br><input type="text" id="nom" name="nom" value="<?= $etudiant['nom']; ?> " class="form-control" required/><br>
    </div>

    <div class="form-group">
    Prenom:
    <br><input type="text" id="prenom" name="prenom" value="<?= $etudiant['prenom']; ?> " class="form-control" required/><br>
    </div>
    
    <div class="form-group">
    Mot de passe:
    <br><input type="password" id="pwd" name="pwd" value="<?= $etudiant['password']; ?> " class="form-control" required/><br>
    </div>
    
    <div class="form-group">
    Confirmer Mot de passe:
    <br><input type="password" id="cpwd" name="cpwd" value="<?= $etudiant['cpassword']; ?> " class="form-control" required/><br>
    </div>
    
    <div class="form-group">
    E-mail:
    <br><input type="email" id="email" name="email" value="<?= $etudiant['email']; ?> " class="form-control" required/><br>
    </div>
    
    <div class="form-group">
    Classe:
    <br><input type="text" id="classe" name="classe" value="<?= $etudiant['Classe']; ?> " class="form-control" required/><br>
    </div>
    
    <div class="form-group">
    Adresse:
    <br><input type="text" id="adresse" name="adresse"  value="<?= $etudiant['adresse']; ?> " class="form-control" required/><br>
    </div>
   
        <button type="submit" name="update" id="update"  class="btn btn-primary "> Modifier </button>
        <a href="afficherEtudiants.php">afficher liste des etudiants</a>
</form>



<script type="text/javascript">
        $(document).ready(function(){
                $("#update").click(function(event){
                    event.preventDefault(); /* rattachée à l'interface Event, indique à l'agent utilisateur que si l'évènement n'est pas explicitement géré,
                                             l'action par défaut ne devrait pas être exécutée comme elle l'est normalement. */
                    var nom=$("#nom").val();
                    var prenom=$("#prenom").val();
                    var email=$("#email").val();
                    var pwd=$("#pwd").val();
                    var cpwd=$("#cpwd").val();
                    var cin=$("#cin").val();
                    var classe=$("#classe").val();
                    var adresse=$("#adresse").val();

                    $.ajax({             // jQuery Ajax Request
                        url:"modif.php",
                        method:"post",
                        data:{nom:nom,prenom:prenom,email:email,pwd:pwd,cpwd:cpwd,cin:cin,adresse:adresse,classe:classe},
                        
                        success:function(data){
                            $('#message').html(data);
                            document.getElementById("message").style.backgroundColor="green";
                        }
                    });
                });
            });

</script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

  <p id="message"></p>
        </div>
</body>
</html>