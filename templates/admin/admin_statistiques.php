<!-- Page tableau de bord statistiques admin -->
<?php
/** @var array $statMenus */
/** @var array $menusFiltre */
/** @var array $menu */


?>
<!--Contenu du head-->
<?php
    $title = "Statistiques Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!-- Filtres stats -->
<form action="" method="get">
    <input type="hidden" name="page" value="admin_statistiques">
    <label for="menu">Menu</label>
    <select name="menu" id="menu">
    <option value="">Tous les menus</option>
    <?php foreach ($menusFiltre as $menuFiltre): ?>
    <option value="<?= htmlspecialchars($menuFiltre['_id']) ?>" <?= $menuFiltre['_id'] === $menu ? 'selected' : ''?>><?= htmlspecialchars($menuFiltre['_id']) ?></option>
    <?php endforeach ?>
    </select>
    <label for="dateDebut">Date début</label>
    <input type="date" name="dateDebut" id="dateDebut" value="<?= htmlspecialchars($dateDebut ??'') ?>">
    <label for="dateFin">Date Fin</label>
    <input type="date" name="dateFin" id="dateFin" value="<?= htmlspecialchars($dateFin ??'' ) ?>">

    <input type="submit" value="Valider">
</form>


<!-- Tableau affichant les informations des commandes pour stats -->
<table>
    <thead>
        <tr>
            <th>Nom du Menu</th>
            <th>Nombre de commandes</th>
            <th>Chiffre d'affaires</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($statMenus as $statMenu): ?>
    <tr>
        <td><?= htmlspecialchars($statMenu['_id']) ?></td>
        <td><?= htmlspecialchars(($statMenu['nbCommandes'])) ?></td>
        <td><?= htmlspecialchars(number_format($statMenu['chiffreAffaire'],2,',',' ')) ?> €</td>
    </tr>
<?php endforeach ?>
</tbody>
</table>
<div class="graph">
  <canvas id="myChart"></canvas>
</div>

<?php 
    $nomMenu = [];
    $nbCommande = [];

    foreach($statMenus as $statMenu) {
        $nomMenu[] = $statMenu['_id'];
        $nbCommande[] = $statMenu['nbCommandes'];
    }
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?=  json_encode($nomMenu) ?>,
      datasets: [{
        label: 'Nombre de commandes par menu',
        data: <?=  json_encode($nbCommande) ?>,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,

            ticks: {
                stepSize: 1
            }      
        }
    }
    }
});
</script>
    <div>
        <a href="/?page=admin">Retour à la page administration</a>
    </div>
    


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>