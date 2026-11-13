    <!--Contenu du head-->
    <?php
    $title = "Connexion Vite & Gourmand";
    require __DIR__ . '/../partials/head.php';
    ?>
<body>
    
    <!--Contenu du header-->
    <?php
    require __DIR__ . '/../partials/header.php';
    ?>
<main>
    <section class="connexion">

     <?php if (isset($_SESSION['successRegister'])) { ?>
        <div class="flashMessage successRegister">
        <p> <?=  htmlspecialchars($_SESSION['successRegister']) ?> </p>
        </div>
        <?php unset($_SESSION['successRegister']);
        }?>

    <?php if (isset($_SESSION['erreurActif'])) { ?>
        <div class="flashMessage erreurActif">
        <p> <?=  htmlspecialchars($_SESSION['erreurActif']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurActif']);
        }?>

    <?php if (isset($_SESSION['erreurCompte'])) { ?>
        <div class="flashMessage erreurCompte">
        <p> <?=  htmlspecialchars($_SESSION['erreurCompte']) ?> </p>
        </div>
        <?php unset($_SESSION['erreurCompte']);
        }?>

    <?php if (isset($_SESSION['successUpdatePassword'])) { ?>
    <div class="flashMessage successUpdatePassword">
    <p> <?=  htmlspecialchars($_SESSION['successUpdatePassword']) ?> </p>
    </div>
    <?php unset($_SESSION['successUpdatePassword']);
    }?>

<div class="title-connexion">
    <h1>Connexion</h1>
</div>

<div class="connexion-text">
    <p>Accédez à votre espace client pour suivre vos devis et commandes.</p>
    <p>Accès réservé et sécurisé.</p>
</div>

<section class="container-fluid">
<div class="row row-cols-1 row-cols-md-2">

    <div class="col connexion-espace">
        <h3>Votre espace Vite & Gourmand :</h3>
        <div class="espace-inner">
            <ul>
                <li>Suivi des devis et commandes</li>
                <li>Historique et facturation</li>
            </ul>
        </div>
    </div>
    
    <div class="col connexion-form">
        <form action="" method="POST">
            <div class="connexion-inner">
                <legend class="legend-title">Connexion</legend>
                <div>
                <div>
                    <label for="EmailInput">Email</label>
                    <input id="EmailInput" name="email" type="email" required>
                </div><br>
                <div>
                    <label for="PasswordInput">Mot de passe</label>
                    <input id="PasswordInput" name="password" type="password" minlength="10" required>
                </div>
                <div class="forgotten-password">
                    <a class="forgotten-password-link" href="/?page=password_forget">Mot de passe oublié ?</a>
                </div>
                <div class="bouton-valider">
                    <button class="btn-valider" type="submit">Se connecter</button>
                </div>
                <div class="not-registered">
                    <a href="/?page=register">Pas encore inscrit ? S'inscrire.</a>
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
