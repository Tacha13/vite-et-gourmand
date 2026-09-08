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

<form action="/?page=plat_create" method="POST">
    <fieldset>
        <div>
            <label for="namePlat">Nom du plat</label>
            <input type="text" name="namePlat" id="namePlat"><br>
            <label for="typePlat">Type de plat</label>
            <input type="text" name="typePlat" id="typePlat"><br>
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