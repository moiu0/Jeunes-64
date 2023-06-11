
<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){


    

  //récupération des données
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mdp = $_POST["mdp"];
    $naissance = $_POST["naissance"];
    $email = $_POST["email"];
    
    

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

  

  // Requête pour vérifier si la table existe
  $query = "SHOW TABLES LIKE '$table'";
  $result = mysqli_query($connection, $query);

  

  // Vérification du résultat de la requête
  if (mysqli_num_rows($result) != 0) {
      echo "La table $table existe.";
  } 
  else {
      echo "La table $table n'existe pas.";
      $query = "CREATE TABLE utilisateurs (
      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      nom VARCHAR(30) NOT NULL,
      prenom VARCHAR(30) NOT NULL,
      mdp VARCHAR(30) NOT NULL,
      naissance VARCHAR(30) NOT NULL,
      email VARCHAR(50) NOT NULL,
      date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )"; 

    // Exécution de la requête CREATE TABLE
    $result = mysqli_query($connection, $query); // Utilisez votre variable de connexion appropriée
    
    // Vérification du résultat de la requête
    if ($result) {
        echo "La table a été créée avec succès.";
    } else {
        echo "Erreur lors de la création de la table : " . mysqli_error($connection);
    }
  }

  // requête d'insertion
  $insertQuery = "INSERT INTO utilisateurs (nom, prenom, mdp, naissance, email) VALUES ('$nom', '$prenom', '$mdp', '$naissance', '$email')";

  // Exécution de la requête d'insertion
  $insertResult = mysqli_query($connection, $insertQuery);

  header("Location: index.html");
  }
?>



