<!-- Page de confirmation de suppression commun à chaque demande de suppression -->


<!--Contenu du head-->
<?php
$title = "Confirmation suppression Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>

<main class="container">
    <div>
        <h1 class="title-delete">Confirmation suppression</h1>
    </div>

<?php
// $id est injecté via les require dans les controller — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($id)) {
    $id = 0;
}

if (!isset($entity)) {
    $entity = 0;
}
?>

<div class="text-delete">
    <p>Confirmez-vous la suppression, si oui, sélectionner "Supprimer", si non "annuler".</p>
</div>
<?php 
if ($entity === 'plat') : ?>
    <form action="/?page=plat_delete" method="POST" class="text-center">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input class="delete-global" type="submit" value="Supprimer"> <br>
    </form>
    <div class="annule">
        <a href="/?page=plats">Annuler</a>
    </div>
<?php
elseif  ($entity === 'menu') : ?>
    <form action="/?page=menu_delete" method="POST" class="text-center">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input class="delete-global" type="submit" value="Supprimer"> <br>
    </form>
    <div class="annule">
        <a href="/?page=admin_menus">Annuler</a>
    </div>

<?php 
elseif ($entity === 'allergene'): ?>
    <form action="/?page=allergene_delete" method="POST" class="text-center">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input class="delete-global" type="submit" value="Supprimer"> <br>
    </form>
    <div class="annule">
        <a href="/?page=allergenes">Annuler</a>
    </div>


<?php endif?>
</main>
 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
