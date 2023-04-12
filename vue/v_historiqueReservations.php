<?php
// Vérification de la connexion de l'utilisateurs 
if ($connexionManager->isLoggedOn()) {
    // Récupération du nombre de réservations de l'abonné courant
    $nbHistorique = $HistoriqueManager->nombreHistorique($unAbonne->getId());
?>
    <h1>Réservation de <?= $unAbonne->getNom() ?></h1>
    <h3>Historique des réservations <?= $nbHistorique ?></h3>
    
    <h2>REVUES : </h2>
    <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
    <?php foreach ($historiqueParution as $historique) { ?>
        <!-- Vérification si la réservation est celle de l'abonné courant -->
        <?php if ($unAbonne->getId() === $historique->getAbonne()->getId()) { ?>
            <tbody>
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-horizontal">
                                <div class="img-square-wrapper">
                                    <img class="img-fluid mx-auto d-block" src="images/Revues/<?= $historique->getParution()->getPhoto() ?>.jpg" alt="Couverture">
                                </div>
                                <div class="trait-vertical"></div>
                                <div class="card-body">
                                    <h4 class="title"><?= $historique->getRevue()->getTitre() ?></h4>
                                    <p class="card-text"> Type de document : <strong><?= $historique->getRevue()->getDescripteur()->getLibelle() ?></strong></p>
                                    <div class="trait-horizontal"></div>
                                    <p> Date : <strong><?= $historique->getDate() ?></strong></p>
                                    <p> Numero : <strong><?= $historique->getParution()->getNumero() ?></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
        <?php } ?>
    <?php } ?>
    <!-- LIVRES -->
    <h2>LIVRES : </h2>
    <div class="">
        <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
        <?php foreach ($historiqueLivre as $historique) { ?>
            <!-- Vérification si la réservation est celle de l'abonné courant -->
            <?php if ($unAbonne->getId() === $historique->getAbonne()->getId()) { ?>
                <tbody>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-horizontal">
                                    <div class="img-square-wrapper">
                                        <img class="img-fluid mx-auto d-block" src="images/Livres/<?= $historique->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                    </div>
                                    <div class="trait-vertical"></div>
                                    <div class="card-body">
                                        <h4 class="title"><?= $historique->getDocument()->getTitre() ?></h4>
                                        <p class="card-text"> Auteur : <strong><?= $historique->getDocument()->getAuteur() ?></strong></p>
                                        <div class="trait-horizontal"></div>
                                        <p> Date : <strong><?= $historique->getDate() ?></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </tbody>
            <?php } ?>
        <?php } ?>
        <!-- DVD -->
        <h2>DVD : </h2>
        <div class="">
            <!-- Boucle pour afficher toutes les réservations de l'abonné courant -->
            <?php foreach ($historiqueDVD as $historique) { ?>
                <!-- Vérification si la réservation est celle de l'abonné courant -->
                <?php if ($unAbonne->getId() === $historique->getAbonne()->getId()) { ?>
                    <tbody>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-horizontal">
                                        <div class="img-square-wrapper">
                                            <img class="img-fluid mx-auto d-block" src="images/Dvd/<?= $historique->getDocument()->getImage() ?>.jpg" alt="Couverture">
                                        </div>
                                        <div class="trait-vertical"></div>
                                        <div class="card-body">
                                            <h4 class="title"><?= $historique->getDocument()->getTitre() ?></h4>
                                            <p class="card-text"> Auteur : <strong><?= $historique->getDocument()->getRealisateur() ?></strong></p>
                                            <div class="trait-horizontal"></div>
                                            <p> Date : <strong><?= $historique->getDate() ?></strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>