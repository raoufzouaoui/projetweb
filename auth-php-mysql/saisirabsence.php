

<?php
    session_start();
    @$valider=$_POST["valider"];
    @$semaine=$_POST["debut"];
    @$classe=$_POST["classe"];
    @$matiere=$_POST["module"];
    if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
    }
    else{
      $id_ense=$_SESSION["id"];
      $_SESSION["classeS"]=$classe;
      $_SESSION["envoyer"]=$valider;
      $_SESSION["semaine"]=$semaine;
      $_SESSION["matiere"]=$matiere;
      if(isset($valider)){
        $date=date("d-m-Y",strtotime($semaine));//Recuperer la 1re date de la semaine
        $_SESSION["date"]=$date;
      $Date=date_create($date);}
      //SPECIALE POUR OPTION DE SELECT
      include("connexion.php");
      $req="SELECT distinct Classe FROM enseignant_classe where id_ense=$id_ense order by Classe ASC ";
      $reponse = $pdo->query($req);
      if($reponse->rowCount()>0) {
          $outputs["groupes"]=array();
      while ($row = $reponse ->fetch(PDO::FETCH_ASSOC)) {
              $etudiant = array();
              $etudiant["Classe"] = $row["Classe"];
              array_push($outputs["groupes"], $etudiant);
          }
          // success
          $outputs["success"] = 1;
      } else {
          $outputs["success"] = 0;
          $outputs["message"] = "Pas d'étudiants";}
        //SPECIALE POUR OPTION DE SELECT
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>SCO-ENICAR Saisir Absence</title>
      <!-- Bootstrap core CSS -->
      <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="../assets/dist/js/jquery.min.js"></script>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/jumbotron.css" rel="stylesheet">
      <style>
        #input{width:170px;}
      </style>

</head>
<body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-color: #1a2d53;color: white;font-size: 20px;">
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
                    <a class="dropdown-item" href="ChercherEtudiant.php">Chercher Etudiant</a>
                    <a class="dropdown-item" href="ModifierEtudiant.php">Modifier Etudiant</a>
                    <a class="dropdown-item" href="SupprimerEtudiant.php">Supprimer Etudiant</a>
          
          
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Gestion des Absences</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="saisirAbsence.php">Saisir Absence</a>
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
                  <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
                  <p>Pour signaler, annuler ou justifier une absence, choisissez d'abord le groupe, le module puis l'étudiant concerné!</p>
                </div>
              </div>

    <div class="container">
    <form method="post">
        <div class="form-group">
          <label for="semaine">Choisir une semaine:</label><br>
          <input id="semaine" type="week" name="debut" size="10" class="datepicker" required/>
          <h4><?php //echo ($date."<br>");echo $semaine;?></h4>
        </div>
          <div class="form-group">
          <label for="classe">Choisir un groupe:</label><br>
          <select id="classe" name="classe"  class="custom-select custom-select-sm custom-select-lg">
          <?php foreach($outputs["groupes"] as $tab): ?>
                <option value="<?=$tab['Classe']?>"><?=$tab['Classe']?></option> 
            <?php endforeach ?>
              <!-- <option value="INFO1-A">1-INFOA</option>
              <option value="INFO1-B">1-INFOB</option>
              <option value="INFO1-C">1-INFOC</option>
              <option value="INFO1-D">1-INFOD</option>
              <option value="INFO1-E">1-INFOE</option>
              <option value="INFO2-A">2-INFOA</option>
              <option value="INFO2-B">2-INFOB</option>
              <option value="INFO2-C">2-INFOC</option>
              <option value="INFO2-D">2-INFOD</option>
              <option value="INFO2-E">2-INFOE</option>
              <option value="INFO3-A">3-INFOA</option>
              <option value="INFO3-B">3-INFOB</option>
              <option value="INFO3-C">3-INFOC</option>
              <option value="INFO3-D">3-INFOD</option> -->
          </select>
        </div>
        <div class="form-group">
          <label for="module">Choisir un module:</label><br>
          <select id="module" name="module"  class="custom-select custom-select-sm custom-select-lg">
              <option value="Web">Web</option>
              <option value="BD">BD</option>
              <option value="C++">Programmation</option>
              <option value="UML">UML</option>
              <option value="Maths">Maths</option>
              <option value="ANG">ANG</option>
          </select>
        </div>
        <!--Bouton Valider-->
        <button  type="submit" class="btn btn-primary btn-block" name="valider">OK</button>
    </form>
    <br>
    <div class="row">
        <div class="table-responsive" id="demo">Liste vide </div>
        <h4><?php //print_r($Date);?></h4>
          <button  type="boutton" class="btn btn-primary btn-block active"  onclick="refresh()">Actualiser</button>
        </div>  
    </div>


    <!-- <form action="">
        <table rules="cols" frame="box">
            <tr><th>25 étudiants</th>
            
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Lundi</th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th>
              </tr><tr><td>&nbsp;</td>
              <th colspan="2" width="100px"  style="padding-left: 5px; padding-right: 5px;"><?php echo date("d/m/Y",strtotime($date));?></th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>
              <th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>
              </tr><tr><td>&nbsp;</td>
              <th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>
            </tr>
          <tr class="row_3"><td><b>M. WALID SAAD</b></td>
            <td><input type="checkbox">Abs <input type="checkbox">jus</td>
            <td><input type="checkbox">Abs <input type="checkbox">jus</td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <?php // ?>
          </tr>

          <tr class="row_3"><td><b>M. TORIEN</b></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
            <td><input type="checkbox"></td>
          </tr>
        </table>
        <br>
    </form> -->



    <h4><?php echo ($date."<br>");echo $semaine;?></h4>
    </div>  
    </main>

<script>
    function refresh() {
        var xmlhttp = new XMLHttpRequest();
        var url = "http://localhost/mini-projet-info1/auth-php-mysql/saisir.php";

    //Envoie de la requete
	xmlhttp.open("GET",url,true);
	xmlhttp.send();


     //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    //alert(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }
            


    //Parse la reponse JSON
	function myFunction(response){
		var obj=JSON.parse(response);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
    var sortie='<h6>Fiche d\'abscence </h6> <br>';
        sortie+='<h5>Groupe: '+arr[0].classe+'\t'+'\t'+' Module: '+obj.matiere+'</h5> <br>';
    sortie+='<form action="" method="post" id="MYFORM"><table name=\"tab\" rules="cols" frame="box"  ><tr><th> '+arr.length +' étudiants</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Lundi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th><th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th></tr>';
    sortie+='<tr><td>&nbsp;</td>';
    sortie+='<th colspan="2" width="100px"  style="padding-left: 5px; padding-right: 5px;"><?php echo date("d/m/Y",strtotime($date));?></th>';
    sortie+=   '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(date_sub($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>';
    sortie+=  '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>';
    sortie+=  '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>';
    sortie+=  '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>';
    sortie+=  '<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;"><?php echo date_format(Date_add($Date,date_interval_create_from_date_string("1 days")),"d/m/Y");?></th>';
    sortie+=  '</tr><tr><td>&nbsp;</td>';
    sortie+=  '<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>';
    sortie+='</tr>';
    for ( i = 0; i < arr.length; i++) {
      sortie+='<tr class="row_3"><td><b>'+
      arr[i].cin+"   | "+
      arr[i].nom +
      " "+
      arr[i].prenom+
      '</b></td>'+
      '<td><input type="checkbox"></td>'+
      '<td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td></tr>';
    }
    var out="<table  border=1 class='table table-striped table-hover'> <tr><th>CIN</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Email</th><th>Classe</th></tr>";
		for ( i = 0; i < arr.length; i++) {
			out+="<tr><td>"+
			arr[i].cin +
			"</td><td>"+
			arr[i].nom+
			"</td><td>"+
			arr[i].prenom+
			"</td><td>"+
			arr[i].adresse+
			"</td><td>"+
			arr[i].email+
            "</td><td>"+
			arr[i].classe+
			"</td></tr>" ;
		}
    sortie+="</table>"
    +
    "<button type='submit'onclick='ajouter()' style='margin-top:17px;margin-bottom:17px;' class='btn btn-primary btn-block' name='envoyer'>envoyer</button>"
    +"</form>";
		out +="</table>"

		document.getElementById("demo").innerHTML=sortie;
       }
       else document.getElementById("demo").innerHTML="AUCUN ETUDIANT DE CETTE CLASSE";

    }
 }
</script>
<script>
   function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/mini-projet-info1/auth-php-mysql/ajoutermatiere.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("MYFORM");
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
</script>
    <footer class="container">
        <p>&copy; ENICAR 2021-2022</p>
      </footer>
</body>
</html>


