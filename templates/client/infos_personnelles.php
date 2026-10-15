<!-- Page des informations personnelles du client -->


<!--Contenu du head-->
<?php
$title = "Validation commande Vite & Gourmand";
require __DIR__ . '/../partials/head.php';
?>
<body>
    <!--Contenu du header-->
<?php
require __DIR__ . '/../partials/header.php';
?>
<main>
<div class="title-inscription">
    <h1>Mes informations personnelles</h1>
</div>

<div class="inscription-text">
    <p>Bienvenue sur votre page.</p>
    <p>Vous pouvez mettre à jour vos coordonnées si celles-ci ont changé.</p>
</div>
        <div class="bouton-accessInfo">
                <a class="btn-access" href="/?page=compte_client">Retour au compte client</a>
        </div>
<section class="container-fluid inscription-section">
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col inscription-form">
        <form action="" method="POST">
            <fieldset class="inscription">
                <legend class="inscription-title">Informations</legend>
            <div>
                <label for="NameInput">Nom</label>
                <input id="NameInput" name="name" type="text" value="<?= htmlspecialchars($infoPersonal['nom'] ?? "") ?>" required>
            </div> 
            <div>
                <label for="FirstnameInput">Prénom</label>
                <input id="FirstnameInput" name="firstname" type="text" value="<?= htmlspecialchars($infoPersonal['prenom'] ?? "") ?>" required>
            </div>
             <div>
                <label for="EmailInput">Email</label>
                <input id="EmailInput" name="email" type="email" value="<?= htmlspecialchars($infoPersonal['email'] ?? "") ?>" required>
            </div>
             <div>
                <label for="PhoneInput">Téléphone</label>
                <input id="PhoneInput" name="phone" type="tel" value="<?= htmlspecialchars($infoPersonal['telephone'] ?? "") ?>" required>
            </div>
            <div>
                <label for="AdressInput">Adresse</label>
                <input id="AdressInput" name="adress" type="text" value="<?= htmlspecialchars($infoPersonal['adresse'] ?? "") ?>" required>
            </div>
             <div>
                <label for="AdressAptInput">Complément adresse</label>
                <input id="AdressAptInput" name="adressAptInput" type="text" value="<?= htmlspecialchars($infoPersonal['complement_adresse'] ?? "") ?>">
            </div>
             <div>
                <label for="PostalCode">Code Postal</label>
                <input id="PostalCode" name="postalCode" type="number" value="<?= htmlspecialchars($infoPersonal['code_postal'] ?? "") ?>" required>
            </div>
            <div>
                <label for="CityInput">Commune</label>
                <input id="CityInput" name="city" type="text" value="<?= htmlspecialchars($infoPersonal['commune'] ?? "") ?>" required>
            </div>
            
            <div class="bouton-valider">
                <button class="btn-valider" type="submit">Enregistrer</button>
            </div>
            <?php unset($_SESSION['saveSaisieRegister']);?>
            </fieldset>
        </form>
        </div>
        <div class="col inscription-img">
            <img src="/images/figues Infos Personnelles.jpg" alt="Image d'une assiette de figues" >
        </div>
        
    </div>
    
    
</section>
</main>






 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>