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

<!--Message d'erreur de la mise à jour des horaires-->
<?php if (isset($_SESSION['erreurUpdateHoraire'])) { ?>
        <div class="flashMessage erreurUpdateHoraire">
        <p> <?=  htmlspecialchars($_SESSION['erreurUpdateHoraire']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurUpdateHoraire']);
        }?>

<form action="/?page=horaire_update" method="POST">
    <input id="modifierHoraire<?= $horaireModifier['id'] ?>" name="id" type="hidden" value="<?= $horaireModifier['id'] ?>">

    <fieldset>
        <div>
            <h3>Horaires du <?= htmlspecialchars($horaireModifier['jour']) ?></h3>
            <label for="heureDebut">Heure de début</label>
            <input type="time" name="heureDebut" id="heureDebut" value="<?= htmlspecialchars(substr($horaireModifier['heureDebut'] ?? "",0,5) ) ?>"><br>
            <label for="heureFin">Heure de fin</label>
            <input type="time" name="heureFin" id="heureFin" value="<?= htmlspecialchars(substr($horaireModifier['heureFin'] ?? "",0,5) ) ?>"><br>
            <select name="open" id="open">          
            <option value="1" <?php if($horaireModifier['ouvert'] === 1): ?> selected <?php endif ?>>Ouvert</option>
            <option value="0" <?php if ($horaireModifier['ouvert'] === 0): ?> selected  <?php endif ?>>Fermé</option>
            </select>
           
            <input type="submit" value="Valider">
        </div>
        <div>
            <a href="/?page=admin_horaires">Retour aux horaires</a>
        </div>

    </fieldset>
</form>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>