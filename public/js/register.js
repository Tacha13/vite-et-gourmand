// récupérer le formulaire
const form = document.getElementById('formulaire');
// 2. écouter l'envoi du formulaire (événement 'submit')
form.addEventListener('submit', (event) => {
    //récupérer les valeurs des deux mots de passe
    const PasswordInput = document.getElementById('PasswordInput').value;
    const ValidatePasswordInput = document.getElementById('ValidatePasswordInput').value;
    //si les deux sont différents : bloquer l'envoi + afficher un message
    if (PasswordInput !== ValidatePasswordInput) {
        event.preventDefault();
        const erreurMotDePasse = document.getElementById('erreurMotDePasse')
        erreurMotDePasse.textContent = 'Les mots de passe ne correspondent pas'
    }
    //si le mot de passe ne respecte pas les règles : bloquer l'envoi + afficher un message
    if (!(/[A-Z]/.test(PasswordInput)&&/[a-z]/.test(PasswordInput)&&/[0-9]/.test(PasswordInput)&&/[^a-zA-Z0-9]/.test(PasswordInput)&&PasswordInput.length >= 10)) {
        event.preventDefault();
        const erreurMotDePasse = document.getElementById('erreurMotDePasse')
        erreurMotDePasse.textContent = 'Le mot de passe ne correspond pas au format attendu'
    }
})


