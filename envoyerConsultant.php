<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $consultantmail=$_POST['emailC'];
        $engagementNuméro=$_POST['text'];

            // Paramètres de connexion à la base de données
            $serveur = "localhost";  // Adresse du serveur MySQL
            $utilisateur = "root"; // Nom d'utilisateur MySQL
            $motDePasse = "root"; // Mot de passe MySQL
            $baseDeDonnees = "test"; // Nom de la base de données
            $table='EngagementJeune';

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
                $idN=$row['numeroEngagement'];
                if ($idN == $engagementNuméro && $row['Envoit_consultant'] == 0){;
                    $idE=$row['id'];
                    $nom=$row['nom'];
                    $prenom=$row['prenom'];
                    $idp=$row['idpersonne'];
                }
            }
        } 
        else {
            echo "Erreur lors de la requête : " . mysqli_error($connection);
        }
        if($idE != 0){
            $verif=1;
            // Construire la requête de mise à jour
            $a=1;
            $sql = "UPDATE $table SET Envoit_consultant='$a' WHERE id=$idE";

            // Exécuter la requête de mise à jour
            if (mysqli_query($connection, $sql)) {
                echo "<script>alert('informations mis a jour')</script>";
                
            } else {
                echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
            }

            // Fermer la connexion
            mysqli_close($connection);



            $lien = "localhost/consultant.php?idE=" . urlencode($idE);
            //envoit du message
            $message="<h2> SITE JEUNE 6.4</h2>";
            $message .="<p>Bonjour, " . $nom . " " . $prenom . " a envoyé  référencement et vous, en tant que Consultant,<br>";
            $message .="Vous pouvez librement disposer de ces information le concernant.</p>";
            $message .="<a href='" . $lien . "'>Cliquez ici pour accéder</a>";
            $headers = "From: projet.info.maxime@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n"; // Utilisez le type de contenu HTML
            mail($consultantmail,'Jeunes 6.4',$message,$headers);
        }
        else{
            $verif=0;
        }
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
        <div id="message" class="texte"></div>

            <script>
                var verif = <?php echo $verif; ?>;

                if (verif == 1) {
                    var messageDiv = document.getElementById('message');
                    var img = document.createElement('img');
                    img.src = 'Validation.png';
                    var p = document.createElement('p');
                    p.innerHTML = '<b>Le mail a été envoyé avec succès !</b>';

                    messageDiv.appendChild(img);
                    messageDiv.appendChild(p);
                } else {
                    var messageDiv = document.getElementById('message');
                    var p = document.createElement('p');
                    p.innerHTML = '<b>Engagement non existant ou déjà envoyé !</b>';

                    messageDiv.appendChild(p);
                }
            </script>
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

