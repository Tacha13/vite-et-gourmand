<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Liste allergènes Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

    <div class="title-adminAllergenes">
        <h1>Gestion des allergènes</h1>
    </div>

    <!-- Message de succès ou d'erreur de suppression d'un allergene -->
        <?php if (isset($_SESSION['successUpdateAllergene'])) { ?>
            <div class="flashMessage successUpdateAllergene">
            <p> <?=  htmlspecialchars($_SESSION['successUpdateAllergene']) ?> </p>
            </div>
            <?php unset($_SESSION['successUpdateAllergene']);
            }?>

    <section>
        <div class="add-allergene">
            <a href="/?page=allergenes" class="addAllergene">Ajouter un allergène</a>
        </div>
    </section>

    <!-- Message de succès ou d'erreur de suppression d'un plat -->
        <?php if (isset($_SESSION['successDeleteAllergene'])) { ?>
            <div class="flashMessage successDeleteAllergene">
            <p> <?=  htmlspecialchars($_SESSION['successDeleteAllergene']) ?> </p>
            </div>
            <?php unset($_SESSION['successDeleteAllergene']);
            }?>

    <!-- Tableau affichant les informations des allerènes -->

<div class="mb-4 table-responsive table-stat">

    <table class="table align-middle table-striped table-grey table-hover">
        <thead>
            <tr>
                <th>Nom de l'allergène</th>
                <th colspan="2" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
    <!--Boucle permettant d'alimenter dynamiquement la page des allergenes enregistrés en BDD -->      
    <?php
    // $allergenes est injecté via require dans Controller: — isset() évite l'avertissement VSCode sur la variable non déclarée
    if (!isset($allergenes) || !is_array($allergenes)) {
        $allergenes = [];
    }
    ?>

    <?php foreach ($allergenes as $allergene): ?>
        <tr>
            <td><?= htmlspecialchars($allergene['nomAllergene']) ?></td>
            <td><a href="/?page=allergene_update&id=<?= ($allergene['id'])?>" class="admin-action-allergene">Modifier l'allergène</a></td>
                <td class="admin-delete-allergene">
                    <form action="/?page=delete_confirm" method="POST">
                        <input name="id" type="hidden" value="<?=  $allergene['id'] ?>">
                        <input name="entity" type="hidden" value="allergene">
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

