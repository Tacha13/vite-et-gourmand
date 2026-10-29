<!-- Page tableau de bord administrateur -->
<?php
/** @var array $horaires */
?>
<!--Contenu du head-->
<?php
    $title = "Horaires Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>


<!-- Message de succès de modification d'un horaire -->

    <?php if (isset($_SESSION['successUpdateHoraire'])) { ?>
        <div class="flashMessage successUpdateHoraire">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['successUpdateHoraire']);
        }?>


<!-- Tableau affichant les informations des horaires -->
<table>
    <thead>
        <tr>
            <th>Jour</th>
            <th>Heure Début</th>
            <th>Heure Fin</th>
            <th>Ouvert</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($horaires as $horaire): ?>
    <tr>
        <td><?= htmlspecialchars($horaire['jour']) ?></td>
        <td><?= htmlspecialchars(substr($horaire['heureDebut'] ?? "",0,5) ) ?></td>
        <td><?= htmlspecialchars(substr($horaire['heureFin'] ?? "",0,5)) ?></td>
        <?php if(($horaire['ouvert']) === 1): ?>
            <td>Ouvert</td>
        <?php else : ?>
            <td>Fermé</td>
        <?php endif ?>    
        <td><a href="/?page=horaire_update&id=<?= ($horaire['id'])?>" class="detail">Modifier le horaire</a></td>
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