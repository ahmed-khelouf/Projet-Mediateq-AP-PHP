
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
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <input type="hidden" name="id" value="<?= $unAbonne->getId() ?>">
    <input type="submit" value="Modifier mon mot de passe">
</form>
<?php

?>