
<?php

?>
<h1> Mon Dossier <h1>

<h2> Mon Compte : </h2>

<h1 class="page-header text-center">Informations personnels</h1>
	<div class="">
		<table  id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>ID</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Adresse</th>
				<th>Numero tel</th>
				<th>Mail</th>
			</thead>
			<tbody>
					<tr>
						<td><?= $unAbonne->getId() ?></td>
						<td><?= $unAbonne->getNom() ?></td>
						<td><?= $unAbonne->getPrenom() ?></td>
						<td><?= $unAbonne->getAdresse() ?></td>
						<td><?= $unAbonne->getNumTel() ?></td>
						<td><?= $unAbonne->getMailU() ?></td>
					</tr>
			</tbody>
		</table>
	</div>

<h2>Informations sur votre abonnement :</h2>
	<div class="">
		<table  id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Expire le :</th>
				<th>TypeAbonnement </th>
			</thead>
			<tbody>
				<tr>
					<td><?= $unAbonne->getFinAbonnement() ?></td>
					<td><?= $unAbonne->getTypeAbonnement()->getLibelle()?></td>
                    
				</tr>
			</tbody>
		</table>

<h2>Emprunts :</h2>
	<div class="">
		<table  id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Nombre d'emprunts</th>
			</thead>
			<tbody>
			</tbody>
		</table>

<h2>Frais</h2>
	<div class="">
		<table  id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Frais total</th>
			</thead>
			<tbody>
			</tbody>
		</table>

<h2>Reservations</h2>
	<div class="">
		<table  id="myTable" class="table table-bordered table-striped">
			<thead>
				<th>Reservations</th>
			</thead>
			<tbody>
			</tbody>
		</table>

		<h1>Modifier le mot de passe</h1>

	<form method="post" action="./?action=monDossier">
	<label for="mdp">Nouveau mot de passe :</label>
	<input type="password" id="mdp" name="mdpU" required>
	
	<input type="hidden" name="id" value="<?= $unAbonne->getId() ?>">
	<input type="submit" value="Modifier mon mot de passe">
	</form>


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
    <input type="tel" name="numTel" required><br>

    <label for="finAbo">Fin de l'abonnement :</label>
    <input type="text" name="finAbonnement" required><br>

    <label for="mdpU">Mot de passe :</label>
    <input type="password" name="mdpU" required><br>

    <label for="mailU">Adresse e-mail :</label>
    <input type="email" name="mailU" required><br>

    <label for="typeAbonnement">Type d'abonnement :</label>
    <select name="typeAbonnement" required>
        <option value="1">1</option>
        <option value="2">2</option>
    </select><br>

    <input type="submit" value="Valider">
</form>

<?php

?>
