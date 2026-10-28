<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Plats Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<section>
    <div>
        <a href="/?page=plat_create">Ajouter un plat</a>
    </div>
</section>

<!-- Message de succès ou d'erreur de suppression d'un plat -->
    <?php if (isset($_SESSION['successDeletePlat'])) { ?>
        <div class="flashMessage successDeletePlat">
        <p> <?=  htmlspecialchars($_SESSION['successDeletePlat']) ?> </p>
        </div>
        <?php unset($_SESSION['successDeletePlat']);
        }?>

    <?php if (isset($_SESSION['erreurDeletePlat'])) { ?>
        <div class="flashMessage erreurDeletePlat">
        <p> <?=  htmlspecialchars($_SESSION['erreurDeletePlat']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurDeletePlat']);
        }?>

    <?php if (isset($_SESSION['successUpdatePlat'])) { ?>
        <div class="flashMessage successUpdatePlat">
        <p> <?=  htmlspecialchars($_SESSION['successUpdatePlat']) ?> </p>
        </div>
        <?php unset($_SESSION['successUpdatePlat']);
        }?>


<!-- Section pour les filtres -->
<section>
    <div>

    </div>
</section>

<!-- Tableau affichant les informations des plats -->
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Image</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des plats enregistrés en BDD -->      
<?php
// $plats est injecté via require dans PlatController::showPlats() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($plats) || !is_array($plats)) {
    $plats = [];
}
?>

<?php foreach ($plats as $plat): ?>
    <tr>
        <td><?= htmlspecialchars($plat['nomPlat']) ?></td>
        <td><?= htmlspecialchars($plat['typePlat']) ?></td>
        <td><img src="" alt="Image du plat"></td>
        <td><input type="button" value="Voir"></td>
        <td><a href="/?page=plat_update&id=<?= ($plat['id'])?>" class="detail">Modifier le plat</a></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $plat['id'] ?>">
                    <input name="entity" type="hidden" value="plat">
                    <input type="submit" value="Supprimer">
                </form>
            </td>

    </tr>
<?php endforeach ?>
    <div>
        <a href="/?page=dashboard">Retour à la page administration</a>
    </div>
    
</tbody>
</table>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>