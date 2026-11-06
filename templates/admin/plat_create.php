<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Création plats Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

<div>
    <h1 class="title-createPlat">Création d'un plat</h1>
</div>


<form action="/?page=plat_create" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3">
        <div class="col">
            <label class="form-label" for="namePlat">Nom du plat</label>
            <input class="form-control" type="text" name="namePlat" id="namePlat">
        </div>
        <div class="col">
            <label class="form-label" for="typePlat">Type de plat</label>
            <input class="form-control" type="text" name="typePlat" id="typePlat">
        </div>
        <div class="boutons-adminEmploye">
            <button>Valider</button>
        </div>
</form>
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