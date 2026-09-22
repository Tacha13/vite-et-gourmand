<!-- Page d'accueil -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/partials/header.php';
?>

<main>
<div class="title-contact">
    <h3>Contactez-nous</h3>
</div>
<div>
    <p>Une question, une demande de devis ou besoin d’un renseignement ?</p>
    <p>L’équipe Vite & Gourmand est à votre écoute et vous répondra dans les meilleurs délais.</p>
</div>

<section class="container-fluid">
<div class="row row-cols-2 row-cols-md-2">
    <div class="col">
        <form action="" method="POST">
            <div>
                <label for="nomContact">Nom</label>
                <input id="nomContact" name="nomContact" type="text" required>
            </div><br> 
            <div>
                <label for="prenomContact">Prénom</label>
                <input id="prenomContact" name="prenomContact" type="text" required>
            </div><br>
             <div>
                <label for="emailContact">Adresse E-mail</label>
                <input id="emailContact" name="emailContact" type="email" required>
            </div><br>
             <div>
                <label for="phoneContact">Téléphone</label>
                <input id="phoneContact" name="phoneContact" type="tel" required>
            </div><br>
            <div class="col">
                <label for="subjectContact">Objet</label>
                <input id="subjectContact" name="subjectContact" type="text" required>
            </div><br>
            <div>
                <label for="messageContact">Message</label>
                <textarea id="messageContact" name="messageContact" type="text"></textarea>
            </div><br>
            
            <div>
                <button type="submit">Envoyer</button>
            </div><br>
        </form>
    </div>
        <div class="col">
            <div>
            <h3 class="contact-title">Contact</h3>
            <div class="contact-inner">
                <p>2 rue des Vignes</p>
                <p>33000 BORDEAUX</p>
                <p>05.11.22.33.44</p>
                <p>Contact : contact@vitegourmand.fr</p>
            </div>
        </div>
        <div>
            <h3 class="contact-title">Horaires</h3>
            <div class="contact-inner">
                <p>Lundi - Vendredi 9h00 - 18h00</p>
                <p>Samedi 9h00 - 13h00</p>
                <p>Dimanche Fermé</p>
                <p>Retrait des commandes sur rendez-vous</p>
            </div>
        </div>
        <div>
            <h3 class="contact-title">Informations légales</h3>
            <div class="contact-inner">
                <p>Mentions légales</p>
                <p>Politique de confidentialité</p>
                <p>Conditions Générales de Vente</p>
                    <div class="contact">
                        <a class="contact-link" href="#">Nous contacter</a>
                    </div>
            </div>
        </div>
        </div>
    </div>

</section>

</main>









 <!--Contenu du footer-->
<?php
    require __DIR__ . '/partials/footer.php';
?>
</body>
</html>