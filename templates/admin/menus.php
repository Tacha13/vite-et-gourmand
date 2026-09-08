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

<!-- Section pour les filtres -->
<section>
    <div>

    </div>
</section>

<!-- Tableau affichant les informations du menu -->
<table>
    <caption>Menu 1</caption>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Thème</th>
            <th>Images</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des menus enregistrés en BDD -->      
<?php
// $menus est injecté via require dans MenuController::showMenus() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($menus) || !is_array($menus)) {
    $menus = [];
}
?>

<?php foreach ($menus as $menu): ?>
    <tr>
        <td><?= htmlspecialchars($menu['nomMenu']) ?></td>
        <td><?= htmlspecialchars($menu['theme']) ?></td>
        <td><img src="" alt="Image du menu"></td>
        <td><?= htmlspecialchars((string) $menu['prix']) ?></td>
        <td><input type="button" value="Voir"></td>
        <td><input type="button" value="Modifier"></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $menu['id'] ?>">
                    <input type="submit" value="Supprimer">
                </form>
            </td>

    </tr>
<?php endforeach ?>
    
</tbody>
</table>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>