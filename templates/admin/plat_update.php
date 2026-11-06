<!-- Page de mise à jour des plats -->
<?php
/** @var array $platModifier */
?>
<!--Contenu du head-->
<?php
    $title = "Mise à jour des plats Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>
<main class="container">

<div>
    <h1 class="title-updatePlat">Modification du plat : <?= htmlspecialchars($platModifier['nomPlat']) ?></h1>
</div>


<?php if (isset($_SESSION['erreurUpdatePlat'])) { ?>
        <div class="flashMessage erreurUpdatePlat">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdatePlat']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdatePlat']);
        }?>

<form action="/?page=plat_update" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3">
    <input id="modifierPlat<?= $platModifier['id'] ?>" name="id" type="hidden" value="<?= $platModifier['id'] ?>">
        <div class="col">
            <label class="form-label" for="namePlat">Nom du plat</label>
            <input class="form-control" type="text" name="namePlat" id="namePlat" value="<?= htmlspecialchars($platModifier['nomPlat']) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="typePlat">Type de plat</label>
            <input class="form-control" type="text" name="typePlat" id="typePlat" value="<?= htmlspecialchars($platModifier['typePlat']) ?>">
        </div>
        <div class="boutons-adminEmploye">
            <button>Valider</button>
        </div>
        
</form>
    <div class="return-list">
            <a class="returnList" href="/?page=plats">Retour aux plats</a>
    </div>
</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>