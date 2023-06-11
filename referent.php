<?php
    $idE= $_GET['id'];
    $idp= $_GET['idp'];
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
             // Accéder aux valeurs des colonnes
             $id= $row['id'];
             if ($id == $idE){;
                
                 $email = $row['referentmail'];
                 $nom = $row['nom_ref'];
                 
                 $prenom = $row['prenom_ref'];
                 $milieu = $row['milieu'];
                 $engagement = $row['engagement'];
                 $debut_enga = $row['debut_enga'];
                 $fin_enga = $row['fin_enga'];
                 $metier=$row['metier_ref'];
                 $Noenga=$row['numeroEngagement'];
             }
         } 
     }
     else {
         echo "Erreur lors de la requête : " . mysqli_error($connection);
     }
     mysqli_close($connection);
 






?>


<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>Page Web</title>
        <style>
            .page {
                display: none;
            }

            
        </style>
        <link rel="stylesheet" type="text/css" href="accueiljeune.css">
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
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
            afficherFormulaire('divAfficher'); // Sélectionne l'onglet "Afficher" par défaut lors du chargement de la page
            });
            function afficherFormulaire(divId) {
                var divs = document.querySelectorAll('.page');
                for (var i = 0; i < divs.length; i++) {
                    divs[i].style.display = 'none';
                }
                var div = document.getElementById(divId);
                div.style.display = 'block';
            }
        </script>
    </head>

    <body>
        <header>
            <h1>Page Web</h1>
        </header>

        <div class="onglet">
            <ul>
                <li><button onclick="afficherFormulaire('divAfficher')"> informations</button></li>
                <li><button onclick="afficherFormulaire('divModifier')">Modifier les informations</button></li>
                
            </ul>
        </div>

        <div id="divAfficher" class="page">
            <div class="fond">
            <img src="Logo Bleu.png">
            </div>
            <?php
           echo "<p> $engagement<br> ";
                
            echo " $milieu<br> ";
                 
                echo " $debut_enga ";
                 echo " $fin_enga <br>";
                 echo "  $metier<br>";
                 echo " $nom";
                echo " $prenom<br>";
                echo " $email</p>";
                
            ?>
            <form id='form'>
                <div class=formulaire>  
                <button onclick="window.location.href = 'referent.php?id=<?php echo $idE ?>'" type="reset">Actualiser les informations</button>
                </div>
            </form>
            
        </div>


        <div id="divModifier" class="page">
            <div class="fond">
                <img src="Logo Bleu.png">
            </div>
            <form method="post"  id='form'>
                <div class=formulaire>  
                    <fieldset>
                        <br>
                        <label >Engagement
                            <input type="text" id="engagement" name="engagement" >
                        </label>

                        <br> <br>
                        <label >durée engagement du :
                            <input type="date" id="debut_enga" name="debut_enga" >
                        </label>
                        <label >au :
                            <input type="date" id="fin_enga" name="fin_enga" >
                        </label>
                        <br> <br>
                        <label >milieu de l'engagement :
                            <input type="text" id="milieu" name="milieu" >
                        </label>
                        <br> <br>
                        <label >métier :
                            <input type="text" id="métier" name="métier" >
                        </label>
                        <br> <br>
                        <label >Votre Nom :
                            <input type="text" id="nom" name="nom" >
                        </label>

                        <label >votre prénom : 
                            <input type="text" id="prenom" name="prenom" >
                        </label>

                        <br> <br>
                        <label >votre email : 
                            <input type="email" id="email" name="email" >
                        </label>

                        <br> <br>
                        <button type="submit" class="submit"> Confirmer</button>
                    </fieldset>
                </div>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $engagement2=$_POST['engagement'];
                    $debut_enga2=$_POST['debut_enga'];
                    $fin_enga2=$_POST['fin_enga'];
                    $metier2=$_POST['métier'];
                    $nom2=$_POST['nom'];
                    $milieu2=$_POST['milieu'];
                    $prenom2=$_POST['prenom'];
                    $email2=$_POST['email'];
                    if($engagement2 == NULL){
                        $engagement2 = $engagement;
                    }
                    if($debut_enga2 == NULL){
                        $debut_enga2 = $debut_enga;
                    }
                    if($fin_enga2 == NULL){
                        $fin_enga2 = $fin_enga;
                    }
                    if($nom2 == NULL){
                        $Newnom2mail = $nom;
                    }
                    if($prenom2 == NULL){
                        $prenom2 = $prenom;
                    }
                    if($email2 == NULL){
                        $email2 = $email;
                    }
                    if($milieu2 == NULL){
                        $milieu2 = $milieu;
                    }
                    if($metier2 == NULL){
                        $metier2 = $metier;
                    }
                    // Paramètres de connexion à la base de données
                    $serveur = "localhost";  // Adresse du serveur MySQL
                    $utilisateur = "root"; // Nom d'utilisateur MySQL
                    $motDePasse = "root"; // Mot de passe MySQL
                    $baseDeDonnees = "test"; // Nom de la base de données
                    $table='EngagementJeune';

                    // Établir une connexion
                    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
                    
                    // Vérification de la connexion
                    if (!$connexion) {
                        die("Échec de la connexion : " . mysqli_connect_error());
                    }
                    // Construire la requête de mise à jour
                    $sql = "UPDATE EngagementJeune SET idpersonne='$idp',numeroEngagement='$Noenga' ,engagement='$engagement2', debut_enga='$debut_enga2', fin_enga='$fin_enga2',   milieu='$milieu2', nom_ref='$nom2', prenom_ref='$prenom2', metier_ref='$metier2',referentmail='$email2' WHERE id=$idE";

                    // Exécuter la requête de mise à jour
                    if (mysqli_query($connexion, $sql)) {
                        echo "<script>alert('informations mis a jour')</script>";
                        
                    } else {
                        echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
                    }

                    // Fermer la connexion
                    mysqli_close($connexion);
                    
                }
            ?>
        </div>




























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