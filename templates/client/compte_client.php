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
<!--Messages flash en cas de succès de saisie-->
    
    <?php if (isset($_SESSION['successUpdate'])) { ?>
        <div class="flashMessage successUpdate">
        <p> <?=  htmlspecialchars($_SESSION['successUpdate']) ?> </p>
        </div>
    <?php unset($_SESSION['successUpdate']);
    }?>

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
            <h2 class="personal-title">Mes informations personnelles</h2>
            <div class="bouton-access">
                <a class="btn-access" href="/?page=infos_personnelles">Accéder à mes informations</a>
            </div>
        </div>
        <div class="col">
            <div class="col inprogress-commande">
            <h2 class="personal-title">Commande(s) en cours</h2>
            <div class="inprogress-inner">
                <?php $encours = false; ?>
                
                <?php foreach ($allCommandes as $allCommande): ?>
                    <?php if ($allCommande['statut'] !== 'Terminée' && $allCommande['statut'] !== 'Annulée'): ?>
                        <p> <strong>Numéro : </strong><?= htmlspecialchars($allCommande['numero']) ?> / <strong>Statut :</strong> <?= htmlspecialchars($allCommande['statut']) ?></p>  
                        <?php $encours = true; ?>
                    <?php endif ?>
                <?php endforeach ?>
                    
                <?php if ($encours === false) : ?>
                        <p>Il n'y a pas de commande en cours.</p>  
                <?php endif ?>
            </div>
        </div>
        <div class="col histo-commande">
            <h2 class="personal-title">Mon historique de commandes</h2>
            <div class="bouton-access">
                <a class="btn-access" href="/?page=histo_commandes">Accéder à l'historique</a>
            </div>
           
        </div>
        
    </div>
</section>
</main>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>