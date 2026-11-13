    <!--Contenu du head-->
    <?php
    $title = "Réinitialisation du mot de passe Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
    ?>
<body>
    
    <!--Contenu du header-->
    <?php
    require __DIR__ . '/../partials/header.php';
    ?>

<main>
    <section class="passwordReset-img">
    <!--Flash messages -->
    
    <?php if (isset($_SESSION['erreurFormResetPassword'])) { ?>
    <div class="flashMessage erreurFormResetPassword">
    <p> <?=  htmlspecialchars($_SESSION['erreurFormResetPassword']) ?> </p>
    </div>
    <?php unset($_SESSION['erreurFormResetPassword']);
    }?>

    <?php if (isset($_SESSION['erreurDifferentResetPassword'])) { ?>
    <div class="flashMessage erreurDifferentResetPassword">
    <p> <?=  htmlspecialchars($_SESSION['erreurDifferentResetPassword']) ?> </p>
    </div>
    <?php unset($_SESSION['erreurDifferentResetPassword']);
    }?>


<div class="title-passwordReset">
    <h1>Réinitialisation du mot de passe</h1>
</div>

<div class="passwordReset-text">
    <p>Demande de réinitialisation du mot de passe.</p>
    <p>Veuillez renseigner votre nouveau mot de passe</p>
</div>

<section class="container">

    <div class="col passwordReset-form">
        <form action="" method="POST">
            <div class="passwordReset-inner">
            <legend class="legend-title">Renseignez votre nouveau mot de passe</legend>
                <div>
                <label for="PasswordInput">Mot de passe</label>
                <input id="PasswordInput" name="password" type="password" minlength="10" required>
            </div><br>
            <div>
                Votre mot de passe doit contenir au moins :
                10 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.
            </div><br>
            <div>
                <label for="ValidatePasswordInput">Validez votre mot de passe</label>
                <input id="ValidatePasswordInput" name="passwordConfirm" type="password" required>
            </div>
            <div class="bouton-valider">
                <button class="btn-valider" type="submit">Validez</button>
            </div>
            </div>
        </form>
    </div>
</section>
</section>
</main>

    <!--Contenu du footer-->
    <?php
    require __DIR__ . '/../partials/footer.php';
    ?>
</body>
</html>
