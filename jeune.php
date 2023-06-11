<?php

  $nom = $_GET['nom'];
  $prenom = $_GET['prenom'];
  $naissance = $_GET['naissance'];
  $email = $_GET['email'];
  $id= $_GET['id'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="Jeune.css">
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

<p> Décrivez votre expérience et mettez en avant ce que vous en avez retiré.
</p> <!-- Arrière-plan-->
    <div class="fond">
      <img src="Logo Bleu.png">
    </div>
<?php
    echo "<p> $nom";
    echo " $prenom<br>";
    echo "  $naissance<br>";
    echo " $email</p>";
?>


<div class=groupe>
<form method="post" action="jeune2.php">
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
        <label>Email du Consultant :
            <input type="text" id="email_cons" name="email_cons" required>
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
