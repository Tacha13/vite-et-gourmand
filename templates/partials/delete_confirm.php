<?php
// $id est injecté via require dans MenuController::showDeleteConfirm() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($id)) {
    $id = 0;
}
?>

<div>
    <p>Confirmer la suppression</p>
</div>
<form action="/?page=menu_delete" method="POST">
    <input name="id" type="hidden" value="<?=  $id ?>">
    <input type="submit" value="Supprimer"> <br>
    <a href="/?page=menus">Annuler</a>
</form>
