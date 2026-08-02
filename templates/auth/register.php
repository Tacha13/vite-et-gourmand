
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div>
        <form action="" method="POST">
            <fieldset class="inscription">
                <legend>Inscription</legend>
            <div>
                <label for="NameInput">Nom</label>
                <input id="NameInput" name="name" type="text" required>
            </div><br> 
            <div>
                <label for="FirstnameInput">Prénom</label>
                <input id="FirstnameInput" name="firstname" type="text" required>
            </div><br>
             <div>
                <label for="EmailInput">Email</label>
                <input id="EmailInput" name="email" type="email" required>
            </div><br>
             <div>
                <label for="PhoneInput">Téléphone</label>
                <input id="PhoneInput" name="phone" type="tel" required>
            </div><br>
            <div>
                <label for="AdressInput">Adresse</label>
                <input id="AdressInput" name="adress" type="text" required>
            </div><br>
             <div>
                <label for="AdressAptInput">Complément adresse</label>
                <input id="AdressAptInput" name="adressAptInput" type="text">
            </div><br>
             <div>
                <label for="PostalCode">Code Postal</label>
                <input id="PostalCode" name="postalCode" type="number" required>
            </div><br>
            <div>
                <label for="CityInput">Commune</label>
                <input id="CityInput" name="city" type="text" required>
            </div><br>
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
                <input id="ValidatePasswordInput" name="PasswordConfirm" type="password" required>
            </div><br>
            <div>
                <button type="submit">Validez</button>
            </div><br>
            </fieldset>
        </form>
    </div>
    
</body>
</html>

