    <!--Contenu du head-->
    <?php
    require __DIR__ . '/../partials/head.php';
    ?>
<body>
    
    <!--Contenu du header-->
    <?php
    require __DIR__ . '/../partials/header.php';
    ?>

    <div>
        <form action="" method="POST">
            <fieldset class="connexion">
                <legend>Connexion</legend>
            <div>
             <div>
                <label for="EmailInput">Email</label>
                <input id="EmailInput" name="email" type="email" required>
            </div><br>
            <div>
                <label for="PasswordInput">Mot de passe</label>
                <input id="PasswordInput" name="password" type="password" minlength="10" required>
            </div><br>
            <div>
                <a href="">Mot de passe oublié ?</a>
            </div><br>
            <div>
                <button type="submit">Validez</button>
            </div><br>
             <div>
                <a href="">Pas encore inscrit ? S'inscrire.</a>
            </div><br>
            </fieldset>
        </form>
    </div>

    


    <!--Contenu du footer-->
    <?php
    require __DIR__ . '/../partials/footer.php';
    ?>
</body>
</html>
