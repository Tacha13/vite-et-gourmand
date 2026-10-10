    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img class="logo" src="/images/Logo vite et gourmand 2.png" alt="Logo traiteur Vite et Gourmand" width="75" height="75">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=menus">Menus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=contact">Contact</a>
                    </li>
                    <?php  if((isset($_SESSION ['user_id']) && ($_SESSION ['user_role']) === 'utilisateur')) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=compte_client">Compte Client</a>
                    </li>
                    <?php endif ?>
                    <?php  if((!isset($_SESSION ['user_id']))) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=register">Inscription</a>
                    </li>
                    <?php endif ?>
                    <?php  if(isset($_SESSION ['user_id']) && (($_SESSION ['user_role']) === 'admin' || ($_SESSION ['user_role']) === 'employe')) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=admin">Administration</a>
                    </li>
                    <?php endif ?>
                    <?php  if((isset($_SESSION ['user_id']))) :?>
                    <li class="nav-item">
                        <a class="nav-link" href="/?page=logout">Déconnexion</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>