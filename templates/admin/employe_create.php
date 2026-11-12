<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    $title = "Création employés Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<main class="container">

<div>
    <h1 class="title-createEmploye">Création d'un employé</h1>
</div>


<form action="/?page=employe_create" method="POST" class="row row-cols-1 row-cols-md-2 mb-3 gy-3 align-items-end">
        <div class="col">
            <label class="form-label" for="nameEmploye">Nom de l'employé</label>
                <input class="form-control" type="text" name="nameEmploye" id="nameEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="prenomEmploye">Prénom de l'employé</label>
                <input class="form-control" type="text" name="prenomEmploye" id="prenomEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="adressEmploye">Adresse de l'employé</label>
                <input class="form-control" type="text" name="adressEmploye" id="adressEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="complAdressEmploye">Complément adresse</label>
                <input class="form-control" type="text" name="complAdressEmploye" id="complAdressEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="postalEmploye">Code postal</label>
                <input class="form-control" type="number" name="postalEmploye" id="postalEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="communeEmploye">Commune</label>
                <input class="form-control" type="text" name="communeEmploye" id="communeEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="emailEmploye">Email de l'employé</label>
                <input class="form-control" type="email" name="emailEmploye" id="emailEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="telEmploye">Téléphone de l'employé</label>
                <input class="form-control" type="text" name="telEmploye" id="telEmploye">
        </div>
        <div class="col">
            <label class="form-label" for="passwordEmploye">Mot de passe de l'employé</label>
                <input class="form-control" type="password" name="passwordEmploye" id="passwordEmploye">
        </div>
        <div class="boutons-adminEmploye">
            <button>Valider</button>
        </div>

</form>
    <div class="return-list">
        <a class="returnList" href="/?page=employes">Retour à la liste des employés</a>
    </div>
</main>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>