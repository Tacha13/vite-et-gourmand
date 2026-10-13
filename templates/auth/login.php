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
<main>
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
                </div><br>
                <div class="forgotten-password">
                    <a class="forgotten-password-link" href="">Mot de passe oublié ?</a>
                </div><br>
                <div class="bouton-valider">
                    <button class="btn-valider" type="submit">Se connecter</button>
                </div><br>
                <div class="not-registered">
                    <a href="/?page=register">Pas encore inscrit ? S'inscrire.</a>
                </div><br>
            </div> 
        </form>
    </div>
</main>

    <!--Contenu du footer-->
    <?php
    require __DIR__ . '/../partials/footer.php';
    ?>
</body>
</html>
