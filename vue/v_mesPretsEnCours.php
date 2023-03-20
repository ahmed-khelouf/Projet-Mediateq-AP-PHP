<h2>Emprunts en cours pour l'abonné <?php echo $idAbonne?>: </h2>
<div class="container-fluid">
<?php
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
                            <h4 class="card-text">Exemplaire numéro <?= $unEmprunt->getExemplaire()->getNumero() ?></h4>
                            <p class="card-text">Date de début <?= $unEmprunt->getDateDebut() ?></p>
                            <p class="card-text">Date de fin <?= $unEmprunt->getDateFin() ?></p>
                            <p class="card-text">
                            <?php
                                if($unEmprunt->peutProlonger() == 1){
                                    echo "Prolongable";
                                }
                                else {
                                    echo "Non Prolongable";
                                }?>
                            </p>
                            <p class="card-text"><?= $unEmprunt->getExemplaire()->getEtat()->getTitre()?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }
?>

</div>