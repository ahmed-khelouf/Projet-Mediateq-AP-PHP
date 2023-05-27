<h2>Emprunts en cours pour l'abonné <?php echo $abonne->getNom()?>: </h2>
<div class="container-fluid">
<?php  
    if(!empty($emprunts[$abonne->getId()])){
    // Pour chaque emprunt dans la liste, créer un affichage correspondant
    foreach($emprunts[$abonne->getId()] as $unEmprunt){
        ?>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <h4 class="card-text"><?= $unEmprunt->getExemplaire()->getDocument()->getTitre() ?></h4>
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="images/Livres/<?=$unEmprunt->getExemplaire()->getDocument()->getImage()?>.jpg" alt="<?= $unEmprunt->getExemplaire()->getDocument()->getTitre() ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-text">Document n°<?= $unEmprunt->getId()?>, Exemplaire n°<?= $unEmprunt->getExemplaire()->getNumero() ?></h4>
                            <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                            <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                            <p class="card-text">Etat: <?= $unEmprunt->getExemplaire()->getEtat()->getLibelle()?></p>
                            <p class="card-text">
                            Status:
                            <?php
                                if($unEmprunt->peutProlonger() == 1){
                                    ?><a href="#prolonger<?= $unEmprunt->getId() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> PROLONGER</a>
                                        <div class="modal fade" id="prolonger<?= $unEmprunt->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Prolonger emprunt</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Êtes-vous sûr de vouloir prolonger l'emprunt suivant d'une semaine ?</p>
                                                        <div class="card mb-3">
                                                            <div class="card-header text-center"><strong><?= $unEmprunt->getExemplaire()->getDocument()->getTitre() ?></strong></div>
                                                            <div class="card-body">
                                                                <h4 class="card-text">Document n°<?= $unEmprunt->getId()?>, Exemplaire n°<?= $unEmprunt->getExemplaire()->getNumero() ?></h4>
                                                                    <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                                                                    <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                                                                    <p class="card-text">Etat: <?= $unEmprunt->getExemplaire()->getEtat()->getLibelle()?></p>
                                                                    <p class="card-text">
                                                            </div>
                                                        </div>
                                                        <div class="container-fluid">
                                                            <form method="POST" action="?action=mesPretsEnCours">
                                                                <input type="hidden" class="form-control" name="idEmprunt" value="<?= $unEmprunt->getId()?> ">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" name="prolong_doc" class="btn btn-primary">Confirmer la prolongation</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                else {
                                    ?><a>NON PROLONGEABLE</a><?php
                                }?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }}
    ?>
 <?php
    // Pour chaque parution dans la liste, créer un affichage correspondant
    if(!empty($empruntsParution[$abonne->getId()])){
        
    foreach($empruntsParution[$abonne->getId()] as $unEmprunt){
        ?>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <h4 class="card-text"><?= $unEmprunt->getParution()->getRevue()->getTitre() ?></h4>
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="images/Revues/<?=$unEmprunt->getParution()->getPhoto()?>.jpg" alt="<?= $unEmprunt->getParution()->getRevue()->getTitre() ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-text">Revue n°<?= $unEmprunt->getId()?>, Parution n°<?= $unEmprunt->getParution()->getNumero() ?></h4>
                            <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                            <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                            <p class="card-text">Etat: <?= $unEmprunt->getParution()->getEtat()->getLibelle()?></p>
                            <p class="card-text">
                            Status:
                            <?php
                                if($unEmprunt->peutProlonger() == 1){
                                    ?><a href="#prolonger_paru<?= $unEmprunt->getId() ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> PROLONGER</a>
                                        <div class="modal fade" id="prolonger_paru<?= $unEmprunt->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Prolonger emprunt</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Êtes-vous sûr de vouloir prolonger l'emprunt suivant d'une semaine ?</p>
                                                        <div class="card mb-3">
                                                            <div class="card-header text-center"><strong><?= $unEmprunt->getParution()->getRevue()->getTitre() ?></strong></div>
                                                            <div class="card-body">
                                                                <h4 class="card-text">Revue n°<?= $unEmprunt->getId()?>, Parution n°<?= $unEmprunt->getParution()->getNumero() ?></h4>
                                                                    <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                                                                    <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                                                                    <p class="card-text">Etat: <?= $unEmprunt->getParution()->getEtat()->getLibelle()?></p>
                                                                    <p class="card-text">
                                                            </div>
                                                        </div>
                                                        <div class="container-fluid">
                                                            <form method="POST" action="?action=mesPretsEnCours">
                                                                <input type="hidden" class="form-control" name="idEmprunt" value="<?= $unEmprunt->getId()?> ">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" name="prolong_paru" class="btn btn-primary">Confirmer la prolongation</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                else {
                                    ?><a>NON PROLONGEABLE</a><?php
                                }?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }}
?>

</div>