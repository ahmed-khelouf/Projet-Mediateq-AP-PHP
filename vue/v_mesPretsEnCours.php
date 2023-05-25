<h2>Emprunts en cours pour l'abonné <?php echo $abonne->getNom()?>: </h2>
<div class="container-fluid">
<?php  
    if(empty($emprunts[$abonne->getId()])){
        ?> Vous n'avez aucun emprunt en cours <?php
    }
    else{
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
                            <h4 class="card-text">Exemplaire n°<?= $unEmprunt->getExemplaire()->getNumero() ?></h4>
                            <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                            <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                            <p class="card-text">
                            Status: 
                            <?php
                                if($unEmprunt->peutProlonger() == 1){
                                    echo "Prolongable";
                                }
                                else {
                                    echo "Non Prolongable";
                                }?>
                            </p>
                            <p class="card-text">Etat: <?= $unEmprunt->getExemplaire()->getEtat()->getLibelle()?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }}
    // Pour chaque parution dans la liste, créer un affichage correspondant
    if(empty($empruntsParution[$abonne->getId()])){
        ?> Vous n'avez aucun emprunt en cours <?php
    }
    else{
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
                            <h4 class="card-text">Parution n°<?= $unEmprunt->getParution()->getNumero() ?></h4>
                            <p class="card-text">Date de début: <?= $unEmprunt->getDateDebut() ?></p>
                            <p class="card-text">Date de fin: <?= $unEmprunt->getDateFin() ?></p>
                            <p class="card-text">
                            Status:
                            <?php
                                if($unEmprunt->peutProlonger() == 1){
                                    echo "Prolongable";
                                }
                                else {
                                    echo "Non Prolongable";
                                }?>
                            </p>
                            <p class="card-text">Etat: <?= $unEmprunt->getParution()->getEtat()->getLibelle()?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <?php
    }}
?>

</div>