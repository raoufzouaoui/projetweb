<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
    
    /// Groupes
    include("connexion.php");
    $id=$_SESSION["id"];
    $req="select Classe from enseignant_classe where id_ense='$id'";
    $reponse = $pdo->query($req);
    $outputs["groupes"] = array();
    if($reponse->rowCount()>0) {
        while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
            array_push($outputs["groupes"], $row);
        }
    }
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

        <!-- Custom styles for this template -->
        <link href="../assets/jumbotron.css" rel="stylesheet">

        <style>
            .erreur{
            color:red;
            position:center;
          }
          #input{width:170px;}
        </style>

</head>
<body>
<nav style="background-color: #1a2d53;color: white;font-size: 20px;" class="navbar navbar-expand-md navbar-dark fixed-top ">
    <a class="navbar-brand" href="#">SCO-Enicar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Groupes</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="afficherEtudiants.php">Lister tous les étudiants</a>
                    <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Etudiants par Groupe</a>
                    <a class="dropdown-item" href="AjouterGroupe.php">Ajouter Groupe</a>
                    <a class="dropdown-item" href="ModifierGroupe.php">Modifier Groupe</a>
                    <a class="dropdown-item" href="SupprimerGroupe.php">Supprimer Groupe</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Etudiants</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="ajouterEtudiant.php">Ajouter Etudiant</a>
                    <a class="dropdown-item" href="ChercherEtudiants.php">Chercher Etudiant</a>
                    <a class="dropdown-item" href="ModifierListeEtudiants.php">Modifier Etudiant</a>
                    <a class="dropdown-item" href="SupprimerListeEtudiants.php">Supprimer Etudiant</a>


                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
                    <a class="dropdown-item" href="etatAbsence.php">État des absences pour un groupe</a>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="deconnexion.php">Se Déconnecter <span class="sr-only">(current)</span></a>
            </li>

        </ul>


        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Saisir un groupe" aria-label="Chercher un groupe">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher Groupe</button>
        </form>
    </div>
</nav>
      
<main role="main">
        <div class="jumbotron">
            <div class="container">
              <h1 class="display-4">Modifier un Groupe</h1>
              <p>Taper le  Groupe à modifier!</p>
            </div>
          </div>

          <div class="container">
    <!-- TRAVAILLER ICI-->
    <form action="ModifierG.php" method="POST" id="myform">
    <h5 class="erreur"> <?php/* echo $erreur;*/?></h5>
                <div class="form-group">
                <select  id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">
                    <?php foreach($outputs["groupes"] as $tab): ?>
                        <option value="<?=$tab['Classe']?>"><?=$tab['Classe']?></option> 
                    <?php endforeach ?>
                </select>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="saisir un nouveau nom..." required pattern="INFO[1-3]{1}-[A-E]{1}"
                  title="Pattern INFOX-X. Par Exemple: INFO1-A, INFO2-E, INFO3-C">
                <button  type="submit" class="btn btn-primary btn-block" name="modifier">modifier</button>
                </div>
        </form>
    </div>

</main>
<footer class="container">
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>
</html>
<?php $erreur="";?>
