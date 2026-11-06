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

<main class="container">

<div>
    <h1 class="title-updateMenu">Modification du menu : <?= htmlspecialchars($menuModifier['nomMenu']) ?></h1>
</div>


<?php if (isset($_SESSION['erreurUpdateMenu'])) { ?>
        <div class="flashMessage erreurUpdateMenu">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateMenu']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateMenu']);
        }?>

<form action="/?page=menu_update" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3">
    <input id="modifierMenu<?= $menuModifier['id'] ?>" name="id" type="hidden" value="<?= $menuModifier['id'] ?>">

        <div class="col">
            <label class="form-label" for="imageMenu">Nom de l'image</label>
            <input class="form-control" type="text" name="image" id="imageMenu" value="<?= htmlspecialchars($menuModifier['image']) ?>">
        </div>
        <div class="col">
            <img class="admin-img m-2" src="/images/<?= htmlspecialchars($menuModifier['image']) ?>" alt="image du menu <?= htmlspecialchars($menuModifier['nomMenu']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="nameMenu">Nom du menu</label>
            <input class="form-control" type="text" name="nameMenu" id="nameMenu" value="<?= htmlspecialchars($menuModifier['nomMenu']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" name="description" id="description"><?= htmlspecialchars($menuModifier['description']) ?></textarea>
        </div>
        <div class="col">
            <label class="form-label" for="theme">Thème</label>
            <input class="form-control" type="text" name="theme" id="theme" value="<?= htmlspecialchars($menuModifier['theme']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="persMin">Nombre de personnes minimum</label>
            <input class="form-control" type="number" name="persMin" id="persMin" value="<?= htmlspecialchars($menuModifier['nbPersonneMin']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="price">Prix</label>
            <input class="form-control" type="number" name="price" id="price" step="0.01" value="<?= (float)($menuModifier['prix']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="conditions">Conditions</label>
            <input class="form-control" type="text" name="conditions" id="conditions" value="<?= htmlspecialchars($menuModifier['conditions']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="regime">Régime</label>
            <input class="form-control" type="text" name="regime" id="regime" value="<?= htmlspecialchars($menuModifier['regime']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="stock">Stock</label>
            <input class="form-control" type="number" name="stock" id="stock" value="<?= (int)($menuModifier['stock']) ?>">
        </div>
        <div class="boutons-adminEmploye align-self-end">
            <button>Valider</button>
        </div>
</form>
    <div class="return-admin">
        <a href="/?page=admin" class="returnAdmin">Retour à la page administration</a>
    </div>
</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>