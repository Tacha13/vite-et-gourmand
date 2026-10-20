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

<div class="title-avis">
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


<?php foreach ($avisEnAttente as $avis): ?>
    <div class="col">
        <div class="card h-100">
            <div class="card-inner">
                <p><?= htmlspecialchars($avis['nomMenu']) ?></p>
                <p><?= htmlspecialchars($avis['note']) ?></p>
                <p><?= htmlspecialchars($avis['avis']) ?></p>    
                <p><?= htmlspecialchars($avis['statutAvis']) ?></p>
                <p><?= htmlspecialchars($avis['numero']) ?></p>
                <p><?= htmlspecialchars($avis['nom']) ?></p>
                <p><?= htmlspecialchars($avis['prenom']) ?></p>
                
                <form action="/?page=avis_validate" method="POST">
                    <div>
                        <input id="idAvis<?= $avis['id'] ?>" name="idAvis" type="hidden" value="<?= $avis['id'] ?>">
                        <div>
                        <select id="actionValidateRefused" name="actionValidateRefused">
                            <option value="">Choix</option>
                            <option value="Validé">Validé</option>
                            <option value="Refusé">Refusé</option>
                        </select>
                        </div>
                    </div>
                    <div class="bouton-valider">
                    <button class="btn-valider" type="submit">Enregistrer</button>
                    </div>
                </form>
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
