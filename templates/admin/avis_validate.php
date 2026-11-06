<!-- Page de validation des avis -->
<?php
/** @var array $avisEnAttente */
?>
<!--Contenu du head-->
<?php
    $title = "Page admin des avis Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>
<main class="container">

<div class="title-adminAvis">
    <h1>Liste des avis</h1>
</div>

<!--Messages flash en cas de success de validation ou de refus d'un avis-->
    
    <?php if (isset($_SESSION['successStatutAvis'])) { ?>
        <div class="flashMessage successStatutAvis">
        <p> <?=  htmlspecialchars($_SESSION['successStatutAvis']) ?> </p>
        </div>
    <?php unset($_SESSION['successStatutAvis']);
    }?>
<!--Messages flash en cas d'erreur lors de la validation ou le refus d'un avis-->
    
    <?php if (isset($_SESSION['erreurStatutAvis'])) { ?>
        <div class="flashMessage erreurStatutAvis">
        <p> <?=  htmlspecialchars($_SESSION['erreurStatutAvis']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurStatutAvis']);
    }?>
<?php if(!empty($avisEnAttente)) : ?>
<div class="row row-cols-1 row-cols-md-2 gy-4">

<?php foreach ($avisEnAttente as $avis): ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-inner-avis">
                <p><strong>Nom du menu : </strong><?= htmlspecialchars($avis['nomMenu']) ?></p>
                <p><strong>Note donnée : </strong><?= htmlspecialchars($avis['note']) ?> / 5</p>
                <p><strong>Avis :</strong> <?= htmlspecialchars($avis['avis']) ?></p>    
                <p><strong>Statut de l'avis : </strong><?= htmlspecialchars($avis['statutAvis']) ?></p>
                <p><strong>Numéro de la commande : </strong><?= htmlspecialchars($avis['numero']) ?></p>
                <p><strong>Nom du client : </strong><?= htmlspecialchars($avis['nom']) ?></p>
                <p><strong>Prénom du client : </strong><?= htmlspecialchars($avis['prenom']) ?></p>
                
                <form action="/?page=avis_validate" method="POST" class="row row-cols-1 row-cols-md-2">
                    <div>
                        <input id="idAvis<?= $avis['id'] ?>" name="idAvis" type="hidden" value="<?= $avis['id'] ?>">
                        <div>
                            <label for="actionAvis<?= $avis['id'] ?>" class="form-label">Décisions</label>
                            <select id="actionAvis<?= $avis['id'] ?>" name="actionValidateRefused" class="form-select">
                                <option value="">Choix</option>
                                <option value="Validé">Validé</option>
                                <option value="Refusé">Refusé</option>
                            </select>
                        </div>
                    </div>
                    <div class="bouton-valider">
                    <button class="btn-enregistrer" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php else :?>
        <div class="alert alert-info text-center" role="alert">
            <p>Aucun avis en attente de traitement</p>
        </div>
<?php endif ?>
</div>
        <div class="return-admin mt-4">
            <a href="/?page=admin" class="returnAdmin">Retour à la page administration</a>
        </div>
</main>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
