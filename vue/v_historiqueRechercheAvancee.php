<?php
// Vérification de la connexion de l'utilisateurs 
if ($connexionManager->isLoggedOn()) {

?>

    <h3>Historique des recherches avancées</h3>
    <br>
    <!-- Boucle pour afficher toutes les recherches avancées de l'abonné courant -->
    <?php foreach ($rechercheAvancee as $uneRechercheAvancee) { ?>
        <!-- Vérification si la recherche est celle de l'abonné courant -->
        <?php if ($unAbonne->getId() === $uneRechercheAvancee->getAbonne()->getId()) { ?>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <p class="card-text">Recherche : <?= $uneRechercheAvancee->getType() ?> : <?= $uneRechercheAvancee->getTexte() ?> : <?= $uneRechercheAvancee->getConnecteur() ?> : <?= $uneRechercheAvancee->getType2() ?> : <?= $uneRechercheAvancee->getTexte2() ?> : <?= $uneRechercheAvancee->getConnecteur2() ?> : <?= $uneRechercheAvancee->getType3() ?> : <?= $uneRechercheAvancee->getTexte3() ?></p>
                            <hr> <!-- Trait pour séparer la recherche des autres informations -->
                            <p>Date : <strong><?= $uneRechercheAvancee->getDate() ?></strong></p>
                            <p>Nombre de résultats : <strong><?= $uneRechercheAvancee->getNbResultat() ?></strong></p>

                            <div class="container-fluid">
                                <form method="POST" action="?action=historiqueRechercheAvancee">
                                    <!-- les champs cachés pour envoyer les données nécessaires à la suppression -->
                                    <input type="hidden" class="form-control" name="type1" value="<?= $uneRechercheAvancee->getType() ?>">
                                    <input type="hidden" class="form-control" name="texte" value="<?= $uneRechercheAvancee->getTexte() ?>">
                                    <input type="hidden" class="form-control" name="connecteur" value="<?= $uneRechercheAvancee->getConnecteur() ?>">
                                    <input type="hidden" class="form-control" name="type2" value="<?= $uneRechercheAvancee->getType2() ?>">
                                    <input type="hidden" class="form-control" name="texte2" value="<?= $uneRechercheAvancee->getTexte2() ?>">
                                    <input type="hidden" class="form-control" name="connecteur2" value="<?= $uneRechercheAvancee->getConnecteur2() ?>">
                                    <input type="hidden" class="form-control" name="type3" value="<?= $uneRechercheAvancee->getType3() ?>">
                                    <input type="hidden" class="form-control" name="texte3" value="<?= $uneRechercheAvancee->getTexte3() ?>">

                                    <div class="text-center">
                                        <button type="submit" name="historiqueRechercheAvancee" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> Rechercher</button>
                                        <button type="submit" name="supr" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> supprimer</button>
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