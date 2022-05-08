<?php
 session_start();
 if($_SESSION["autoriser"]!="oui"){
	header("location:login.php");
	exit();
 }
 else{
    include('connexion.php');
    @$code=$_GET['code'];
    $query="select  * from etudiant where Classe='$code'";
    $s=$pdo->query($query);
}
?>

<br>
<br>

   <table class='table table-striped table-hover'>
   <th>
      <tr>
      <th>CIN</th><th>NOM</th><th>PRENOM</th><th>EMAIL</th><th>ADRESS</th><th>CLASSE</th>
      </tr>
   </th>
   <?php while($p = $s ->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
         <td><?= ($p['cin']) ?></td>
         <td><?= ($p['nom']) ?></td>
         <td><?= ($p['prenom'])?></td>
         <td><?= ($p['email'])?></td>
         <td><?= ($p['adresse'])?></td>
         <td><?= ($p['Classe'])?></td>
      </tr>
   <?php  } ?>
</table>