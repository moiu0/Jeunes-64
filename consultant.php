
<?php 

$idE= $_GET['idE'];
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
                $email=$row['email'];
                $nom=$row['nom'];
                $prenom=$row['prenom'];
                $email_ref= $row['referentmail'];
                $nom_ref = $row['nom_ref'];
                $prenom_ref = $row['prenom_ref'];
                $milieu = $row['milieu'];
                $engagement = $row['engagement'];
                $debut_enga = $row['debut_enga'];
                $fin_enga = $row['fin_enga'];
                $metier=$row['metier_ref'];
                $Noenga=$row['numeroEngagement'];
                $validation=$row['Verif_consultant'];
             }
         } 
     }
     else {
         echo "Erreur lors de la requête : " . mysqli_error($connection);
     }
     mysqli_close($connection);
 
$valider=1;
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
        <link rel="stylesheet" type="text/css" href="consultant.css">
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
                
                
            </ul>
        </div>
        <div id="divAfficher" class="page">
            <div class="fond">
            <img src="Logo Bleu.png">
            </div>
            <?php
                echo "<p>$nom";
                echo "$prenom";
                echo"$email";
                echo " $engagement<br> ";
                echo " $debut_enga ";
                 echo " $fin_enga <br>";
                 echo " $milieu<br> ";
                 echo " $nom";
                echo " $prenom<br>";
                 echo "  $metier<br>";
                echo " $email</p>";
                
            ?>
            <form id="form"  method="GET">
                <div class=formulaire>  
                <a href="consultant.php?idE=<?php echo urlencode($idE); ?>">
                     <button name="idE">Valider les informations</button>
                </a>
                </div>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idE'])) {
                    echo"$validation";
                    $validation=1;

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
                    $sql = "UPDATE EngagementJeune SET Verif_consultant='$validation' WHERE id=$idE";

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
