    <!--Contenu du head-->
    <?php
    $title = "Mot de passe oublié Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
    ?>
<body>
    
   
<main>
    <section class="passwordForget-img">
     <!--Contenu du header-->
    <?php
    require __DIR__ . '/../partials/header.php';
    ?>

    <?php if (isset($_SESSION['successPasswordForget'])) { ?>
        <div class="flashMessage successPasswordForget">
        <p> <?=  htmlspecialchars($_SESSION['successPasswordForget']) ?> </p>
        </div>
        <?php unset($_SESSION['successPasswordForget']);
        }?>

    <?php if (isset($_SESSION['erreurPasswordReset'])) { ?>
    <div class="flashMessage erreurPasswordReset">
    <p> <?=  htmlspecialchars($_SESSION['erreurPasswordReset']) ?> </p>
    </div>
    <?php unset($_SESSION['erreurPasswordReset']);
    }?>

<div class="title-passwordForget">
    <h1>Mot de passe oublié - demande réinitialisation</h1>
</div>

<div class="passwordForget-text">
    <p>Demande de réinitialisation du mot de passe.</p>
    <p>Veuillez renseigner le champ ci-dessous. En validant, un email vous sera envoyé contenant un lien, valable une heure, qui vous permettra de réinitialiser votre mot de passe, si votre adresse correspond à un compte.</p>
</div>

<section class="container">

    <div class="col passwordForget-form">
        <form action="" method="POST">
            <div class="passwordForget-inner">
            <legend class="legend-title">Renseignez votre email</legend>
                <div>
                <div>
                    <label for="EmailInput">Email</label>
                    <input id="EmailInput" name="email" type="email" required>
                </div><br>
                
                <div class="bouton-envoyer">
                    <button class="btn-envoyer" type="submit">Envoyer</button>
                </div><br>
                <div class="return-login">
                    <a class="returnLogin" href="/?page=login">Retour à la page connexion</a>
                </div><br>
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
