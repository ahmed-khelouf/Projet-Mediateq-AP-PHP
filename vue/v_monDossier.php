<?php
	// Appel de la fonction verifierFinAbonnement() pour obtenir le message d'expiration
	$abonneManager = new AbonneManager();
	$messageExpiration = $abonneManager->verifierFinAbonnement($unAbonne);

	// Affichage du message si la date d'expiration est proche
	if ($messageExpiration !== null) {
		echo '<div class="alert alert-warning">' . $messageExpiration . '</div>';
	}
?>

<div class="card">
	<div class="card-body">
		<h1 class="card-title">Mon Dossier</h1>

		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Mon Compte :</h2>

				<h1 class="page-header text-center">Informations personnelles</h1>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
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
							<!-- Ajoutez d'autres lignes pour afficher les informations supplémentaires si nécessaire -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Informations sur votre abonnement :</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<th>Expire le :</th>
							<th>TypeAbonnement</th>
						</thead>
						<tbody>
							<tr>
								<td><?= $unAbonne->getFinAbonnement() ?></td>
								<td><?= $unAbonne->getTypeAbonnement()->getLibelle() ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Emprunts :</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<th>Nombre d'emprunts</th>
						</thead>
						<tbody>
							<!-- Ajoutez les lignes pour afficher les détails des emprunts -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Frais</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
							<thead>
								<th>Frais total</th>
							</thead>
							<tbody>
								<!-- Ajoutez les lignes pour afficher les détails des frais -->
							</tbody>
						</table>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-body">
				<h2 class="card-title">Réservations</h2>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<th>Réservations</th>
						</thead>
						<tbody>
							<!-- Ajoutez les lignes pour afficher les détails des réservations -->
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<h1>Modifier le mot de passe</h1>

		<form method="post" action="./?action=monDossier">
			<label for="mdpActuel">Mot de passe actuel :</label>
			<input type="password" id="mdpActuel" name="mdpActuel" required><br>

			<label for="nouveauMdp">Nouveau mot de passe :</label>
			<input type="password" id="nouveauMdp" name="nouveauMdp" required><br>

			<label for="confirmationMdp">Confirmer le nouveau mot de passe :</label>
			<input type="password" id="confirmationMdp" name="confirmationMdp" required><br>

			<input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
			<input type="hidden" name="id" value="<?= htmlspecialchars($unAbonne->getId()) ?>">
			<input type="submit" value="Modifier mon mot de passe">
		</form>
	</div>
</div>
