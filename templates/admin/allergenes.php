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

<!-- Tableau affichant les informations des allerènes -->
<table>
    <caption>Allergène 1</caption>
    <thead>
        <tr>
            <th>Nom de l'allergène</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des allergenes enregistrés en BDD -->      
<?php
// $allergenes est injecté via require dans Controller: — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($allergenes) || !is_array($allergenes)) {
    $allergenes = [];
}
?>

<?php foreach ($allergenes as $allergene): ?>
    <tr>
        <td><?= htmlspecialchars($allergene['nomAllergene']) ?></td>
        <td><img src="" alt="Image de l'allergène"></td>
        <td><input type="button" value="Voir"></td>
        <td><input type="button" value="Modifier"></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $allergene['id'] ?>">
                    <input name="entity" type="hidden" value="allergene">
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

