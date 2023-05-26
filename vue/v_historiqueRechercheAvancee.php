<?php
// Vérification de la connexion de l'utilisateurs 
if ($connexionManager->isLoggedOn()) {

?>

    <h1>Historique des recherches avancées
        <form method="POST" action="?action=historiqueRechercheAvancee" class="d-inline-block">
            <!-- Bouton pour ouvrir la modal de confirmation -->
            <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#confirmDeleteModalAll"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
    </h1>
    <!-- Récupération du nombre de recherches avancées de l'abonné courant -->
    <h3>Nombre de recherche avancées de l'abonné <?= $unAbonne->getPrenom() ?> <?= $unAbonne->getNom() ?> : <strong><?= $nbHistoriqueRechercheAvancee ?></strong></h3> 

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="confirmDeleteModalAll" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h4>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer l'ensemble des recherches avancées ?
                </div>
                <div class="modal-footer">
                    <!-- Bouton pour annuler la suppression -->
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                    <!-- Bouton pour confirmer la suppression -->
                    <button type="submit" name="suprAll" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <br>
    <!-- Boucle pour afficher toutes les recherches avancées de l'abonné courant -->
    <?php foreach ($rechercheAvancee as $uneRechercheAvancee) { ?>
        <!-- Vérification si la recherche est celle de l'abonné courant -->
        <?php if ($unAbonne->getId() === $uneRechercheAvancee->getAbonne()->getId()) { ?>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-text">
                                Recherche :
                                <strong><?= $uneRechercheAvancee->getType() ?></strong> :
                                "<?= $uneRechercheAvancee->getTexte() ?>"
                                <span style="color: red;"><?= $uneRechercheAvancee->getConnecteur() ?></span>
                                <strong><?= $uneRechercheAvancee->getType2() ?></strong> :
                                "<?= $uneRechercheAvancee->getTexte2() ?>"
                                <span style="color: red;"><?= $uneRechercheAvancee->getConnecteur2() ?></span>
                                <strong><?= $uneRechercheAvancee->getType3() ?></strong> :
                                "<?= $uneRechercheAvancee->getTexte3() ?>"
                            </p>

                            <hr> <!-- Trait pour séparer la recherche des autres informations -->
                            <p>Date : <strong><?= $uneRechercheAvancee->getDate() ?></strong></p>
                            <p>Nombre de résultats : <strong><?= $uneRechercheAvancee->getNbResultat() ?></strong></p>

                            <div class="container-fluid">
                                <form method="POST" action="?action=historiqueRechercheAvancee">
                                    <!-- les champs cachés pour envoyer les données nécessaires à l'ajout  -->
                                    <input type="hidden" class="form-control" name="type1" value="<?= $uneRechercheAvancee->getType() ?>">
                                    <input type="hidden" class="form-control" name="texte" value="<?= $uneRechercheAvancee->getTexte() ?>">
                                    <input type="hidden" class="form-control" name="connecteur" value="<?= $uneRechercheAvancee->getConnecteur() ?>">
                                    <input type="hidden" class="form-control" name="type2" value="<?= $uneRechercheAvancee->getType2() ?>">
                                    <input type="hidden" class="form-control" name="texte2" value="<?= $uneRechercheAvancee->getTexte2() ?>">
                                    <input type="hidden" class="form-control" name="connecteur2" value="<?= $uneRechercheAvancee->getConnecteur2() ?>">
                                    <input type="hidden" class="form-control" name="type3" value="<?= $uneRechercheAvancee->getType3() ?>">
                                    <input type="hidden" class="form-control" name="texte3" value="<?= $uneRechercheAvancee->getTexte3() ?>">

                                    <!-- Ajout de l'id de la recherche avancée pour la supprimer -->
                                    <input type="hidden" class="form-control" name="id" value="<?= $uneRechercheAvancee->getId() ?>">

                                    <div class="text-center">
                                        <div class="btn-group">
                                            <button type="submit" name="historiqueRechercheAvancee" class="btn btn-primary btn-sm mr-2"><span class="glyphicon glyphicon-floppy-disk"></span> Rechercher</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDeleteModal"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                        </div>
                                    </div>

                                    <!-- Modal de confirmation de suppression -->
                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Êtes-vous sûr de vouloir supprimer cette recherche avancée ?
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- Bouton pour annuler la suppression -->
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                                    <!-- Bouton pour confirmer la suppression -->
                                                    <button type="submit" name="supr" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
<?php }
} ?>