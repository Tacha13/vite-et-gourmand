<!-- Page tableau de bord administrateur -->

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

<section>
    <div>
        <a href="/?page=horaire_create">Ajouter un horaire</a>
    </div>
</section>

<!-- Message de succès ou d'erreur de suppression d'un horaire -->
    <?php if (isset($_SESSION['successDeleteHoraire'])) { ?>
        <div class="flashMessage successDeleteHoraire">
        <p> <?=  htmlspecialchars($_SESSION['successDeleteHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['successDeleteHoraire']);
        }?>

    <?php if (isset($_SESSION['erreurDeleteHoraire'])) { ?>
        <div class="flashMessage erreurDeleteHoraire">
        <p> <?=  htmlspecialchars($_SESSION['erreurDeleteHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurDeleteHoraire']);
        }?>


<!-- Tableau affichant les informations des horaires -->
<table>
    <thead>
        <tr>
            <th>Jour</th>
            <th>Heure Début</th>
            <th>Heure Fin</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des horaires enregistrés en BDD -->      
<?php
// $horaires est injecté via require dans horaireController::showhoraires() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($horaires) || !is_array($horaires)) {
    $horaires = [];
}
?>

<?php foreach ($horaires as $horaire): ?>
    <tr>
        <td><?= htmlspecialchars($horaire['nomhoraire']) ?></td>
        <td><?= htmlspecialchars($horaire['typehoraire']) ?></td>
        <td><img src="" alt="Image du horaire"></td>
        <td><input type="button" value="Voir"></td>
        <td><a href="/?page=horaire_update&id=<?= ($horaire['id'])?>" class="detail">Modifier le horaire</a></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $horaire['id'] ?>">
                    <input name="entity" type="hidden" value="horaire">
                    <input type="submit" value="Supprimer">
                </form>
            </td>

    </tr>
<?php endforeach ?>
    <div>
        <a href="/?page=admin">Retour à la page administration</a>
    </div>
    
</tbody>
</table>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>