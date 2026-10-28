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

    


<!-- Section pour les filtres -->
 
<section>
    <div>
        <a href="/?page=menu_create">Ajouter un menu</a>
    </div>
</section>

<!-- Tableau affichant les informations du menu -->
<table>
    <caption>Menu 1</caption>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Thème</th>
            <th>Images</th>
            <th>Prix</th>
            <th>Actions</th>
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
        <td><img src="" alt="Image du menu"></td>
        <td><?= htmlspecialchars(number_format($menu['prix'], 2, ',', ' ')) ?></td>
        <td><input type="button" value="Voir"></td>
        <td><a href="/?page=menu_update&id=<?= ($menu['id'])?>" class="detail">Modifier le menu</a></td>

            <td>
                <form action="/?page=delete_confirm" method="POST">
                    <input name="id" type="hidden" value="<?=  $menu['id'] ?>">
                    <input name="entity" type="hidden" value="menu">
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