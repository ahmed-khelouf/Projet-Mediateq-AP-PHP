<!DOCTYPE html>
<html>
<head>
  <title>Inscription</title>
  
  <style>
  

    .card {
      max-width: 400px;
      margin: 0 auto;
      padding: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    form label {
      display: block;
      margin-bottom: 10px;
    }

    form input, form select {
      width: 100%;
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 14px;
    }

    form input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    form p {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Inscription</h2>
      <form method="post" action="./?action=inscription">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>" required> 

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?= isset($prenom) ? htmlspecialchars($prenom) : '' ?>" required>

        <label for="dateNaiss">Date de naissance :</label>
        <input type="date" name="dateNaissance" value="<?= isset($dateNaiss) ? htmlspecialchars($dateNaiss) : '' ?>" required>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" value="<?= isset($adresse) ? htmlspecialchars($adresse) : '' ?>" required>

        <label for="numTel">Numéro de téléphone :</label>
        <input type="tel" name="numTel" pattern="0[0-9]{9}" title="Le numéro de téléphone doit être composé de 10 chiffres et commencer par un 0." value="<?= isset($numTel) ? htmlspecialchars($numTel) : '' ?>" required>

        <label for="educateur">Je suis éducateur :</label>
         <input type="checkbox" name="educateur">

        <label for="mailU">Adresse e-mail :</label>
        <input type="email" name="mailU" value="<?= isset($mailU) ? htmlspecialchars($mailU) : '' ?>" required>

        <p>Le type d'abonnement est défini automatiquement selon votre âge</p>
        <p> Votre mot de passe est défini au format jjmmaaaa ainsi que vos 2 premières lettre de votre nom en majuscule<p>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <input type="submit" value="Valider">
      </form>
    </div>
  </div>
</body>
</html>
