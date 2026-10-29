<!-- Page de mise à jour des allergenes -->
<?php
/** @var array $allergeneModifier */
?>
<!--Contenu du head-->
<?php
    $title = "Mise à jour des allergènes Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!--Message erreur de MAJ de l'allergene -->
<?php if (isset($_SESSION['erreurUpdateAllergene'])) { ?>
        <div class="flashMessage erreurUpdateAllergene">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateAllergene']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateAllergene']);
        }?>

<form action="/?page=allergene_update" method="POST">
    <input id="modifierAllergene<?= $allergeneModifier['id'] ?>" name="id" type="hidden" value="<?= $allergeneModifier['id'] ?>">

    <fieldset>
        <div>
            <label for="nameAllergene">Nom de l'allergène</label>
            <input type="text" name="nomAllergene" id="nameAllergene" value="<?= htmlspecialchars($allergeneModifier['nomAllergene']) ?>"><br>
            <input type="submit" value="Valider">
        </div>
        <div>
            <a href="/?page=allergenes">Retour aux allergènes</a>
        </div>

    </fieldset>
</form>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>