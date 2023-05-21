<style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
</style>

<h2>Inscription</h2>
<form method="post" action="./?action=inscription">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" required>

    <label for="dateNaiss">Date de naissance :</label>
    <input type="date" name="dateNaissance" required>

    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" required>

    <label for="numTel">Numéro de téléphone :</label>
    <input type="tel" name="numTel" pattern="0[0-9]{9}" title="Le numéro de téléphone doit être composé de 10 chiffres et commencer par un 0." required>

    <label for="mailU">Adresse e-mail :</label>
    <input type="email" name="mailU" required>

    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="submit" value="Valider">
</form>
