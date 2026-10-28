<!-- Page de mise à jour des menus -->
<?php
/** @var array $menuModifier */
?>
<!--Contenu du head-->
<?php
    $title = "Mise à jour menus Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<?php if (isset($_SESSION['erreurUpdateMenu'])) { ?>
        <div class="flashMessage erreurUpdateMenu">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateMenu']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateMenu']);
        }?>

<form action="/?page=menu_update" method="POST">
    <input id="modifierMenu<?= $menuModifier['id'] ?>" name="id" type="hidden" value="<?= $menuModifier['id'] ?>">

    <fieldset>
        <div>
            <label for="imageMenu">Nom de l'image</label>
            <input type="text" name="image" id="imageMenu" value="<?= htmlspecialchars($menuModifier['image']) ?>"><br>
            <div><img src="/images/" alt="Image du menu"></div>
            <label for="nameMenu">Nom du menu</label>
            <input type="text" name="nameMenu" id="nameMenu" value="<?= htmlspecialchars($menuModifier['nomMenu']) ?>"><br>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?= htmlspecialchars($menuModifier['description']) ?>"><br>
            <label for="theme">Thème</label>
            <input type="text" name="theme" id="theme" value="<?= htmlspecialchars($menuModifier['theme']) ?>"><br>
            <label for="persMin">Nombre de personnes minimum</label>
            <input type="number" name="persMin" id="persMin" value="<?= htmlspecialchars($menuModifier['nbPersonneMin']) ?>"><br>
            <label for="price">Prix</label>
            <input type="number" name="price" id="price" step="0.01" value="<?= (float)($menuModifier['prix']) ?>"><br>
            <label for="conditions">Conditions</label>
            <input type="text" name="conditions" id="conditions" value="<?= htmlspecialchars($menuModifier['conditions']) ?>"><br>
            <label for="regime">Régime</label>
            <input type="text" name="regime" id="regime" value="<?= htmlspecialchars($menuModifier['regime']) ?>"><br>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" value="<?= (int)($menuModifier['stock']) ?>"><br>
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