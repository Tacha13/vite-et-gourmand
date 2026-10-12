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
<h1 class="compte-title">Compte Client</h1>

<?php foreach ($allCommandes as $allCommande): ?>
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
                <p>Prix total de votre commande: <?= htmlspecialchars($allCommande['prixTotal']) ?> €</p>  
                <p>Frais de livraison : <?= htmlspecialchars($allCommande['fraisLivraison']) ?> €</p>  
                <p>Montant de la réduction : <?= htmlspecialchars($allCommande['montantRemise']) ?> €</p>
                <?php if (isset($allCommande['motifAnnulation'])): ?>
                        <p>Motif d'annulation :  <?= htmlspecialchars($allCommande['motifAnnulation']) ;?> </p>
                <?php endif ?>
                <p>Date de création de votre commande : <?= htmlspecialchars($allCommande['dateCreation']) ?></p>  
            </div>
        </div>
    </div>
<?php endforeach ?>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>