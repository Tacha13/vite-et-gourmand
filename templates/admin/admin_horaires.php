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
<main class="container">

    <div class="title-adminHoraires">
        <h1>Gestion des horaires</h1>
    </div>

<!-- Message de succès de modification d'un horaire -->

    <?php if (isset($_SESSION['successUpdateHoraire'])) { ?>
        <div class="flashMessage successUpdateHoraire">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['successUpdateHoraire']);
        }?>


<!-- Tableau affichant les informations des horaires -->
<div class="mb-4 table-responsive table-stat">

    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th>Ouvert</th>
                <th class="text-center">Action</th>
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
            <td class="text-center"><a href="/?page=horaire_update&id=<?= ($horaire['id'])?>" class="admin-action-horaire ">Modifier l'horaire</a></td>
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