<!-- Page des historiques de commandes clients -->
<?php
/** @var array $allCommandes */
?>

<!--Contenu du head-->
<?php
$title = "Historique Commandes commande Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>
<main>
    <div>
        <h1 class="histo-title">Historique des commandes</h1>
    </div>

<div class="table-responsive histo-tableau">
    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
            <th scope="col">Numéro</th>
            <th scope="col">Date de livraison</th>
            <th scope="col">Nom du menu</th>
<!-- d-none d-md-table-cell class Bootstrap permete de masquer la cellule (titreinclus avec th) si l'écran est plus petit que lg≥992px-->
            <th class="d-none d-md-table-cell" scope="col">Nombre de convives</th>
            <th scope="col">Prix total</th>
            <th scope="col">Statut</th>
            <th scope="col">Avis</th>
            
            </tr>
        </thead>
        <tbody>
    <?php foreach ($allCommandes as $allCommande): ?>
            <tr>
            <td><?=  htmlspecialchars($allCommande['numero']) ?></td>
            <td><?=  htmlspecialchars($allCommande['datePrestation']) ?></td>
            <td><?=  htmlspecialchars($allCommande['nomMenu']) ?></td>
            <td class="d-none d-md-table-cell"><?=  htmlspecialchars($allCommande['nbPersonneCommande']) ?></td>
            <td><?=  htmlspecialchars($allCommande['prixTotal']) ?></td>
            <td><?=  htmlspecialchars($allCommande['statut']) ?></td>
            <td>
            <?php if ($allCommande['statut'] === 'Terminée' && $allCommande['avis_id'] === null): ?>

                    <a class="btn-avis" href="/?page=avis&idCommandeAvis=<?=  $allCommande['id'] ?>">Laisser un avis</a>
            <?php endif ?>
            </td>
            </tr>
    <?php endforeach ?>

            <div class="bouton-access">
                <a class="btn-access" href="/?page=compte_client">Retour au compte client</a>
            </div>
        </tbody>
    
    </table>
</div>

</main>



 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>