<?php
$idp=$_GET['idp'];

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
        $nom=$row['nom'];
        $prenom=$row['prenom'];
        $mail=['email'];
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
            $html = '<!DOCTYPE html>
                <html>
                <head>
                    <title>Mon CV</title>
                </head>
                <body>
                    <h1>Mon CV</h1>

                    <h2>Informations personnelles</h2>
                    <p>Nom: '.$nom.' '.$prenom.'</p>
                    <p>Adresse: 123 Rue du CV, Ville, Pays</p>
                    <p>Téléphone: 123456789</p>
                    <p>Email: '.$mail.'</p>

                    <h2>Expérience professionnelle</h2>
                    <ul><p> Engagement n°'.$i.'</p>
                        Engagement : '.$engagement.'<br>
                        à duré du : '.$debut_enga.' 
                        au : '.$fin_enga.'<br>
                        le milieu de l engagement : '.$millieu.'<br>
                        Nom  et prénom du référent : '.$nom_ref.' '.$prenom_ref.'<br>
                        Métier du référent : '.$metier.'<br>
                        email du référent : '.$mail_ref.'<br><p>
                    <h2>Formation académique</h2>
                    <ul>
                        <li>Diplôme 1: Université X, Année d\'obtention: 2010</li>
                        <li>Diplôme 2: Université Y, Année d\'obtention: 2012</li>
                    </ul>

                    <h2>Compétences</h2>
                    <ul>
                        <li>Compétence 1</li>
                        <li>Compétence 2</li>
                        <li>Compétence 3</li>
                    </ul>
                </body>
            </html>';
             
            
        }
    }
    if($a == 0){
        echo "<p> Aucun engagement n'a été crée pour le moment <br></p>";
        $html= 'vide';

    } 
}

mysqli_close($connection);


// Génération du contenu HTML du CV


// En-têtes HTTP pour le téléchargement du fichier
header('Content-Type: text/html');
header('Content-Disposition: attachment; filename="mon_cv.html"');

// Envoi du contenu HTML en tant que fichier téléchargeable
echo $html;
?>