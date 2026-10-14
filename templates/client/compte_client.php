<!-- Page du compte client -->
<?php
/** @var array $allCommandes */
?>
<!--Contenu du head-->
<?php
$title = "Compte client Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>
<main> 
<div>
    <h1 class="compte-title">Compte Client</h1>
    <div class="compte-text">
    <p>Dans cet espace, vous accédez à : </p>
    <p>- vos informations personnelles.</p>
    <p>- votre historique de commandes.</p>
    </div>
</div>

<section class="container-fluid">
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col">
            <h3 class="personal-title">Mes informations personnelles</h3>
            <div class="bouton-access">
                <button class="btn-access" type="submit">Accéder à mes informations</button>
            </div>
        </div>
        <div class="col">
            <div class="col inprogress-commande">
            <h3 class="personal-title">Commande(s) en cours</h3>
            <div>
                <?php $encours = false; ?>
                
                <?php foreach ($allCommandes as $allCommande): ?>
                    <?php if ($allCommande['statut'] !== 'Terminée' && $allCommande['statut'] !== 'Annulée'): ?>
                        <p>Numéro : <?= htmlspecialchars($allCommande['numero']) ?></p>  
                        <p>Statut : <?= htmlspecialchars($allCommande['statut']) ?></p>    
                        <?php $encours = true; ?>
                    <?php endif ?>
                <?php endforeach ?>
                    
                <?php if ($encours === false) : ?>
                        <p>Il n'y a pas de commande en cours.</p>  
                <?php endif ?>
            </div>
        </div><div class="col histo-commande">
            <h3 class="personal-title">Mon historique de commandes</h3>
            <div class="bouton-access">
                <button class="btn-access" type="submit">Accéder à l'historique</button>
            </div>
        </div>
        </div>
    </div>
</section>



</main>
<!--<?php foreach ($allCommandes as $allCommande): ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-inner">
                <p>Numéro de votre commande : <?= htmlspecialchars($allCommande['numero']) ?></p>    
                <p>Statut de votre commande :  <?= htmlspecialchars($allCommande['statut']) ?></p>    
                <p>Nom du menu choisi : <?= htmlspecialchars($allCommande['nomMenu']) ?></p>    
                <p>Adresse de la livraison : <?= htmlspecialchars($allCommande['adresseLivraison']) ?></p> 
                <?php if (isset($allCommande['complementLivraison'])): ?>
                        <p>Complément adresse de la livraison :  <?= htmlspecialchars($allCommande['complementLivraison']) ;?> </p>
                <?php endif ?>
                <p>Code postal de la livraison : <?= htmlspecialchars($allCommande['codePostalLivraison']) ?></p>    
                <p>Commune de la livraison : <?= htmlspecialchars($allCommande['communeLivraison']) ?></p>    
                <p>Date de la livraison : <?= htmlspecialchars($allCommande['datePrestation']) ?></p>    
                <p>Heure de la livraison : <?= htmlspecialchars($allCommande['heurePrestation']) ?></p>    
                <p>Nombre de convives : <?= htmlspecialchars((string) $allCommande['nbPersonneCommande']) ?></p>  
                <p>Prix total de votre commande: <?= htmlspecialchars(number_format($allCommande['prixTotal'],2, ',', ' ')) ?> €</p>  
                <p>Frais de livraison : <?= htmlspecialchars(number_format($allCommande['fraisLivraison'],2, ',', ' ')) ?> €</p>  
                <p>Montant de la réduction : <?= htmlspecialchars(number_format($allCommande['montantRemise'],2, ',', ' ')) ?> €</p>
                <?php if (isset($allCommande['motifAnnulation'])): ?>
                        <p>Motif d'annulation :  <?= htmlspecialchars($allCommande['motifAnnulation']) ;?> </p>
                <?php endif ?>
                <p>Date de création de votre commande : <?= htmlspecialchars($allCommande['dateCreation']) ?></p>  
            </div>
        </div>
    </div>
<?php endforeach ?>-->

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>