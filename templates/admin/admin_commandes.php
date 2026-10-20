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

<div>
    <h1 class="title-listCommandes">Liste des commandes</h1>
</div>

<!--Messages flash en cas de success de modification du statut de la commande-->
    
    <?php if (isset($_SESSION['successUpdateStatutCommande'])) { ?>
        <div class="flashMessage successUpdateStatutCommande">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateStatutCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['successUpdateStatutCommande']);
    }?>
<!--Messages flash en cas d'erreur lors de la modification du statut de la commande-->
    
    <?php if (isset($_SESSION['erreurUpdateStatutCommande'])) { ?>
        <div class="flashMessage erreurUpdateStatutCommande">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateStatutCommande']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurUpdateStatutCommande']);
    }?>


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
                <form action="/?page=admin_commandes" method="POST">
                    <input id="modifierCommande<?= $listCommande['id'] ?>" name="id" type="hidden" value="<?= $listCommande['id'] ?>">
                    <div>
                        <select id="actionStatut" name="statut">
                            <option value="">Modifier</option>
                            <option value="Accepté">Accepté</option>
                            <option value="En préparation">En préparation</option>
                            <option value="En cours de livraison">En cours de livraison</option>
                            <option value="Livrée">Livrée</option>
                            <option value="En attente du retour de matériel">En attente du retour de matériel</option>
                            <option value="Terminée">Terminée</option>
                        </select>
                        <button type="submit">Enregistrer</button>
                        </div>
                </form>

            </td>
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