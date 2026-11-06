<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Liste employés Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>
<main class="container">
<div class="title-adminEmployes">
        <h1>Gestion des employés</h1>
    </div>

<section>
    <div class="add-employe">
        <a href="/?page=employe_create" class="addEmploye">Ajouter un employé</a>
    </div>
</section>

<!-- Tableau affichant les informations de l'employé -->
<div class="mb-4 table-responsive table-stat">

<table class="table align-middle table-striped table-grey table-hover">
    <thead>
        <tr>
            <th>Nom de l'employé</th>
            <th>Prénom de l'employé</th>
            <th>Adresse</th>
            <th>Complément adresse</th>
            <th>Code postal</th>
            <th>Commune</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
            <th>Actif (1: oui)</th>
            <th colspan="3" class="text-center">Actions</th>
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
        <td><?= ($employe['actif']) === 1 ? 'Oui' : 'Non' ?></td>

        <td class="admin-delete-menu">
            <form action="/?page=toggle_actif" method="POST">
                <input name="id" type="hidden" value="<?=  $employe['id'] ?>">
                <input type="submit" value="<?= $employe['actif'] === 0 ? "Activer" : "Désactiver" ?>">
            </form>
        </td>
    </tr>
<?php endforeach ?>
    
</tbody>
</table>
</div>
    <div class="return-admin">
        <a href="/?page=admin" class="returnAdmin">Retour à la page administration</a>
    </div>

</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
