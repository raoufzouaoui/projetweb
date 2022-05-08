<?php
    
    session_start();
    if($_SESSION["autoriser"]!="oui"){
    header("location:login.php");
    exit();
    }
    else{
    include("connexion.php");
        if(isset($_GET['input'])){
            $input=$_GET['input'];
            $query="SELECT * FROM etudiant WHERE cin LIKE '{$input}%'";
            $result = $pdo->query($query); // La fonction query() combine l'exécution de la requête avec une récupération de son jeu de résultats en mémoire tampon, s'il y en a un, en un seul appel.

            if($result->rowCount()>0){
                ?>
                <table class='table table-striped table-hover'>
                    <th>
                    <tr>
                    <th>CIN</th>
                    <th>NOM</th>
                    <th>prenom</th>
                    <th>email</th>
                    <th>classe</th>
            </tr>
            </th>
            <td>
                <?php
                while($row = $result ->fetch(PDO::FETCH_ASSOC)){
                    $cin=$row['cin'];
                    $nom=$row['nom'];
                    $prenom=$row['prenom'];
                    $email=$row['email'];
                    $Classe=$row['Classe'];

               
                ?>
                    <tr>
                        <td><?php echo $cin;?> </td>
                        <td><?php echo $nom;?> </td>
                        <td><?php echo $prenom;?> </td>
                        <td><?php echo $email;?> </td>
                        <td><?php echo $Classe;?> </td>
                <?php
                }
                ?>
            </td>
            </table>
            <?php

            }else{
                echo "<h6 class='text-danger text-center mt-3'>aucun etudiant trouvé</h6>";
            }
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