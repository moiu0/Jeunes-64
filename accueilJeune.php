<?php
    $idp= $_GET['idp'];
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
            $id= $row['id'];
            if ($id == $idp){;
                $email = $row['email'];
                $mdp = $row['mdp'];
                $naissance = $row['naissance'];
                $nom = $row['nom'];
                $prenom = $row['prenom'];
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
                <li><button onclick="afficherFormulaire('divCreer')">Créer un engagement</button></li>
                <li><button onclick="afficherFormulaire('divConsulter')">Consulter les engagements</button></li>
                <li><button onclick="afficherFormulaire('divEnvoit')">Envoyer les engagements</button></li>
                <li><button onclick="afficherFormulaire('divCv')">Importer engagement dans le CV</button></li>
            </ul>
        </div>

        <div id="divAfficher" class="page">
            <div class="fond">
            <img src="Logo Bleu.png">
            </div>
            <?php
                echo "<p> $nom";
                echo " $prenom<br>";
                echo "  $naissance<br>";
                echo " $email</p>";
                
            ?>
            <form id='form'>
                <div class=formulaire>  
                <button onclick="window.location.href = 'accueiljeune.php?idp=<?php echo $idp ?>'" type="reset">Actualiser les informations</button>
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
                        <label >Nouveau Nom
                            <input type="text" id="Newnom" name="Newnom" >
                        </label>

                        <br> <br>
                        <label >Nouveau Prenom
                            <input type="text" id="Newprenom" name="Newprenom" >
                        </label>

                        <br> <br>
                        <label >Nouvel email
                            <input type="text" id="Newmail" name="Newmail" >
                        </label>

                        <br> <br>
                        <label >Nouveau mot de passe
                            <input type="text" id="Newmdp" name="Newmdp" >
                        </label>

                        <br> <br>
                        <label >Nouvelle date de naissance
                            <input type="date" id="Newbirth" name="Newbirth" >
                        </label>

                        <br> <br>
                        <button type="submit" class="submit"> Confirmer</button>
                    </fieldset>
                </div>
            </form>
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $Newnom=$_POST['Newnom'];
                    $Newprenom=$_POST['Newprenom'];
                    $Newmail=$_POST['Newmail'];
                    $Newmdp=$_POST['Newmdp'];
                    $Newbirth=$_POST['Newbirth'];
                    if($Newnom == NULL){
                        $Newnom = $nom;
                    }
                    if($Newprenom == NULL){
                        $Newprenom = $prenom;
                    }
                    if($Newmdp == NULL){
                        $Newmdp = $mdp;
                    }
                    if($Newmail == NULL){
                        $Newmail = $email;
                    }
                    if($Newbirth == NULL){
                        $Newbirth = $naissance;
                    }


                    // Paramètres de connexion à la base de données
                    $serveur = "localhost";  // Adresse du serveur MySQL
                    $utilisateur = "root"; // Nom d'utilisateur MySQL
                    $motDePasse = "root"; // Mot de passe MySQL
                    $baseDeDonnees = "test"; // Nom de la base de données
                    $table='utilisateurs';

                    // Établir une connexion
                    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);
                    
                    // Vérification de la connexion
                    if (!$connexion) {
                        die("Échec de la connexion : " . mysqli_connect_error());
                    }

                    // Construire la requête de mise à jour
                    $sql = "UPDATE utilisateurs SET nom='$Newnom', prenom='$Newprenom', mdp='$Newmdp', naissance='$Newbirth', email='$Newmail' WHERE id=$idp";

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






        <div id="divCreer" class="page">
            <div class="fond">
                <img src="Logo Bleu.png">
            </div>
        <div class=groupe>
            <form method="post" action="jeune2.php" id='form'>
            <div class=formulaire>
                <fieldset>
                <br>
                    <label >Réseau Social : 
                        <input type="text" id="social" name="social" >
                    </label>

                <br> <br>
                    <label> Engagement : <br>
                        <textarea type="text" id="engagement" name="engagement" maxlength="1000" rows="10" cols="100" placeholder="Décris ton précédent engagement en 1000 caractères" required></textarea>
                    </label>

                <br><br>
                    <label> Durée de l'engagement : 
                    Du : <input type="date" name="debut_enga" required>  Au : <input type="date" name="fin_enga" required>
                    </label>
                
                <br><br>
                <label >Milieu de l'engagement : 
                        <input type="text" id="milieu" name="milieu" required>
                    </label>
                    <br><br>
                    <label>Nom du référent :
                        <input type="text" id="nom_ref" name="nom_ref" required>
                    </label>
                <br><br>
                    <label>Prénom du référent :
                        <input type="text" id="prenom_ref" name="prenom_ref" required>
                    </label>
                    <br><br>
                    <label>métier du référent :
                        <input type="text" id="metier_ref" name="metier_ref" required>
                    </label>
                <br><br>
                    <label>Email du référent :
                        <input type="text" id="email_ref" name="email_ref" required>
                    </label>
                    <br><br>

                

                <button type="submit" class="submit"> Confirmer</button></p>
                <input type="hidden" name="nom" value="<?php echo urlencode($nom); ?>">
                <input type="hidden" name="prenom" value="<?php echo urlencode($prenom); ?>">
                <input type="hidden" name="email" value="<?php echo urlencode($email); ?>">
                <input type="hidden" name="id" value="<?php echo urlencode($id); ?>">
                </fieldset>
            </div>
            </form>
                <table>
                    <tr>
                        <td><b>Je suis </b></td>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li><input type="checkbox" id="s-e"><label>Autonome</label>
                                <li><input type="checkbox" id="s-e"><label>Capable d’analyse et de synthèse</label>
                                <li><input type="checkbox" id="s-e"><label>A l’écoute</label>
                                <li><input type="checkbox" id="s-e"><label>Organisé</label>
                                <li><input type="checkbox" id="s-e"><label>Passionné</label>
                                <li><input type="checkbox" id="s-e"><label>Fiable</label>
                                <li><input type="checkbox" id="s-e"><label>Patient</label>
                                <li><input type="checkbox" id="s-e"><label>Réfléchi</label>
                                <li><input type="checkbox" id="s-e"><label>Responsable</label>
                                <li><input type="checkbox" id="s-e"><label>Sociable</label>
                            </ul>
                        </td>
                    </tr>
                    </table>
                
            </div>

            <script>
                function limitCheckboxSelection() {
                    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                    var checkedCount = 0;

                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                        checkedCount++;
                        }

                        checkboxes[i].addEventListener('change', function() {
                        if (this.checked) {
                            checkedCount++;

                            if (checkedCount > 3) {
                            this.checked = false;
                            checkedCount--;
                            }
                        } else {
                            checkedCount--;
                        }
                        });
                    }
                }

                limitCheckboxSelection();
            </script>

        </div>






        <div id="divConsulter" class="page">
            <div class="fond">
                <img src="Logo Bleu.png">
            </div>  
            <div class="container">
                <div class="information">
                    <?php

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
                            $i=0;
                            $a=0;
                            // Parcours des résultats avec une boucle
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Accéder aux valeurs des colonnes
                                $id=$row['idpersonne'];
                                if ($id == $idp){;
                                    $a=1;
                                    $i++;
                                    $nom2 = $row['nom'];
                                    $prenom2 = $row['prenom'];
                                    $reseau = $row['social'];
                                    $engagement= $row['engagement'];
                                    $debut_enga = $row['debut_enga'];
                                    $fin_enga = $row['fin_enga'];
                                    $millieu = $row['milieu'];
                                    $nom_ref= $row['nom_ref'];
                                    $prenom_ref = $row['prenom_ref'];
                                    $metier= $row['metier_ref'];
                                    $mail_ref= $row['referentmail'];
                                    $verif_cons= $row['Verif_consultant'];
                                    echo "<p> Engagement n°$i <br>";
                                    echo "Nom et prénom : $nom2";
                                    echo " $prenom2<br>";
                                    if($reseau != NULL){
                                        echo "Réseau social : $reseau<br>";
                                    }
                                    echo "Engagement : $engagement<br>";
                                    echo "à duré du : $debut_enga ";
                                    echo "au : $fin_enga<br>";
                                    echo "le milieu de l'engagement : $millieu<br>";
                                    echo "Nom  et prénom du référent : $nom_ref";
                                    echo " $prenom_ref<br>";
                                    echo "Métier du référent : $metier<br>";
                                    echo "email du référent : $mail_ref<br>";
                                    if ($verif_cons == 0){
                                        echo "état de la demande : En attente<br><br></p>";
                                    }
                                    else{
                                        echo "état de la demande : Vérifiée<br><br></p>";
                                    }
                                    echo "---------------------<br><br>";

                    
                                }
                                
                                    
                            }
                            if($a == 0){
                                $a=1;
                                echo "<p> Aucun engagement n'a été crée pour le moment <br></p>";
                            }
                        } 
                        else {
                            echo "Erreur lors de la requête : " . mysqli_error($connection);
                        }
                    
                        mysqli_close($connection);



                    ?>
            
                </div>
            </div>

        </div>






        <div id="divEnvoit" class="page">
            <div class="fond">
                <img src="Logo Bleu.png">
            </div>
            <?php
            
        
              
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
                    $i=0;
                    // Parcours des résultats avec une boucle
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Accéder aux valeurs des colonnes
                        $id=$row['idpersonne'];
                        if ($id == $idp){;
                            $i++;
                            if($row['Envoit_consultant'] == 1){
                                $i--;
                                
                            }
                        }
                    }
                } 
                else {
                    echo "Erreur lors de la requête : " . mysqli_error($connection);
                }
            
                mysqli_close($connection);
            
            
            
            
            ?>
            <form method="post" action="envoyerConsultant.php">
                <div class=formulaire>
                    vous avez <?php echo "$i" ?> engagements non envoyés
                    <label for="idEngagement" >Rentrez le numéro l'engagement que vous voulez envoyer
                    <input type="text" id="text" name="text" required></label>
                    <br><br>
                    <label for="email" required>Adresse e-mail du consultant :
                    <input type="email" id="emailC" name="emailC" required></label>
                    <br><br>
                    <button type="submit" class="submit" > Confirmer</button>
                </div>
            </form>


        </div>












        <div id="divCv" class="page">
            <div class="fond">
                <img src="Logo Bleu.png">
            </div>
            
                <h1>Mon CV</h1>

                <h2>Informations personnelles</h2>
                <?php
                    echo "Nom : $nom";
                    echo " $prenom<br>";
                    echo "Email : $email<br>";
                    echo "Date de naissance : $naissance<br>";
                ?>

                <h2>Expérience professionnelle</h2>
                <ul>
                    <?php 
                    
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
                        $i=0;
                        $a=0;
                        // Parcours des résultats avec une boucle
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Accéder aux valeurs des colonnes
                            
                            $id=$row['idpersonne'];
                            $reseau = $row['social'];
                            $engagement= $row['engagement'];
                            $debut_enga = $row['debut_enga'];
                            $fin_enga = $row['fin_enga'];
                            $millieu = $row['milieu'];
                            $nom_ref= $row['nom_ref'];
                            $prenom_ref = $row['prenom_ref'];
                            $metier= $row['metier_ref'];
                            $mail_ref= $row['referentmail'];
                            $verif_cons= $row['Verif_consultant'];
                            if ($id == $idp){;
                                $i++;$a=1;
                                echo "<p> Engagement n°$i <br>";
                                if($reseau != NULL){
                                    echo "Réseau social : $reseau<br>";
                                }
                                echo "Engagement : $engagement<br>";
                                echo "à duré du : $debut_enga ";
                                echo "au : $fin_enga<br>";
                                echo "le milieu de l'engagement : $millieu<br>";
                                echo "Nom  et prénom du référent : $nom_ref";
                                echo " $prenom_ref<br>";
                                echo "Métier du référent : $metier<br>";
                                echo "email du référent : $mail_ref <br><p>";
                            }
                        }
                        if($a == 0){
                            echo "<p> Aucun engagement n'a été crée pour le moment <br></p>";
                        } 
                    }
                    
                    mysqli_close($connection);
                    
                    
                    
                    ?>
                </ul>

                <h2>Formation académique</h2>
                <ul>
                    <li>Diplôme 1: Université X, Année d'obtention: 2010</li>
                    <li>Diplôme 2: Université Y, Année d'obtention: 2012</li>
                </ul>

                <h2>Compétences</h2>
                <ul>
                    <li>Compétence 1</li>
                    <li>Compétence 2</li>
                    <li>Compétence 3</li>
                </ul>
                 
                
                <a href="telecharger_cv.php?idp=<?php echo $idp ?>"><button type="submit">Télécharger le CV</button></a>
                
            </div>

            <script>
            document.getElementById("btnTelecharger").addEventListener("click", function() {
                // Code pour déclencher le téléchargement du CV ici
                alert("Téléchargement du CV en cours...");
            });
            </script>
            
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