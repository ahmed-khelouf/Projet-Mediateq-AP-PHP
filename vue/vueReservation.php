<?php
$connexionManager = new ConnexionManager;
$reservationManager = new ReservationManager;
$reservation = $reservationManager->nombreReservation($unAbonne->getId());

?>

<h1>Réservation de <?= $unAbonne->getNom() ?> ID numero <?= $unAbonne->getId() ?></h1>
<h3>Nombre de réservation <?= $reservation ?></h3>
<?php
if ($connexionManager->isLoggedOn()) { ?>
    <div class="">
        <table id="myTable" class="table table-bordered table-striped">
            <thead>
                <th>Titre</th>
                <th>abonnee</th>
                <th>ID Revue</th>
            </thead>
            <?php foreach ($reservations as $reservation) { ?>
                <?php if ($unAbonne->getId() === $reservation->getIdAbonne()->getId()) { ?>
                    <tbody>
                        <tr>
                            <td><?= $reservation->getRevue()->getTitre() ?></td>
                            <td><?= $reservation->getIdAbonne()->getId() ?></td>
                            <td><?= $reservation->getRevue()->getId() ?></td>
                            <td><?= $reservation->getRang() ?></td>
                            <td><a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a></td>
                        </tr>
                    </tbody>
                    <div class="modal fade" id="delete_<?= $reservation->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <center>
                                        <h4 class="modal-title" id="myModalLabel">Supprimer la reservation</h4>
                                    </center>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">Etes-vous sure de vouloir la reservation <?= $reservation->getId() ?></p>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="?action=reservation">
                                        <input type="hidden" class="form-control" name="idR" value="<?= $reservation->getId() ?>">

                                        <input type="hidden" class="form-control" name="id" value="<?= $reservation->getRevue()->getId() ?>">

                                        <input type="hidden" class="form-control" name="rang" value="<?= $reservation->getRang() ?> ">

                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                        <button type="submit" name="supr" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Oui</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else {
        echo ("tu es pas coooo ");
    } ?>



<h2>Revues : </h2>
<div class="container-fluid">
    <?php
    foreach ($reservations as $reservation) { 
       if ($unAbonne->getId() === $reservation->getIdAbonne()->getId()) { 
    ?>
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="" src="" alt="<?= $reservation->getRevue()->getTitre() ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?= $reservation->getRevue()->getTitre() ?></h4>
                            <a href='#delete_<?= $reservation->getId() ?>' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a>
                            <p class="card-text"><?= $reservation->getRevue()->getDescripteur()->getLibelle() ?></p>
                            <p><?= $reservation->getRang()?></p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php } 
    } ?>
    
</div>