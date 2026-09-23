<!-- Page de contact -->

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
    <h1>Contactez-nous</h1>
</div>
<div class="contact-text">
    <p>Une question, une demande de devis ou besoin d’un renseignement ?</p>
    <p>L’équipe Vite & Gourmand est à votre écoute et vous répondra dans les meilleurs délais.</p>
</div>

<section class="container-fluid">
<div class="row row-cols-1 row-cols-md-2">
    
    <div class="col contact-form">
        <form action="" method="POST">
            <div>
                <label for="nomContact">Nom</label>
                <input id="nomContact" name="nomContact" type="text" required>
            </div>
            <div>
                <label for="prenomContact">Prénom</label>
                <input id="prenomContact" name="prenomContact" type="text" required>
            </div>
             <div>
                <label for="emailContact">Adresse E-mail</label>
                <input id="emailContact" name="emailContact" type="email" required>
            </div>
             <div>
                <label for="phoneContact">Téléphone</label>
                <input id="phoneContact" name="phoneContact" type="tel" required>
            </div>
            <div>
                <label for="subjectContact">Objet</label>
                <input id="subjectContact" name="subjectContact" type="text" required>
            </div>
            <div>
                <label for="messageContact">Message</label>
                <textarea id="messageContact" name="messageContact" required></textarea>
            </div>
            
            <div>
                <button class="btn-contact" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
        <div class="col contact-main">
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