<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Création allergènes Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>


<main class="container">

<div>
    <h1 class="title-createAllergene">Création d'un allergène</h1>
</div>


<form action="/?page=allergene_create" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3 align-items-end">
        <div class="col">
            <label class="form-label" for="nameAllergene">Nom de l'allergène</label>
            <input class="form-control" type="text" name="allergene" id="nameAllergene"><br>
        </div>
        <div class="boutons-adminEmploye">
            <button>Valider</button>
        </div>
</form>
    <div class="return-list">
            <a class="returnList" href="/?page=allergenes">Retour aux allergènes</a>
    </div>
</main>
 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>