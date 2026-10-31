<!-- Page tableau de bord statistiques admin -->
<?php
/** @var array $statMenus */
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
<div>
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
          beginAtZero: true
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