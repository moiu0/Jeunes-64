<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$email2=$_POST["email"];
		$mdp2=$_POST["mdp"];

    // Paramètres de connexion à la base de données
    $serveur = "localhost";  // Adresse du serveur MySQL
    $utilisateur = "root"; // Nom d'utilisateur MySQL
    $motDePasse = "root"; // Mot de passe MySQL
    $baseDeDonnees = "test"; // Nom de la base de données
    $table='utilisateurs';

    // Établir une connexion
    $connection = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
		
    // Vérification de la connexion
    if (!$connection) {
      die("Échec de la connexion : " . mysqli_connect_error());
    }

    // Requête SELECT pour récupérer les données de la table
    $query = "SELECT * FROM $table";
    $result = mysqli_query($connection, $query);

    // Vérification du résultat de la requête
    if ($result) {
        // Parcours des résultats avec une boucle
        while ($row = mysqli_fetch_assoc($result)) {
            // Accéder aux valeurs des colonnes
            $idp = $row['id'];
            $email = $row['email'];
            $mdp = $row['mdp'];
            $naissance = $row['naissance'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];

            if($email == $email2 && $mdp == $mdp2){ // si les indentifiants rentrés sont dans la base de donnée, renvoyer vers la page pour décrire engagement
              mysqli_close($connection);
              $lien = "accueiljeune.php?idp=" . urlencode($idp);  //renvoit les données du jeune inscrit
              header("Location: $lien");
            }
        }
    } else {
        echo "Erreur lors de la requête : " . mysqli_error($connection);
    }
  }
  $a=1;
  mysqli_close($connection);
  
?>

 <!DOCTYPE html>
<html>
<body>
<
<script>alert("connexion échouée");
  if($a == 1  ){
    
    <?php header("Location: index.html");?>
  }
  

</script>
  
</body>

</html> 

