<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Page admin Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!-- Lien vers la page des menus -->
<div>
    <a href="/?page=admin_menus">les Menus</a>
</div>

<!-- Lien vers la page des plats -->
<div>
    <a href="/?page=plats">Les plats</a>
</div>

<!-- Lien vers la page des allergènes -->
<div>
    <a href="/?page=allergenes">Les allergènes</a>
</div>

<!-- Lien vers la page listing employé visible que par l'admin-->
<?php  if((isset($_SESSION ['user_id']) && ($_SESSION ['user_role']) === 'admin')) :?>
<div>
    <a href="/?page=employes">Employés</a>
</div>

<!-- Lien vers la page de création de compte employé visible que par l'admin -->
<div>
    <a href="/?page=employe_create">Comptes employés</a>
</div>
<?php endif ?>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
