  <?php
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $idp = $_POST['id'];
    $reseau = $_POST['social'];
    $engagement= $_POST['engagement'];
    $debut_enga = $_POST['debut_enga'];
    $fin_enga = $_POST['fin_enga'];
    $millieu = $_POST['milieu'];
    $consultant= $_POST['email_cons'];
    $nom_ref= $_POST['nom_ref'];
    $prenom_ref = $_POST['prenom_ref'];
    $metier= $_POST['metier_ref'];
    $destinataire= $_POST['email_ref'];
    
    
    // Paramètres de connexion à la base de données
    $serveur = "localhost";  // Adresse du serveur MySQL
    $utilisateur = "root"; // Nom d'utilisateur MySQL
    $motDePasse = "root"; // Mot de passe MySQL
    $baseDeDonnees = "test"; // Nom de la base de données
    $table="EngagementJeune";
    
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
      // Requête SELECT pour récupérer les données de la table
      $query = "SELECT * FROM $table";
      $result = mysqli_query($connection, $query);
      // Vérification du résultat de la requête
      if ($result) {
        echo "table existe";
        $i=0; //variable pour compter les engagements d'une même personne
        // Parcours des résultats avec une boucle
        while ($row = mysqli_fetch_assoc($result)) {
          // Accéder aux valeurs des colonnes
          $reseau2 = $row['social'];
          $engagement2 = $row['engagement'];
          $debut_enga2 = $row['debut_enga'];
          $fin_enga2 = $row['fin_enga'];
          $millieu2 = $row['milieu'];
          $id = $row['idpersonne'];
          if( $engagement == $engagement2 && $debut_enga == $debut_enga2 && $fin_enga == $fin_enga2 && $millieu == $millieu2 ){ // si les indentifiants rentrés sont dans la base de donnée, renvoyer vers la page pour décrire engagement
            echo "engagement déjà créé";
            $temp=1;
          }
          if($id == $idp){
            $i++;
          }
        }
        
        if($temp != 1){
          echo "engagement pas créé";
          // requête d'insertion
          $i++;
          $b=0;
          $insertQuery = "INSERT INTO EngagementJeune (idpersonne, numeroEngagement, nom, prenom, email, social, engagement, debut_enga, fin_enga, milieu, nom_ref, prenom_ref, metier_ref, referentmail, consultant_mail, Envoit_consultant, Verif_consultant) VALUES ('$idp', '$i','$nom', '$prenom', '$email', '$reseau', '$engagement', '$debut_enga', '$fin_enga', '$millieu', '$nom_ref', '$prenom_ref', '$metier', '$destinataire', '$consultant', '$b', '$b')";

          // Exécution de la requête d'insertion
          $insertResult = mysqli_query($connection, $insertQuery);
        }
      }
    }

    else{
    // Requête pour vérifier si la table existe
      $query = "SHOW TABLES LIKE '$table'";
      $result = mysqli_query($connection, $query);
      // Vérification du résultat de la requête
      if (mysqli_num_rows($result) != 0) {
          echo "La table $table existe.";
      } 
      else {
          echo "La table $table n'existe pas.";
          $query = "CREATE TABLE EngagementJeune (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          idpersonne INT(6) NOT NULL,
          numeroEngagement INT(6) NOT NULL,
          nom VARCHAR(30) NOT NULL,
          prenom VARCHAR(30) NOT NULL,
          email VARCHAR(50) NOT NULL,
          social VARCHAR(50),
          engagement VARCHAR(1005) NOT NULL,
          debut_enga VARCHAR(50) NOT NULL,
          fin_enga VARCHAR(50) NOT NULL,
          milieu VARCHAR(50) NOT NULL,
          nom_ref  VARCHAR(50) NOT NULL,
          prenom_ref  VARCHAR(50) NOT NULL,
          metier_ref VARCHAR(50) NOT NULL,
          referentmail VARCHAR(50) NOT NULL,
          consultant_mail  VARCHAR(50) NOT NULL,
          Envoit_consultant INT(2),
          Verif_consultant INT(2)
          )"; 

        // Exécution de la requête CREATE TABLE
        $result = mysqli_query($connection, $query); // Utilisez votre variable de connexion appropriée
        
        // Vérification du résultat de la requête
        if ($result) {
            echo "La table a été créée avec succès.";
        } else {
            echo "Erreur lors de la création de la table : " . mysqli_error($connection);
        }
        $a=1;
        $b=0;
        // requête d'insertion
        $insertQuery = "INSERT INTO EngagementJeune (idpersonne, numeroEngagement, nom, prenom, email, social, engagement, debut_enga, fin_enga, milieu, nom_ref, prenom_ref, metier_ref, referentmail, consultant_mail, Envoit_consultant, Verif_consultant) VALUES ('$idp', '$a', '$nom', '$prenom', '$email', '$reseau', '$engagement', '$debut_enga', '$fin_enga', '$millieu', '$nom_ref', '$prenom_ref', '$metier', '$destinataire', '$consultant', '$b', '$b')";

        // Exécution de la requête d'insertion
        $insertResult = mysqli_query($connection, $insertQuery);
      }
    }

    
    // Requête pour sélectionner la dernière ligne
  $sql = "SELECT * FROM EngagementJeune ORDER BY id DESC LIMIT 1";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Récupération de la dernière ligne
      $row = $result->fetch_assoc();
      $id = $row['id'];
  } else {
      echo "La table est vide.";
  }
    
    
    $lien = "localhost/referent.php?idp=" . urlencode($idp) . "&id=" . urlencode($id);
    //envoit du message
    $message="<h2> SITE JEUNE 6.4</h2>";
    $message .="<p>Bonjour, " . $nom . " " . $prenom . " a envoyé une demande de référencement et vous, en tant que référent,<br>";
    $message .="nous avons besoin de vous pour nous indiquer des informations le concernant.</p>";
    $message .="<a href='" . $lien . "'>Cliquez ici pour rentrer les informations</a>";
    $headers = "From: projet.info.maxime@gmail.com\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n"; // Utilisez le type de contenu HTML
    if (mail($destinataire,'Jeunes 6.4',$message,$headers)){
    echo "mail envoyé";

    }else{
        echo "erreur";
    }
  ?>

  <!DOCTYPE html>
  <html>

  <head>
    
    <title>Bouton submit lien</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="Jeune2.css">
    <!-- On relie le code HTML avec le bon fichier CSS-->

    <div class="entete">
      <!-- On crée l'en-tête en ajoutant plusieurs classes pour le CSS-->
      <div class="bandeau">
        <!-- On ajoute un titre et deux images pour constituer le bandeau supérieur-->
        <H2>Je donne de la valeur à mon engagement</H2>
        <img src="Jeunes Noir et Blanc.png" />
      </div>
      <div class="logo">
        <img src="Jeunes 6.4 Normal.png">
      </div>
    </div>

  </head>

  <body>
    <div class="fond">
        <!-- Arrière-plan-->
        <img src="Logo Bleu.png">
    </div>
  <div class="texte">
      <img src="Validation.png">
      <p><b>Le mail a été envoyé avec succès !</b></P> 
      
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", function() {
        var texte = document.querySelector(".texte");
        setTimeout(function() {
          texte.classList.add("apparition");
        }, 500);
      });
    </script>

  <a href = "accueiljeune.php?idp=<?php echo $idp ?>"  ><button type="reset">Confirmer</button></a>
  <div class="fond">
        <img src="Logo Bleu.png">
      </div>
  </body>

  <footer>
    <!-- Bandeau de bas de page-->
    <div class="credit">
      <img src="Jeunes 6.4 Blanc et Noir.png">

      <div class="partenaires">
        <!-- Les images des partenaires avec le site web qui leur correspond-->
        <img src="République française.png" link="https://www.service-public.fr/">
        <img src="Pyrenées Atlantiques Conseil Général.png" link="https://www.le64.fr/">
        <img src="Région Aquitaine.png" link="https://www.nouvelle-aquitaine.fr/">
        <img src="CAF.png"
          link="https://www.caf.fr/allocataires/caf-des-pyrenees-atlantiques/nous-contacter/points-d-accueil-de-votre-caf">
        <img src="Assurance Maladie.png" link="https://www.ameli.fr/">
        <img src="Assises de la Jeunesse.png"
          link="https://lannuaire.service-public.fr/nouvelle-aquitaine/pyrenees-atlantiques/caf17434-c2b7-4e92-8fe6-6f1546fedaa3">
        <img src="Université de Pau.png" link="https://www.univ-pau.fr/fr/index.html">
        <img src="MSA.png" link="https://www.msa.fr/lfp">
      </div>
      <p>JEUNES 6.4 est un dispositif issu de la charte de l’engagement pour la
        jeunesse signée en 2013 par des partenaires institutionnels qui ont décidé de mettre en commun leurs actions pour
        les jeunes
        des Pyrénées-Atlantiques.</p>
    </div>
    <!-- Lorsqu'une image d'un partenaire est cliquée, l'utilisateur est envoyé sur le site web qui lui correspond-->
    <script>
      var partenaires = document.querySelectorAll(".partenaires img");

      for (var i = 0; i < partenaires.length; i++) {
        partenaires[i].addEventListener("click", function () {
          var links = this.getAttribute("link");
          if (links) {
            window.location.href = links;
          }
        });
      }
    </script>
  </footer>

</html>

