<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
 else{
    include('connexion.php');
    $req="select DISTINCT  Classe  from etudiant ORDER BY Classe ASC";
    $sel=$pdo->query($req);


}
?>


<select id="slct" class="custom-select custom-select-sm custom-select-lg">
    
<?php while($row = $sel ->fetch(PDO::FETCH_ASSOC)) {?>
    <option value="<?= ($row['Classe'])?>">
        <?= $row['Classe']?>
    </option>

   <?php   }?>
   </select>