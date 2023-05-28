<?php
// Appel de la fonction verifierFinAbonnement() pour obtenir le message d'expiration
$abonneManager = new AbonneManager();
$reservationManager = new ReservationManager();
$reservation = $reservationManager->nombreReservation($unAbonne->getId());

$messageExpiration = $abonneManager->verifierFinAbonnement($unAbonne);

// Affichage du message si la date d'expiration est proche
if ($messageExpiration !== null) {
    echo '<div class="alert alert-warning">' . $messageExpiration . '</div>';
}
?>

<h1>Mon Dossier</h1>

<h2>Mon Compte :</h2>

<h1 class="page-header text-center">Informations personnelles</h1>
<div class="">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
			<th>Date de naissance</th>
            <th>Adresse</th>
            <th>Numero tel</th>
            <th>Mail</th>
            <th>Modifier infos perso</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $unAbonne->getId() ?></td>
                <td><?= $unAbonne->getNom() ?></td>
                <td><?= $unAbonne->getPrenom() ?></td>
				<td><?= $unAbonne->getDateNaissance() ?></td>
                <td><?= $unAbonne->getAdresse() ?></td>
                <td><?= $unAbonne->getNumTel() ?></td>
                <td><?= $unAbonne->getMailU() ?></td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalModifierInformations">Modifier</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<h2>Informations sur votre abonnement :</h2>
<div class="">
    <table id="myTable" class="table table-bordered table-striped">
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

<h2>Emprunts :</h2>
<div class="">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <th>Nombre d'emprunts</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<h2>Frais</h2>
<div class="">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <th>Frais total</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<h2>Réservations</h2>
<div class="">
    <table id="myTable" class="table table-bordered table-striped">
        <thead>
            <th>Nombre de réservations</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $reservation ?></td>
            </tr>
        </tbody>
    </table>
</div>

	<h2>Frais</h2>
		<div class="">
			<table  id="myTable" class="table table-bordered table-striped">
				<thead>
					<th>Frais total</th>
				</thead>
				<tbody>
					<tr>
						<td><?= $unAbonne->getFrais()?>.00 €</td>
						
					</tr>
				</tbody>
			</table>
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

<!-- Modal pour la modification des informations personnelles -->
<div class="modal fade" id="modalModifierInformations" tabindex="-1" role="dialog" aria-labelledby="modalModifierInformationsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierInformationsLabel">Modifier mes informations personnelles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
			<form method="post" action="./?action=monDossier" id="formModifierInformations">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($unAbonne->getNom()) ?>" required><br>

                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($unAbonne->getPrenom()) ?>" required><br>

					<label for="dateNaissance">Date de naissance :</label>
					<input type="date" id="dateNaissance" name="dateNaissance" value="<?= htmlspecialchars($unAbonne->getDateNaissance()) ?>" required><br>

                    <label for="adresse">Adresse :</label>
                    <input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($unAbonne->getAdresse()) ?>" required><br>

                    <label for="numTel">Numéro de téléphone :</label>
                    <input type="text" id="numTel" name="numTel" value="<?= htmlspecialchars($unAbonne->getNumTel()) ?>" required><br>

					<label for="mailU">Adresse e-mail :</label>
					<input type="email" id="mailU" name="mailU" value="<?= htmlspecialchars($unAbonne->getMailU()) ?>" required><br>

                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($unAbonne->getId()) ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" form="formModifierInformations" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<?php
?>
