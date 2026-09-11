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

<!-- Lien vers la page des menus -->
<div>
    <a href="/?page=menus">les Menus</a>
</div>

<!-- Lien vers la page des plats -->
<div>
    <a href="/?page=plats">Les plats</a>
</div>

<!-- Lien vers la page des allergènes -->
<div>
    <a href="/?page=allergenes">Les allergènes</a>
</div>

<!-- Lien vers la page listing employé -->
<div>
    <a href="/?page=employes">Employés</a>
</div>

<!-- Lien vers la page de création de compte employé -->
<div>
    <a href="/?page=employe_create">Comptes employés</a>
</div>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
