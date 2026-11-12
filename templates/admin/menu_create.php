<!-- Page tableau de bord administrateur -->
<!--Contenu du head-->
<?php
    $title = "Création menus Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>
<main class="container">

<div>
    <h1 class="title-createMenu">Création d'un menu</h1>
</div>


<form action="/?page=menu_create" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3 align-items-end">
        <div class="col">
            <label class="form-label" for="imageMenu">Nom de l'image</label>
            <input class="form-control" type="text" name="image" id="imageMenu">
        </div>
        <div class="col">
            <label class="form-label" for="nameMenu">Nom du menu</label>
            <input class="form-control" type="text" name="nameMenu" id="nameMenu">
        </div>
        <div class="col">
            <label class="form-label" for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description">
        </div>
        <div class="col">
            <label class="form-label" for="theme">Thème</label>
            <input class="form-control" type="text" name="theme" id="theme">
        </div>
        <div class="col">
            <label class="form-label" for="persMin">Nombre de personnes minimum</label>
            <input class="form-control" type="number" name="persMin" id="persMin">
        </div>
        <div class="col">
            <label class="form-label" for="price">Prix</label>
            <input class="form-control" type="number" name="price" id="price" step="0.01">
        </div>
        <div class="col">
            <label class="form-label" for="conditions">Conditions</label>
            <input class="form-control" type="text" name="conditions" id="conditions">
        </div>
        <div class="col">
            <label class="form-label" for="regime">Régime</label>
            <input class="form-control" type="text" name="regime" id="regime">
        </div>
        <div class="col">
            <label class="form-label" for="stock">Stock</label>
            <input class="form-control" type="number" name="stock" id="stock">
        </div>
        <div class="boutons-adminEmploye">
            <button>Valider</button>
        </div>
</form>
    <div class="return-list">
        <a class="returnList" href="/?page=admin_menus">Retour aux menus</a>
    </div>
</main>
 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>