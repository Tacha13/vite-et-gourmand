<!-- Page de validation de la commande -->
 
<?php
/** @var array $idMenu */
?>

<!--Contenu du head-->
<?php
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>

<main>
<div>
    <h1 class="title-recap">Etape 2/2 avant validation de la commande</h1>
</div>

<section class="container-fluid">
<form action="" method="POST">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col recap-commande">
            

            <div class="recap-inner">
            <h3 class="title-commande">Votre commande</h3>
            <h4 class="detail-title"><?= htmlspecialchars($idMenu['nomMenu']) ?></h4>
            <p class="detail-description"><?= htmlspecialchars($idMenu['description']) ?></p>
            <p class="detail-price">A partir de <?= htmlspecialchars((string) $idMenu['prix']) ?> € / personne</p>
            <img class="img-commande" src="/images/<?=(htmlspecialchars($idMenu['image']))?>" alt="Image du <?= htmlspecialchars($idMenu['nomMenu']) ?>" >

            <div class="recap-livraison">
                <div class="recap-presta">
                <p>Nombre de personnes :</p>
                <span><?= $_SESSION['commande']['nombreCommande']  ?></span>
                </div> 
                <div class="recap-presta">
                <p>Adresse :</p>
                <span><?= $_SESSION['commande']['adressLivraison']  ?></span>
                </div> 
                <div class="recap-presta">
                <p>Complément adresse :</p>
                <span><?= $_SESSION['commande']['moreAdressLivraison']?></span>
                </div> 
                <div class="recap-presta">
                <p>Code postal :</p>
                <span><?= $_SESSION['commande']['postalLivraison']  ?></span> 
                </div> 
                <div class="recap-presta">
                <p>Ville :</p>
                <span><?= $_SESSION['commande']['cityLivraison']  ?></span>  
                </div> 
                <div class="recap-presta">
                <p>Date de livraison :</p>
                <span><?= $_SESSION['commande']['datePrestation']  ?></span>
                </div> 
                <div class="recap-presta">
                <p>Heure de livraison :</p>
                <span><?= $_SESSION['commande']['heurePrestation']  ?></span> 
                </div> 
            </div>
            </div>
        </div>
    
        <div class="col valid-form">
                

            <div class="valid-recap">

            <h3 class="title-commande">TOTAL</h3>
            <div class="valid-prix">
                <div class="valid-inner">
                    <p>Sous-Total :</p>
                    <span><?= $_SESSION['commande']['prixMenu']  ?> €</span>
                </div>
                <div class="valid-inner">
                    <p>Frais de livraison :</p>
                    <span><?= $_SESSION['commande']['frais']  ?> €</span>
                </div>
                <div class="valid-inner">
                    <p>Réduction :</p>
                    <span><?= $_SESSION['commande']['remise']  ?> €</span>
                </div>
                <div class="valid-inner">
                    <p class="prix-total">Total :</p>
                    <span class="prix-total"><?= $_SESSION['commande']['prixTotalCommande']  ?> €</span>
                </div>
            </div>
                <div class="commande-next">
                    <button class="bouton-next" type="submit">Valider</button>
                </div>
            </div>    
        </div>       
    </div>
</form>
    

</section>

</main>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>