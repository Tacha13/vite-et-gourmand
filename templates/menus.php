<!-- Page Menu -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/partials/header.php';
?>

<div>
    <h1 class="menu-title">Présentation de nos menus</h1>
</div>

<!-- Section pour les filtres -->
<section class="filter">
    
    <div>
        <select name="filter-theme" id="filter-theme">
            <option value="">Thème</option>
            <option value="noel">Noël</option>
            <option value="paques">Pâques</option>
            <option value="classique">Classique</option>
            <option value="event">Evenement</option>
        </select>
    </div>
    <div>
        <select name="filter-regime" id="filter-regime">
            <option value="">Règime</option>
            <option value="vegetarien">Végétarien</option>
            <option value="vegan">Vegan</option>
            <option value="classique">Classique</option>
        </select>
    </div>
    <div>
        <select name="filter-pers" id="filter-pers">
            <option value="">Nombre de personnes</option>
            <option value="first-range">2 à 6 personnes</option>
            <option value="secondary-range">6 à 10 personnes</option>
            <option value="third-range">10 personnes et +</option>
        </select>
    </div>
    <div>
        <select name="filter-min" id="filter-min">
            <option value="">Prix min (€/pers)</option>
            <option value="35">35€</option>
            <option value="45">45€</option>
            <option value="65">65€</option>
        </select>
    </div>
    <div class="filter-inner">
        <select name="filter-max" id="filter-max">
            <option value="">Prix max (€/pers)</option>
            <option value="35">35€</option>
            <option value="65">65€</option>
            <option value="85">85€</option>
        </select>
    </div>
    <div>
        <a href="#">Effacer les filtres</a>
    </div>
    
</section>


<!-- Vue globale des menus-->

<section class="menu">
    <div class="container-fluid">
    <div class="row row-cols-3 row-cols-md-3 g-5 menus">

<!--Boucle permettant d'alimenter dynamiquement la page des menus enregistrés en BDD -->      
<?php
// $menus est injecté via require dans MenuController::showMenusPublic() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($menus) || !is_array($menus)) {
    $menus = [];
}
?>

<?php foreach ($menus as $menu): ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-inner">
                <div><img src="/images/<?=($menu['image'])?>" alt="Image du <?= htmlspecialchars($menu['nomMenu']) ?>"></div>
                <h3 class="card-title"><?= htmlspecialchars($menu['nomMenu']) ?></h3>
                <p><?= htmlspecialchars($menu['theme']) ?></p>    
                <p><?= htmlspecialchars($menu['description']) ?></p>
                <p class="card-price">A partir de <?= htmlspecialchars((string) $menu['prix']) ?> € / personne</p>
                <p class="card-min">Minimum <?= htmlspecialchars((string) $menu['nbPersonneMin']) ?> personnes</p>
                <a href="/?page=menu_details&id=<?= ($menu['id'])?>" class="detail">Voir le détail</a>
            </div>
        </div>
    </div>
<?php endforeach ?>

    </div>
    </div>
</section>






 <!--Contenu du footer-->
<?php
    require __DIR__ . '/partials/footer.php';
?>
</body>
</html>