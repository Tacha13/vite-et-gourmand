<!-- Page de mise à jour des horaires -->
<?php
/** @var array $horaireModifier */
?>
<!--Contenu du head-->

<?php
    $title = "Mise à jour des horaires Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

<div>
    <h1 class="title-updateHoraire">Modification de l'horaire du <?= htmlspecialchars($horaireModifier['jour']) ?></h1>
</div>


<!--Message d'erreur de la mise à jour des horaires-->
<?php if (isset($_SESSION['erreurUpdateHoraire'])) { ?>
        <div class="flashMessage erreurUpdateHoraire">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateHoraire']);
        }?>

<form action="/?page=horaire_update" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3">
    <input id="modifierHoraire<?= $horaireModifier['id'] ?>" name="id" type="hidden" value="<?= $horaireModifier['id'] ?>">
        <div class="col">
            <label class="form-label" for="heureDebut">Heure de début</label>
            <input class="form-control" type="time" name="heureDebut" id="heureDebut" value="<?= htmlspecialchars(substr($horaireModifier['heureDebut'] ?? "",0,5) ) ?>">
        </div>
        <div class="col">
            <label class="form-label" for="heureFin">Heure de fin</label>
            <input class="form-control" type="time" name="heureFin" id="heureFin" value="<?= htmlspecialchars(substr($horaireModifier['heureFin'] ?? "",0,5) ) ?>">
        </div>
        <div class="col">
            <label for="filter-statut" class="form-label">Statut</label>
            <select name="open" id="open" class="form-select">          
            <option value="1" <?php if($horaireModifier['ouvert'] === 1): ?> selected <?php endif ?>>Ouvert</option>
            <option value="0" <?php if ($horaireModifier['ouvert'] === 0): ?> selected  <?php endif ?>>Fermé</option>
            </select>
        </div>
           <div class="col align-self-end">
            <button class="btn-enregistrer">Valider</button>
           </div>
</form>
        <div class="return-list">
            <a class="returnList" href="/?page=admin_horaires">Retour aux horaires</a>
        </div>
</main>
 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>