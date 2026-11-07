<!-- Page Menu -->

<!--Contenu du head-->
<?php
    $title = "Gestion menus Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>
<main class="container">

<div class="title-adminMenus">
    <h1>Gestion des menus</h1>
</div>

<!-- Message de succès ou d'erreur de suppression d'un menu -->
    <?php if (isset($_SESSION['successDeleteMenu'])) { ?>
        <div class="flashMessage successDeleteMenu">
        <p> <?=  htmlspecialchars($_SESSION['successDeleteMenu']) ?> </p>
        </div>
        <?php unset($_SESSION['successDeleteMenu']);
        }?>

    <?php if (isset($_SESSION['erreurDeleteMenu'])) { ?>
        <div class="flashMessage erreurDeleteMenu">
        <p> <?=  htmlspecialchars($_SESSION['erreurDeleteMenu']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurDeleteMenu']);
        }?>

<?php if (isset($_SESSION['successUpdateMenu'])) { ?>
        <div class="flashMessage successUpdateMenu">
        <p> <?=  htmlspecialchars($_SESSION['successUpdateMenu']) ?> </p>
        </div>
        <?php unset($_SESSION['successUpdateMenu']);
        }?>

<section>
    <div class="add-menu">
        <a href="/?page=menu_create" class="addMenu">Ajouter un menu</a>
    </div>
</section>

<!-- Tableau affichant les informations du menu -->

<div class="mb-4 table-responsive table-stat">
<table class="table align-middle table-striped table-grey table-hover">
        <caption></caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Thème</th>
                <th>Régime</th>
                <th>Images</th>
                <th>Prix</th>
                <th colspan="3" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
    <!--Boucle permettant d'alimenter dynamiquement la page des menus enregistrés en BDD -->      
    <?php
    // $menus est injecté via require dans MenuController::showMenus() — isset() évite l'avertissement VSCode sur la variable non déclarée
    if (!isset($menus) || !is_array($menus)) {
        $menus = [];
    }
    ?>

    <?php foreach ($menus as $menu): ?>
        <tr>
            <td><?= htmlspecialchars($menu['nomMenu']) ?></td>
            <td><?= htmlspecialchars($menu['theme']) ?></td>
            <td><?= htmlspecialchars($menu['regime']) ?></td>
            <td><img class="admin-img" src="/images/<?=($menu['image'])?>" alt="Image du <?= htmlspecialchars($menu['nomMenu']) ?>"></td>
            <td><?= htmlspecialchars(number_format($menu['prix'], 2, ',', ' ')) ?></td>
            <td><a href="/?page=menu_details&id=<?= ($menu['id'])?>" class="admin-action-menu">Voir le menu</a></td>
            <td><a href="/?page=menu_update&id=<?= ($menu['id'])?>" class="admin-action-menu">Modifier le menu</a></td>
                <td class="admin-delete-menu">
                    <form action="/?page=delete_confirm" method="POST">
                        <input name="id" type="hidden" value="<?=  $menu['id'] ?>">
                        <input name="entity" type="hidden" value="menu">
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