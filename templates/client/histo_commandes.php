<!-- Page des historiques de commandes clients -->
<?php
/** @var array $allCommandes */
?>

<!--Contenu du head-->
<?php
$title = "Validation commande Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>

<div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Numéro</th>
            <th scope="col">Date de livraison</th>
            <th scope="col">Nom du menu</th>
            <th scope="col">Nombre de convives</th>
            <th scope="col">Prix total</th>
            <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($allCommandes as $allCommande): ?>
            <tr>
            <td><?=  htmlspecialchars($allCommande['numero']) ?></td>
            <td><?=  htmlspecialchars($allCommande['datePrestation']) ?></td>
            <td><?=  htmlspecialchars($allCommande['nomMenu']) ?></td>
            <td><?=  htmlspecialchars($allCommande['nbPersonneCommande']) ?></td>
            <td><?=  htmlspecialchars($allCommande['prixTotal']) ?></td>
            <td><?=  htmlspecialchars($allCommande['statut']) ?></td>

            </tr>
    <?php endforeach ?>
        </tbody>
    
    </table>
</div>





 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>