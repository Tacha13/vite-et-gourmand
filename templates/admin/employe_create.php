<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<form action="/?page=employe_create" method="POST">
    <fieldset>
        <div>
            <label for="nameEmploye">Nom de l'employé</label>
                <input type="text" name="nameEmploye" id="nameEmploye"><br>
            <label for="prenomEmploye">Prénom de l'employé</label>
                <input type="text" name="prenomEmploye" id="prenomEmploye"><br>
            <label for="adressEmploye">Adresse de l'employé</label>
                <input type="text" name="adressEmploye" id="adressEmploye"><br>
            <label for="complAdressEmploye">Complément adresse</label>
                <input type="text" name="complAdressEmploye" id="complAdressEmploye"><br>
            <label for="postalEmploye">Code postal</label>
                <input type="number" name="postalEmploye" id="postalEmploye"><br>
            <label for="communeEmploye">Commune</label>
                <input type="text" name="communeEmploye" id="communeEmploye"><br>
            <label for="emailEmploye">Email de l'employé</label>
                <input type="email" name="emailEmploye" id="emailEmploye"><br>
            <label for="telEmploye">Téléphone de l'employé</label>
                <input type="text" name="telEmploye" id="telEmploye"><br>
            <label for="passwordEmploye">Mot de passe de l'employé</label>
                <input type="password" name="passwordEmploye" id="passwordEmploye"><br>
            <input type="hidden" name="roleEmploye" id="roleEmploye" value="employe"><br>
            <input type="hidden" name="statusEmploye" id="statusEmploye" value="1"><br>
            <input type="submit" value="Valider">
        </div>

    </fieldset>
   

</form>



 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>