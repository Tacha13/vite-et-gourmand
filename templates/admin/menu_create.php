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

$image = htmlspecialchars($_POST['image']);

<form action="/?page=menu_create" method="POST">
    <fieldset>
        <div>
            <label for="imageMenu">Nom de l'image</label>
            <input type="text" name="image" id="imageMenu"><br>
            <div><img src="/images/" alt="Image du menu"></div>
            <label for="nameMenu">Nom du menu</label>
            <input type="text" name="nameMenu" id="nameMenu"><br>
            <label for="description">Description</label>
            <input type="text" name="description" id="description"><br>
            <label for="theme">Thème</label>
            <input type="text" name="theme" id="theme"><br>
            <label for="persMin">Nombre de personnes minimum</label>
            <input type="number" name="persMin" id="persMin"><br>
            <label for="price">Prix</label>
            <input type="number" name="price" id="price" step="0.01"><br>
            <label for="conditions">Conditions</label>
            <input type="text" name="conditions" id="conditions"><br>
            <label for="regime">Régime</label>
            <input type="text" name="regime" id="regime"><br>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock"><br>
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