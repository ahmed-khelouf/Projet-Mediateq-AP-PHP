<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      padding-top: 80px;
      padding-bottom: 80px;
      background-color: #f5f5f5;
    }
    
    .form-signin {
      max-width: 800px;
      padding: 40px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-direction: row;
    }
    
    .form-image {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .form-image img {
      max-width: 100%;
    }
    
    .form-fields {
      flex: 1;
      padding-left: 40px;
    }
    
    .form-fields .form-group {
      margin-bottom: 20px;
    }
    
    .form-fields .form-control {
      position: relative;
      height: auto;
      box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    
    .form-fields .form-control:focus {
      z-index: 2;
    }
    
    .form-fields input[type="text"],
    .form-fields input[type="password"] {
      border: none;
      border-bottom: 1px solid #ccc;
      border-radius: 0;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    
    .form-fields input[type="text"]:focus,
    .form-fields input[type="password"]:focus {
      border-color: #4285f4;
      outline: 0;
      box-shadow: 0 2px 6px rgba(66, 133, 244, 0.25);
    }
    
    .form-fields .btn-primary {
      background-color: #4285f4;
      border-color: #4285f4;
    }
    
    .form-fields .btn-primary:hover {
      background-color: #357ae8;
      border-color: #357ae8;
    }
  </style>
</head>
<body>
  <div class="container">
    <form class="form-signin" action="./?action=connexion" method="POST">
      <div class="form-image">
        <img src="https://pnganime.com/web/images/l/luffy-gear-5-colored.png" alt="Luffy Gear 5" />
      </div>
      <div class="form-fields">
        <h2 class="h3 mb-3 font-weight-normal">Connexion</h2>
        <div class="form-group">
          <label for="inputMail" class="sr-only">Email de connexion</label>
          <input type="text" id="inputMail" name="mailU" class="form-control" placeholder="Email de connexion" required autofocus>
        </div>
        <div>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
          <input type="password" id="inputPassword" name="mdpU" class="form-control" placeholder="Mot de passe" required>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
      </div>
    </form>
  </div>
</body>
</html>

