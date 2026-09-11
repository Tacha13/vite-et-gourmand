<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!-- Section pour les filtres -->
<section>
    <div>

    </div>
</section>

<!-- Tableau affichant les informations des allerènes -->
<table>
    <caption>Employes</caption>
    <thead>
        <tr>
            <th>Nom de l'employé</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des employes enregistrés en BDD -->      
<?php
// $employes est injecté via require dans Controller: — isset() évite l'avertissement VSCode sur la variable non déclarée
if (!isset($employes) || !is_array($employes)) {
    $employes = [];
}
?>

<?php foreach ($employes as $employe): ?>
    <tr>
        <td><?= htmlspecialchars($employe['nom']) ?></td>
        <td><?= htmlspecialchars($employe['prenom']) ?></td>
        <td><?= htmlspecialchars($employe['adresse']) ?></td>
        <td><?= htmlspecialchars($employe['complement_adresse']) ?></td>
        <td><?= htmlspecialchars($employe['code_postal']) ?></td>
        <td><?= htmlspecialchars($employe['commune']) ?></td>
        <td><?= htmlspecialchars($employe['email']) ?></td>
        <td><?= htmlspecialchars($employe['telephone']) ?></td>
        <td><?= htmlspecialchars($employe['role']) ?></td>
        <td><?= htmlspecialchars($employe['actif']) ?></td>

        <td><input type="button" value="Voir"></td>
        <td><input type="button" value="Modifier"></td>
        <td>
                <form action="/?page=toggle_actif" method="POST">
                    <input name="id" type="hidden" value="<?=  $employe['id'] ?>">
                    <input type="submit" value="<?= $employe['actif'] === 0 ? "Activer" : "Désactiver" ?>">
                </form>
            </td>

            

    </tr>
<?php endforeach ?>
    
</tbody>
</table>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
