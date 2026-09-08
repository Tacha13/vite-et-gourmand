<?php
// $id est injecté via les require dans les controller — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($id)) {
    $id = 0;
}

if (!isset($entity)) {
    $entity = 0;
}
?>

<div>
    <p>Confirmer la suppression</p>
</div>
<?php 
if ($entity === 'plat') : ?>
    <form action="/?page=plat_delete" method="POST">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input type="submit" value="Supprimer"> <br>
    <a href="/?page=plats">Annuler</a>
</form>
<?php
elseif  ($entity === 'menu') : ?>
    <form action="/?page=menu_delete" method="POST">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input type="submit" value="Supprimer"> <br>
    <a href="/?page=menus">Annuler</a>
    </form>

<?php 
elseif ($entity === 'allergene'): ?>
    <form action="/?page=allergene_delete" method="POST">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input type="submit" value="Supprimer"> <br>
    <a href="/?page=allergenes">Annuler</a>
    </form>


<?php endif?>


