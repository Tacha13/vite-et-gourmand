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
<!--Messages flash en cas de success de création d'un avis-->
    
    <?php if (isset($_SESSION['successAvis'])) { ?>
        <div class="flashMessage successAvis">
        <p> <?=  htmlspecialchars($_SESSION['successAvis']) ?> </p>
        </div>
    <?php unset($_SESSION['successAvis']);
    }?>
<!--Messages flash en cas d'erreur de création d'un avis-->
    
    <?php if (isset($_SESSION['erreurAvis'])) { ?>
        <div class="flashMessage erreurAvis">
        <p> <?=  htmlspecialchars($_SESSION['erreurAvis']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurAvis']);
    }?>


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
                    <button class="btn-avis" type="button" data-bs-toggle="modal" data-bs-target="#modalAvis<?=  $allCommande['id'] ?>">Laisser un avis</button>
                    <div class="modal fade" id="modalAvis<?=  $allCommande['id'] ?>" tabindex="-1" aria-labelledby="modalAvisLabel<?=  $allCommande['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                            

                                <h1 class="modal-title fs-5" id="modalAvisLabel<?=  $allCommande['id'] ?>">Avis</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/?page=avis" method="POST">
                            <div class="modal-body">
                               
                                    <legend class="avis-title">Donnez votre avis</legend>
                                <div>
                                    <label for="note<?=  $allCommande['id'] ?>">Note</label>
                                    <input id="note<?=  $allCommande['id'] ?>" name="note" type="number" min="1" max="5" required>
                                </div> 
                                <div>
                                    <label for="avis<?=  $allCommande['id'] ?>">Avis</label>
                                    <textarea id="avis<?=  $allCommande['id'] ?>" name="avis" maxlength="250" required></textarea>
                                </div>
                                <div>
                                    <input id="commandeId<?=  $allCommande['id'] ?>" name="commandeId" type="hidden" value="<?=  $allCommande['id'] ?>"  >
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>

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