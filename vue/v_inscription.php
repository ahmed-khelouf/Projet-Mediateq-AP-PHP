<h2>Inscription</h2>
<form method="post" action="./?action=monDossier">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required><br>

    <label for="dateNaiss">Date de naissance :</label>
    <input type="text" name="dateNaissance" required><br>

    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" required><br>

    <label for="numTel">Numéro de téléphone :</label>
    <input type="tel" name="numTel" pattern="0[0-9]{9}" title="Le numéro de téléphone doit être composé de 10 chiffres et commencer par un 0." required><br>


    <label for="finAbo">Fin de l'abonnement :</label>
    <input type="text" name="finAbonnement" required><br>

    <label for="mailU">Adresse e-mail :</label>
    <input type="email" name="mailU" required><br>

    <label for="typeAbonnement">Type d'abonnement :</label>
    <select name="typeAbonnement" required>
        <option value="1">enfant</option>
        <option value="2">adulte</option>
    </select><br>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="submit" value="Valider">
</form>
