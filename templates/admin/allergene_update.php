<!-- Page de mise à jour des allergenes -->
<?php
/** @var array $allergeneModifier */
?>
<!--Contenu du head-->
<?php
    $title = "Mise à jour des allergènes Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

<div>
    <h1 class="title-updateAllergene">Modification de l'allergène : <?= htmlspecialchars($allergeneModifier['nomAllergene']) ?></h1>
</div>

<!--Message erreur de MAJ de l'allergene -->
<?php if (isset($_SESSION['erreurUpdateAllergene'])) { ?>
        <div class="flashMessage erreurUpdateAllergene">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateAllergene']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateAllergene']);
        }?>

<form action="/?page=allergene_update" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3 align-items-end ">
    <input id="modifierAllergene<?= $allergeneModifier['id'] ?>" name="id" type="hidden" value="<?= $allergeneModifier['id'] ?>">
        <div class="col">
            <label class="form-label" for="nameAllergene">Nom de l'allergène</label>
            <input class="form-control" type="text" name="nomAllergene" id="nameAllergene" value="<?= htmlspecialchars($allergeneModifier['nomAllergene']) ?>"><br>
        </div>
        <div class="boutons-adminEmploye align-self-end">
            <button>Valider</button>
        </div>
</form>
        <div class="return-list">
            <a class="returnList" href="/?page=allergenes">Retour aux allergènes</a>
        </div>
</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>