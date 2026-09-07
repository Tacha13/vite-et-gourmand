<!-- Page tableau de bord administrateur -->

<!--Contenu du head-->
<?php
    require __DIR__ . '/../partials/head.php';
?>
<body>
    
<!--Contenu du header-->
<?php
    require __DIR__ . '/../partials/header.php';
?>

<!-- Section pour les filtres -->
<section>
    <div>

    </div>
</section>

<!-- Tableau affichant les informations du menu -->
<table>
    <caption>Menu 1</caption>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Thème</th>
            <th>Images</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
<!--Boucle permettant d'alimenter dynamiquement la page des menus enregistrés en BDD -->      
<?php 
foreach ($menus as $menu) {
    echo ("<tr><td>" . $menu['nomMenu'] . "</td><td>" . $menu['theme'] . "</td><td>" .'<img src="" alt="Image du menu">' . "</td><td>" . $menu['prix'] . "</td><td>" . '<input type="button" value="Voir">' . '<input type="button" value="Modifier">' . '<input type="button" value="Supprimer">' . "</td></tr>");
}
?>
    </tbody>
</table>


 <!--Contenu du footer-->
<?php
    require __DIR__ . '/../partials/footer.php';
?>
</body>
</html>