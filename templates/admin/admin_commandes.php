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
                <button type="submit" class="bouton">Modifier</button>
                <button type="submit" class="bouton">supprimer</button>
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