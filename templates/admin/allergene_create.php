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

<form action="/?page=allergene_create" method="POST">
    <fieldset>
        <div>
            <label for="nameAllergene">Nom de l'allergène</label>
            <input type="text" name="allergene" id="nameAllergene"><br>
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