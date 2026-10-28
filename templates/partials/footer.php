<?php 
use Tacha\ViteEtGourmand\Repository\HoraireRepository;
use Tacha\ViteEtGourmand\Database;


$data = new Database();
$horaireRepo = new HoraireRepository($data);

$horaires = $horaireRepo->findAll();
?>

<footer class="footer">
    <div class="row row-cols-3 row-cols-md-3 g-4 mon-footer">
        <div class="col">
            <h3 class="footer-title">Contact</h3>
            <div class="footer-inner">
                <p>2 rue des Vignes</p>
                <p>33000 BORDEAUX</p>
                <p>05.11.22.33.44</p>
                <p>Contact : contact@vitegourmand.fr</p>
            </div>
        </div>
        <div class="col">
            <h3 class="footer-title">Horaires</h3>
            <div class="footer-inner">
                <?php foreach ($horaires as $horaire): ?>
                    <?php if($horaire['ouvert'] !== 0) : ?>
                    <p><?= htmlspecialchars($horaire['jour']) . ' : ' . htmlspecialchars(substr($horaire['heureDebut'],0,5)) . ' - ' . htmlspecialchars(substr($horaire['heureFin'],0,5))?></p>
                    <?php else :?>
                    <p><?= htmlspecialchars($horaire['jour']) . ' : ' . 'Fermé'?></p>
                    <?php endif ?>
                <?php endforeach ?>
                <p>Retrait des commandes sur rendez-vous</p>
            </div>
        </div>
        <div class="col">
            <h3 class="footer-title">Informations légales</h3>
            <div class="footer-inner">
                <p>Mentions légales</p>
                <p>Politique de confidentialité</p>
                <p>Conditions Générales de Vente</p>
                    <div class="contact">
                        <a class="contact-link" href="/?page=contact">Nous contacter</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        © 2026 Vite & Gourmand. Tous droits réservés.
    </div>
</footer>
