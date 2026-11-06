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

<main class="container">
    <div>
        <h1 class="title-dashboard">Tableau de bord</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-3">
        <!-- Lien vers la page des menus -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=admin_menus">Les Menus</a>
        </div>

        <!-- Lien vers la page des avis -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=avis_validate">Les Avis</a>
        </div>

        <!-- Lien vers la page de la liste des commandes -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=admin_commandes">Liste des commandes</a>
        </div>

        <!-- Lien vers la page des plats -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=plats">Les plats</a>
        </div>

        <!-- Lien vers la page des allergènes -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=allergenes">Les allergènes</a>
        </div>

        <!-- Lien vers la page des horaires -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=admin_horaires">Les horaires</a>
        </div>

        <!-- Lien vers la page listing employé visible que par l'admin-->
        <?php  if((isset($_SESSION ['user_id']) && ($_SESSION ['user_role']) === 'admin')) :?>
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=employes">Employés</a>
        </div>

        <!-- Lien vers la page de création de compte employé visible que par l'admin -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=employe_create">Comptes employés</a>
        </div>

        <!--Lien vers la page des stats, pour l'admin -->
        <div class="col bloc-dashboard">
            <a class="link-dashboard" href="/?page=admin_statistiques">Statistiques</a>
        </div>
    </div>

<?php endif ?>
</main>

 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>
