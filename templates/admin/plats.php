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

<!-- Tableau affichant les informations des plats -->
<table>
    <caption>Plat 1</caption>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des plats enregistrés en BDD -->      
<?php
// $plats est injecté via require dans PlatController::showPlats() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($plats) || !is_array($plats)) {
    $plats = [];
}
?>

<?php foreach ($plats as $plat): ?>
    <tr>
        <td><?= htmlspecialchars($plat['nomPlat']) ?></td>
        <td><?= htmlspecialchars($plat['typePlat']) ?></td>
        <td><img src="" alt="Image du plat"></td>
        <td><input type="button" value="Voir"></td>
        <td><input type="button" value="Modifier"></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $plat['id'] ?>">
                    <input name="entity" type="hidden" value="plat">
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