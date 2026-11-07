<!-- Page admin des commandes -->
<?php
/** @var array $listCommandes */
?>

<!--Contenu du head-->
<?php
    $title = "Gestion commandes Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

<div>
    <h1 class="title-listCommandes">Liste des commandes</h1>
</div>


<!--Messages flash en cas de success de MAJ de motif d'annulation-->
    
    <?php if (isset($_SESSION['successUpdateMotifAnnulCommande'])) { ?>
        <div class="flashMessage successUpdateMotifAnnulCommande">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateMotifAnnulCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['successUpdateMotifAnnulCommande']);
    }?>
<!--Messages flash en cas d'erreur sur le motif de la commande-->
    
    <?php if (isset($_SESSION['erreurUpdateMotifCommande'])) { ?>
        <div class="flashMessage erreurUpdateMotifCommande">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateMotifCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurUpdateMotifCommande']);
    }?>

<!--Messages flash en cas de success de MAJ du statut de la commande-->
    
    <?php if (isset($_SESSION['successUpdateStatutCommande'])) { ?>
        <div class="flashMessage successUpdateStatutCommande">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateStatutCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['successUpdateStatutCommande']);
    }?>
<!--Messages flash en cas d'erreur sur le statut de la commande-->
    
    <?php if (isset($_SESSION['erreurUpdateStatutCommande'])) { ?>
        <div class="flashMessage erreurUpdateStatutCommande">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateStatutCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurUpdateStatutCommande']);
    }?>

<!--Messages flash en cas d'erreur de contact de la commande-->

    
    <?php if (isset($_SESSION['erreurUpdateContactCommande'])) { ?>
        <div class="flashMessage erreurUpdateContactCommande">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateContactCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurUpdateContactCommande']);
    }?>

<!-- Section pour les filtres -->
<section class="filter-commandes">
    <form action="/" method="GET" class="row row-cols-1 row-cols-md-3 mb-4 gy-3">
        <input type="hidden" name="page" value="admin_commandes">
        <div class="col ">
            <label for="filter-statut" class="form-label">Statut</label>
            <select class="form-select" name="filter-statut" id="filter-statut">
                <option value="">Statut</option>
                <option value="En attente de validation">En attente de validation</option>
                <option value="Accepté">Accepté</option>
                <option value="En préparation">En préparation</option>
                <option value="En cours de livraison">En cours de livraison</option>
                <option value="Livrée">Livrée</option>
                <option value="En attente du retour de matériel">En attente du retour de matériel</option>
                <option value="Terminée">Terminée</option>
                <option value="Annulée">Annulée</option>
            </select>
        </div>
        <div class="col">
            <label for="nomClient" class="form-label">Nom du client</label>
            <input type="text" name="nomClient" id="nomClient" class="form-control"> 
        </div>
        <div class="col boutons-adminCommandes">
            <button>Valider</button>
            <a href="/?page=admin_commandes">Effacer les filtres</a>
        </div>
    </form>


<div class="table-responsive list-commandes">
    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Numéro</th>
            <th scope="col">Date de création</th>
            <th scope="col">Date de la prestation</th>
            <th scope="col">Heure de la prestation</th>
            <th scope="col">Statut</th>
            <th scope="col">Nom du menu</th>
            <th scope="col">Nom du client</th>
            <th scope="col">Prénom du client</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($listCommandes as $listCommande): ?>
            <tr>
            <td><?=  htmlspecialchars($listCommande['id']) ?></td>
            <td><?=  htmlspecialchars($listCommande['numero']) ?></td>
            <td><?=  htmlspecialchars($listCommande['dateCreation']) ?></td>
            <td><?=  htmlspecialchars($listCommande['datePrestation']) ?></td>
            <td><?=  htmlspecialchars($listCommande['heurePrestation']) ?></td>
            <td><?=  htmlspecialchars($listCommande['statut']) ?></td>
            <td><?=  htmlspecialchars($listCommande['nomMenu']) ?></td>
            <td><?=  htmlspecialchars($listCommande['nom']) ?></td>
            <td><?=  htmlspecialchars($listCommande['prenom']) ?></td>
            <td><?=  htmlspecialchars($listCommande['telephone']) ?></td>
            <td><?=  htmlspecialchars($listCommande['email']) ?></td>
            <td>
                <?php if ($listCommande['statut'] !== 'Terminée' && $listCommande['statut'] !== 'Annulée'): ?><div aria-hidden="true"></div>
                <form action="/?page=admin_commandes" method="POST">
                    <input id="modifierCommande<?= $listCommande['id'] ?>" name="id" type="hidden" value="<?= $listCommande['id'] ?>">
                    <div>
                        <label for="actionStatut<?= $listCommande['id'] ?>" class="form-label">Nouveau statut</label>
                        <select id="actionStatut<?= $listCommande['id'] ?>" name="statut" class="form-select">
                            <option value="">Modifier</option>
                            <option value="Accepté">Accepté</option>
                            <option value="En préparation">En préparation</option>
                            <option value="En cours de livraison">En cours de livraison</option>
                            <option value="Livrée">Livrée</option>
                            <option value="En attente du retour de matériel">En attente du retour de matériel</option>
                            <option value="Terminée">Terminée</option>
                        </select>
                        <button type="submit" class="btn-enregistrer">Enregistrer</button>
                        </div>
                </form>
                <form action="/?page=annuler_commande" method="POST">
                    <input id="annulerCommande<?= $listCommande['id'] ?>" name="id" type="hidden" value="<?= $listCommande['id'] ?>">
                    <label for="motifAnnulation<?= $listCommande['id'] ?>">Motif d'annulation</label>
                    <textarea name="motifAnnulation" id="motifAnnulation<?= $listCommande['id'] ?>" class="form-control"></textarea>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="modeContact" id="modeContactAppel<?= $listCommande['id'] ?>" value="Appel" class="form-check-input">
                            <label for="modeContactAppel<?= $listCommande['id'] ?>" class="form-check-label">Appel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="modeContact" id="modeContactEmail<?= $listCommande['id'] ?>" value="Email"  class="form-check-input">
                            <label for="modeContactEmail<?= $listCommande['id'] ?>" class="form-check-label">Email</label>
                        </div>

                        <button type="submit" class="btn-annuler">Enregistrer l'annulation</button>
                    </div>
                </form>
                <?php else :?>
                    <p>Aucune action</p>
                <?php endif ?>
            </td>
            </tr>
    <?php endforeach ?>
        </tbody>
    </table>
</div>
    <div class="return-admin">
        <a href="/?page=admin" class="returnAdmin">Retour à la page administration</a>
    </div>


</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>