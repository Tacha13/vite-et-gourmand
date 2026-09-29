<!-- Page de création de la commande -->
<?php
/** @var array $idClient */
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
    <h1 class="title-recap">Etape 1/2 avant validation de la commande</h1>
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

            <div class="nombreCommande">
            <label for="nombreCommande">Nombre de Personnes</label>
            <input id="nombreCommande" name="nombreCommande" type="number" min="<?= $idMenu['nbPersonneMin']?>" required>
            <p class="detail-min">Minimum <?= htmlspecialchars((string) $idMenu['nbPersonneMin']) ?> personnes</p>
            </div>
            </div>
        </div>
    
        <div class="col commande-form">
        
            <div class="commande-inner">
                <label for="nomCommande">Nom</label>
                <input id="nomCommande" name="nomCommande" type="text" value="<?= htmlspecialchars($idClient['nom'])  ?>" readonly>
            </div>
            <div class="commande-inner">
                <label for="prenomCommande">Prénom</label>
                <input id="prenomCommande" name="prenomCommande" type="text" value="<?= htmlspecialchars($idClient['prenom'])  ?>" readonly>
            </div>
            <div class="commande-inner">
                <label for="emailCommande">Adresse E-mail</label>
                <input id="emailCommande" name="emailCommande" type="email" value="<?= htmlspecialchars($idClient['email'])  ?>" readonly>
            </div>
            <div class="commande-inner">
                <label for="phoneCommande">Téléphone</label>
                <input id="phoneCommande" name="phoneCommande" type="tel" value="<?= htmlspecialchars($idClient['telephone'])  ?>" readonly>
            </div>
            <div class="commande-inner">
                <label for="adressLivraison">Adresse de livraison</label>
                <input id="adressLivraison" name="adressLivraison" type="text" required>
            </div>
            <div class="commande-inner">
                <label for="moreAdressLivraison">Complément adresse</label>
                <input id="moreAdressLivraison" name="moreAdressLivraison" type="text">
            </div>
            <div class="commande-inner">
                <label for="postalLivraison">Code Postal</label>
                <input id="postalLivraison" name="postalLivraison" type="text" required>
            </div>
            <div class="commande-inner">
                <label for="cityLivraison">Ville</label>
                <input id="cityLivraison" name="cityLivraison" type="text" required>
            </div>
            <div class="commande-inner">
                <label for="datePrestation">Date de la livraison</label>
                <input id="datePrestation" name="datePrestation" type="date" min="<?= date('Y-m-d', strtotime('+2DAY'))?>" required>
            </div>
            <div class="commande-inner">
                <label for="heurePrestation">Heure de la livraison</label>
                <input id="heurePrestation" name="heurePrestation" type="time" required>
            </div>
            
            <div class="commande-next">
                <button class="btn bouton-next" type="submit">Suivant</button>
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