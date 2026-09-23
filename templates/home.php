<!-- Page d'accueil -->

<!--Contenu du head-->
<?php
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
                <div class="col review">
                    <div class="review-inner">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p class="review-bold">Evenement familial</p>
                    <p>« Un vrai régal ! Les menus étaient délicieux et parfaitement présentés. Toute la famille a apprécié, et l’équipe a été très professionnelle. Nous recommandons sans hésiter ! »</p>
                    <p class="review-bold">Sophie M. - Bordeaux</p>
                    </div>
                </div>
                <div class="col review">
                    <div class="review-inner">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p class="review-bold">Evenement professionnel</p>
                    <p>« Nous avons fait appel à Vite & Gourmand pour un événement professionnel. Les plats étaient raffinés, savoureux et très appréciés de nos invités. Une prestation de qualité ! »</p>
                    <p class="review-bold">Thomas R. - Bordeaux</p>
                    </div>
                </div>
                <div class="col review">
                    <div class="review-inner">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <p class="review-bold">Anniversaire</p>
                    <p>« Une très belle découverte ! Des produits savoureux, des portions généreuses et un service impeccable. Notre anniversaire a été une réussite grâce à Vite & Gourmand. »</p>
                    <p class="review-bold">Claire D. - Bordeaux</p>
                    </div>
                </div>
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

