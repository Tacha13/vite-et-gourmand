<!-- Page de mise à jour des plats -->
<?php
/** @var array $platModifier */
?>
<!--Contenu du head-->
<?php
    $title = "Mise à jour des plats Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<?php if (isset($_SESSION['erreurUpdatePlat'])) { ?>
        <div class="flashMessage erreurUpdatePlat">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdatePlat']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdatePlat']);
        }?>

<form action="/?page=plat_update" method="POST">
    <input id="modifierPlat<?= $platModifier['id'] ?>" name="id" type="hidden" value="<?= $platModifier['id'] ?>">

    <fieldset>
        <div>
            <label for="namePlat">Nom du plat</label>
            <input type="text" name="namePlat" id="namePlat" value="<?= htmlspecialchars($platModifier['nomPlat']) ?>"><br>
            <label for="typePlat">Type de plat</label>
            <input type="text" name="typePlat" id="typePlat" value="<?= htmlspecialchars($platModifier['typePlat']) ?>"><br>
            <input type="submit" value="Valider">
        </div>
        <div>
            <a href="/?page=plats">Retour aux plats</a>
        </div>

    </fieldset>
</form>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>