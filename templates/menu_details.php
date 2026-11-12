<!-- Page Détails du Menu -->
<?php
/** @var array $plats */
/** @var array $idMenu */

?>
<!--Contenu du head-->
<?php
    $title = "Détails des menus Vite & Gourmand";
    require __DIR__ . '/partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/partials/header.php';
?>

<main>

    <div>
        <h1 class="detail-title">Détails du menu : <?= htmlspecialchars($idMenu['nomMenu']) ?></h1>
    </div>
    <section class="container-fluid">
    <div class="main-detail">
    <div class="row row-cols-1 row-cols-md-2 g-4 container-detail">
        <div class="col detail-inner">
            <h3 class="detail-title"><?= htmlspecialchars($idMenu['nomMenu']) ?></h3>
            <p class="detail-description"><?= htmlspecialchars($idMenu['description']) ?></p>
            <p class="detail-price">A partir de <?= htmlspecialchars(number_format($idMenu['prix'], 2, ',', ' ')) ?> € / personne</p>
            <p class="detail-min">Minimum <?= htmlspecialchars((string) $idMenu['nbPersonneMin']) ?> personnes</p>
            <p class="detail-condition"><?= htmlspecialchars($idMenu['conditions']) ?></p>
            <p class="detail-theme">Thème : <?= htmlspecialchars($idMenu['theme']) ?></p>
        </div>
        <div class="col">
            <div class="main-img">
                <img src="/images/<?=($idMenu['image'])?>" alt="Image du <?= htmlspecialchars($idMenu['nomMenu']) ?>" >
            </div>
            <div class="row row-cols-1 row-cols-md-3 detail-img">
                <div class="col">
                <img src="/images/Menu saveurs de saison 1.jpg" alt="Menu saveurs de saison 1.jpg">
                </div>
                <div class="col">
                <img src="/images/Menu saveurs de saison 2.jpg" alt="Menu saveurs de saison 2.jpg">
                </div>
                <div class="col">
                <img src="/images/Menu saveurs de saison 3.jpg" alt="Menu saveurs de saison 3.jpg">
            </div>            
        </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 detail-plat">
        <div class="col detail-bloc">
            <h3 class="detail-typePlat">Entrées : </h3>
            <?php foreach ($plats as $plat): ?>
                <?php if ($plat['typePlat'] === 'Entrée'): ?>
                <p class="detail-nomPlat"><?= htmlspecialchars($plat['nomPlat']) ?></p>
                <p class="detail-descriptionPlat"><?= htmlspecialchars($plat['description'] ?? '') ?></p>
                <p class="detail-allergenePlat"><?= htmlspecialchars($plat['allergenes'] ?? '') ?></p>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="col detail-bloc">
                <h3 class="detail-typePlat">Plat principal : </h3>
            <?php foreach ($plats as $plat): ?>
                <?php if ($plat['typePlat'] === 'Plat principal'): ?>
                <p class="detail-nomPlat"><?= htmlspecialchars($plat['nomPlat']) ?></p>
                <p class="detail-descriptionPlat"><?= htmlspecialchars($plat['description'] ?? '') ?></p>
                <p class="detail-allergenePlat"><?= htmlspecialchars($plat['allergenes'] ?? '') ?></p>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        <div class="col detail-bloc">
                <h3 class="detail-typePlat">Desserts : </h3>
            <?php foreach ($plats as $plat): ?>
                <?php if ($plat['typePlat'] === 'Dessert'): ?>
                <p class="detail-nomPlat"><?= htmlspecialchars($plat['nomPlat']) ?></p>
                <p class="detail-descriptionPlat"><?= htmlspecialchars($plat['description'] ?? '') ?></p>
                <p class="detail-allergenePlat"><?= htmlspecialchars($plat['allergenes'] ?? '') ?></p>
                <?php endif ?>
            <?php endforeach ?>
        </div>
        </div>
    <div class="col boutons">
        <a class="btn-menu" href="/?page=menus">Retour aux menus</a>
        <a class="btn-command" href="/?page=commande_create&menu_id=<?=  $idMenu['id'] ?>">Commander</a>
    </div>
    </div>

    
    </section>




</main>





 <!--Contenu du footer-->
<?php
    require __DIR__ . '/partials/footer.php';
?>
</body>
</html>