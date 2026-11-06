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

<main class="container">

    <div class="title-adminPlats">
        <h1>Gestion des plats</h1>
    </div>

    <section>
        <div class="add-plat">
            <a href="/?page=plat_create" class="addPlat">Ajouter un plat</a>
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


    <!-- Tableau affichant les informations des plats -->
<div class="mb-4 table-responsive table-stat">

    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th colspan="2" class="text-center">Actions</th>
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
            <td><a href="/?page=plat_update&id=<?= ($plat['id'])?>" class="admin-action-plat">Modifier le plat</a></td>

                <td class="admin-delete-menu">
                    <form action="/?page=delete_confirm" method="POST">
                        <input name="id" type="hidden" value="<?=  $plat['id'] ?>">
                        <input name="entity" type="hidden" value="plat">
                        <input type="submit" value="Supprimer">
                    </form>
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