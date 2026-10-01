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
    <h1>Etape 2/2 avant validation de la commande</h1>
</div>

<section class="container-fluid">
<form action="" method="POST">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col recap-commande">
            <h3 class="title-commande">Votre commande</h3>

            <div class="recap-inner">
        
            <h4 class="detail-title"><?= htmlspecialchars($idMenu['nomMenu']) ?></h4>
            <p class="detail-description"><?= htmlspecialchars($idMenu['description']) ?></p>
            <p class="detail-price">A partir de <?= htmlspecialchars((string) $idMenu['prix']) ?> € / personne</p>
            <img class="img-commande" src="/images/<?=(htmlspecialchars($idMenu['image']))?>" alt="Image du <?= htmlspecialchars($idMenu['nomMenu']) ?>" >

            <p>Nombre de personnes</p>
            <span><?= $_SESSION['commande']['nombreCommande']  ?></span>   
            <p>Adresse</p>
            <span><?= $_SESSION['commande']['adressLivraison']  ?></span>  
            <p>Complément adresse</p>
            <span><?= $_SESSION['commande']['moreAdressLivraison']?></span>  
            <p>Code postal</p>
            <span><?= $_SESSION['commande']['postalLivraison']  ?></span>  
            <p>Ville</p>
            <span><?= $_SESSION['commande']['cityLivraison']  ?></span>  
            <p>Date de livraison</p>
            <span><?= $_SESSION['commande']['datePrestation']  ?></span>  
            <p>Heure de livraison</p>
            <span><?= $_SESSION['commande']['heurePrestation']  ?></span>           

            </div>
        </div>
    
        <div class="col valid-form">
            <div class="valid-title">
                <h2>TOTAL</h2>
            </div>
        
            <div class="valid-inner">
                <p>Sous-Total</p>
                <span><?= $_SESSION['commande']['prixMenu']  ?> €</span>
            </div>
            <div class="valid-inner">
                <p>Frais de livraison</p>
                <span><?= $_SESSION['commande']['frais']  ?> €</span>
            </div>
            <div class="valid-inner">
                <p>Réduction</p>
                <span><?= $_SESSION['commande']['remise']  ?> €</span>
            </div>
            <div class="valid-inner">
                <p>Total</p>
                <span><?= $_SESSION['commande']['prixTotalCommande']  ?> €</span>
            </div>
           
            <div class="commande-next">
                <button class="btn bouton-next" type="submit">Valider</button>
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