<!-- Page de suivi des commandes -->
 
<?php
/** @var array $allStatuts */
?>

<!--Contenu du head-->
<?php
$title = "Suivi des commandes Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>

<main class="container">
<div>
    <h1 class="statut-title">Suivi des commandes</h1>
</div>



<div class="table-responsive histo-statut">
    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
            <th scope="col">Numéro</th>
            <th scope="col">Date changement de statut</th>
            <th scope="col">Statut</th>
            </tr>
        </thead>
        <tbody>
        <?php if(!empty($allStatuts)) : ?>
        <?php foreach ($allStatuts as $allStatut): ?>
            <tr>
            <td><?=  htmlspecialchars($allStatut['numero']) ?></td>
            <td><?=  htmlspecialchars($allStatut['dateChangement']) ?></td>
            <td><?=  htmlspecialchars($allStatut['statut']) ?></td>
            </tr>
        <?php endforeach ?>
        <?php else :?>
        <tr>
            <td colspan="3">Commande introuvable</td>
        </tr>
        <?php endif ?>
        <div class="bouton-access">
            <a class="btn-access" href="/?page=histo_commandes">Retour à l'historique des commandes</a>
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