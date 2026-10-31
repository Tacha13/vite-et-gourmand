<!-- Page tableau de bord statistiques admin -->
<?php
/** @var array $statMenus */
?>
<!--Contenu du head-->
<?php
    $title = "Statistiques Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!-- Tableau affichant les informations des commandes pour stats -->
<table>
    <thead>
        <tr>
            <th>Nom du Menu</th>
            <th>Nombre de commandes</th>
            <th>Chiffre d'affaires</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($statMenus as $statMenu): ?>
    <tr>
        <td><?= htmlspecialchars($statMenu['_id']) ?></td>
        <td><?= htmlspecialchars(($statMenu['nbCommandes'])) ?></td>
        <td><?= htmlspecialchars(number_format($statMenu['chiffreAffaire'],2,',',' ')) ?> €</td>
    </tr>
<?php endforeach ?>
</tbody>
</table>
    <div>
        <a href="/?page=admin">Retour à la page administration</a>
    </div>
    


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>