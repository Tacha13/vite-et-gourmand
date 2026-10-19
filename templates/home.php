<!-- Page d'accueil -->
<?php
/** @var array $avisValide */
?>
<!--Contenu du head-->
<?php
    $title = "Accueil Vite & Gourmand";
    require __DIR__ . '/partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/partials/header.php';
?>


<main>
    <section class="hero">
        <div class="container-fluid">
        <h1 class="big-title">Vite & Gourmand</h1>
        <div class="hero-text">
            <p>Votre traiteur à Bordeaux depuis 25 ans.</p>
            <p>Menus raffinés pour vos événements</p>
        </div>

        
        <?php if (isset($_SESSION['commandeSuccess'])) { ?>
        <div class="flashMessage success">
        <p> <?=  htmlspecialchars($_SESSION['commandeSuccess']) ?> </p>
        </div>
        <?php unset($_SESSION['commandeSuccess']);
        }?>

        <?php if (isset($_SESSION['mailCommandeFailure'])) { ?>
        <div class="flashMessage commandeFailure">
        <p> <?=  htmlspecialchars($_SESSION['mailCommandeFailure']) ?> </p>
        </div>
        <?php unset($_SESSION['mailCommandeFailure']);
        }?>
        
        <div class="btns">
            <a href="/?page=menus" class="btn-menus">Voir nos menus</a>
            <a href="/?page=contact" class="btn-contact">Nous contacter</a>
        </div>
        </div>
    </section>

    <section class="presentation">
        <div class="container-fluid">
        <div class="row row-cols-md-2 bloc-pres">
            <div class="histo">
                <h3 class="histo-title">Qui sommes-nous ?</h3>
                <p class="histo-text">Vite & Gourmand, votre traiteur à Bordeaux depuis 25 ans.
                Depuis 25 ans, nous mettons notre savoir-faire et notre passion de la cuisine au service de vos moments importants. Nous vous proposons des menus raffinés et gourmands, pensés pour s’adapter à vos envies et à vos événements.
                Que ce soit pour un repas en famille, un anniversaire, une réception ou un événement professionnel, Vite & Gourmand vous accompagne pour faire de chaque occasion un moment savoureux et convivial.</p>
            </div>
            <div class="img-pres">
                <img src="/images/Couple traiteur.png" alt="Photo du couple Julie et José">
            </div>

        </div>
        </div>
    </section>


    <section class="review-container">
        <div class="container-fluid">
            <div class="row row-cols-md-3 g-4">
            <?php foreach ($avisValide as $avis): ?>
                <div class="col review">
                    <div class="review-inner">
                    <?php for($i = 1; $i <= $avis['note']; $i++): ?>
                        <i class="fa-solid fa-star"></i>
                    <?php endfor ?>
                    <p class="review-bold"><?= htmlspecialchars($avis['nomMenu']) ?></p>
                    <p><?= htmlspecialchars($avis['avis']) ?></p>
                    <p class="review-bold"><?= htmlspecialchars($avis['prenom']) ?> <?= htmlspecialchars($avis['nom'][0]) ?>.</p>
                    </div>
                </div>
            <?php endforeach ?>
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

