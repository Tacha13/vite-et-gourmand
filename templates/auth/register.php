    <!--Contenu du head-->
    <?php
    $title = "Inscritpion Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
    ?>
<body>
     <!--Contenu du header-->
    <?php
    require __DIR__ . '/../partials/header.php';
    ?>
    <?php if (isset($_SESSION['erreurFormPassword'])) { ?>
        <div class="flashMessage erreurFormPassword">
        <p> <?=  htmlspecialchars($_SESSION['erreurFormPassword']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurFormPassword']);
    }?>
    <?php if (isset($_SESSION['erreurDifferentPassword'])) { ?>
        <div class="flashMessage erreurDifferentPassword">
        <p> <?=  htmlspecialchars($_SESSION['erreurDifferentPassword']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurDifferentPassword']);
    }?>
     <?php if (isset($_SESSION['erreurEmailRegister'])) { ?>
        <div class="flashMessage erreurEmailRegister">
        <p> <?=  htmlspecialchars($_SESSION['erreurEmailRegister']) ?> </p>
        </div>
    <?php unset($_SESSION['erreurEmailRegister']);
    }?>

<main>
<div class="title-inscription">
    <h1>Inscription</h1>
</div>

<div class="inscription-text">
    <p>Bienvenue sur la page d'inscription.</p>
    <p>Une fois validée, vous aurez accès à votre espace privilégié et sécurisé.</p>
</div>
<section class="container-fluid inscription-section">
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col inscription-form">
        <form action="" method="POST">
            <fieldset class="inscription">
                <legend class="inscription-title">Inscription</legend>
            <div>
                <label for="NameInput">Nom</label>
                <input id="NameInput" name="name" type="text" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['name'] ?? "") ?>" required>
            </div> 
            <div>
                <label for="FirstnameInput">Prénom</label>
                <input id="FirstnameInput" name="firstname" type="text" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['firstname'] ?? "") ?>" required>
            </div>
             <div>
                <label for="EmailInput">Email</label>
                <input id="EmailInput" name="email" type="email" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['email'] ?? "") ?>" required>
            </div>
             <div>
                <label for="PhoneInput">Téléphone</label>
                <input id="PhoneInput" name="phone" type="tel" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['phone'] ?? "") ?>" required>
            </div>
            <div>
                <label for="AdressInput">Adresse</label>
                <input id="AdressInput" name="adress" type="text" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['adress'] ?? "") ?>" required>
            </div>
             <div>
                <label for="AdressAptInput">Complément adresse</label>
                <input id="AdressAptInput" name="adressAptInput" type="text" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['adressAptInput'] ?? "") ?>">
            </div>
             <div>
                <label for="PostalCode">Code Postal</label>
                <input id="PostalCode" name="postalCode" type="number" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['postalCode'] ?? "") ?>" required>
            </div>
            <div>
                <label for="CityInput">Commune</label>
                <input id="CityInput" name="city" type="text" value="<?= htmlspecialchars($_SESSION['saveSaisieRegister']['city'] ?? "") ?>" required>
            </div>
            <div>
                <label for="PasswordInput">Mot de passe</label>
                <input id="PasswordInput" name="password" type="password" minlength="10" required>
            </div>
            <div>
                Votre mot de passe doit contenir au moins :
                10 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.
            </div>
            <div>
                <label for="ValidatePasswordInput">Validez votre mot de passe</label>
                <input id="ValidatePasswordInput" name="passwordConfirm" type="password" required>
            </div>
            <div class="bouton-valider">
                <button class="btn-valider" type="submit">Validez</button>
            </div>
            <?php unset($_SESSION['saveSaisieRegister']);?>
            </fieldset>
        </form>
        </div>
        <div class="col inscription-img">
            <img src="/images/Saumon gourmet aux légumes inscription.png" alt="Image d'un plat au saumon gourmet" >
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

