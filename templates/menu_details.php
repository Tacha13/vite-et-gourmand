<!-- Page Détails du Menu -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/partials/header.php';
?>

<!--Boucle permettant d'alimenter dynamiquement la page des menus enregistrés en BDD -->      
<?php
// $menus est injecté via require dans MenuController::showMenusPublic() — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($idMenu) || !is_array($idMenu)) {
    $idMenu = [];
}
?>

<main>

    <div>
        <h1 class="detail-title">Détails du menu : <?= htmlspecialchars($idMenu['nomMenu']) ?></h1>
    </div>
    <section class="container-fluid">
    <div class="main-detail">
    <div class="row row-cols-2 row-cols-md-2 g-4 container-detail">
        <div class="col detail-inner">
            <h3 class="detail-title"><?= htmlspecialchars($idMenu['nomMenu']) ?></h3>
            <p class="detail-description"><?= htmlspecialchars($idMenu['description']) ?></p>
            <p class="detail-price">A partir de <?= htmlspecialchars((string) $idMenu['prix']) ?> € / personne</p>
            <p class="detail-min">Minimum <?= htmlspecialchars((string) $idMenu['nbPersonneMin']) ?> personnes</p>
            <p class="detail-condition"><?= htmlspecialchars($idMenu['conditions']) ?></p>
            <p class="detail-theme">Thème : <?= htmlspecialchars($idMenu['theme']) ?></p>
            <p class="detail-plat">A remplir avec les données de la table plats</p>
            <p class="detail-allergene"><?= htmlspecialchars($idMenu['allergenes']) ?></p>
        </div>

                <div class="col">
        <div class="main-img">
            <img src="/images/<?=($idMenu['image'])?>" alt="Image du <?= htmlspecialchars($idMenu['nomMenu']) ?>" >
        </div>
        <div class="row row-cols-2 row-cols-md-2 detail-img">
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
    <div class="col boutons">
        <a class="btn-command" href="#">Commander</a>
        <a class="btn-menu" href="#">Retour aux menus</a>
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