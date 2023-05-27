<h2>Frais en cours pour l'abonné <?php echo $abonne->getNom()?>: </h2>
<div class="container-fluid">
<?php
    $total = 0;
    if(empty($emprunts[$abonne->getId()]) && empty($empruntsParution[$abonne->getId()])){
        ?><h3> Vous n'avez aucun emprunt en retard. </h3><?php
    }
    else{
        $total = $frais_retard;
        print('<h3>'.$total.'.00€ de frais de retard. </h3>');
    }
?>
</div>

