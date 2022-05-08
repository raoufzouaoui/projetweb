<?php
    //
    $daty=date("d-m-Y");//Date actulle 
    echo $daty;//afficher une date
    
   $strDate=date_create($daty);//Créer un objet Date à partir de la variable $date(chaine) il faut le format -
    echo "<br>";                // Il faut que la date en parametre est en format "-" mais pas "/"
    
    //echo date("d/m/Y",strtotime($daty));//Pour modifier le format d'une date 
   
   
    // print_r( $strDate);//Afficher un objet Date impossible avec echo
   
     echo "<br>";
    $date=date_create("2013-03-15");//Créer un objet date en donnant la date
    //print_r($date);
    echo "<br>";
    //echo "<br>La date donnée:".$date."<br>";
    date_sub($strDate,date_interval_create_from_date_string("1 days"));//soustraire une date de 1 jour
    $datte=date_format($strDate,"d/m/Y");//Afficher la nouvelle date avec mise en jour en donnant le format
    echo $datte;
    echo "<br>";
    //print_r( $strDate);// La variable va changer
    echo "--------------------------------------------------------";
    //


@$semaine=$_POST["debut"];
    echo "<br> La semaine choisie est :".$semaine."<br>";
    $week="2022"."-W15";
    echo $week;
    $FirstDate=date("d-m-Y",strtotime($semaine));
    $Date=date_create($FirstDate);
    print_r($Date);
    echo "<br> La 1re date de cette semaine est:".$FirstDate."<br>";
    $secodDate=date_add($Date,date_interval_create_from_date_string("2 days"));
    echo "<br>La  date du 2e jour après est:".date_format($Date,"d/m/Y")."<br>";
    $Lundi=date("d/m/Y",strtotime("this week"));
    $NLundi=date("d/m/Y",strtotime("next week"));
    $NDimanche=date("d/m/Y",strtotime("sunday next week"));
    $Dimanche=date("d/m/Y",strtotime("sunday this week"));
    echo "<br>Cette semaine commen le Lundi le :".$Lundi." à ".$Dimanche;
    echo "<br>La prochaine semaine  commencera le Lundi le :".$NLundi." à ".$NDimanche;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Date</title>
</head>
<body>
    <h3>Nous sommes :<?php echo date("d/m/y h:i:s")?></h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="semaine">Choisir une semaine:</label><br>
            <input id="semaine" type="week" name="debut" size="10" class="datepicker"/>
            <button type="submit" name="submit">Valider</button>
        </div>
    </form>
    <div> </div>
</body>
</html>