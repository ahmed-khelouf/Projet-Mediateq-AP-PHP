<h2>Frais en cours pour l'abonné <?php echo $abonne->getNom()?>: </h2>
<div class="container-fluid">
<?php
    $total = 0;
    if(empty($emprunts[$abonne->getId()])){
        ?> Vous n'avez aucun emprunt de livre ou dvd en retard<?php
    }
    else{
        $total = $frais_retard;
    }

    if(empty($empruntsParution[$abonne->getId()])){
        ?> Vous n'avez aucun emprunt de parutions en retard <?php
    }
    else{
        $total = $frais_retard;
    }

    print($total.'€ de frais de retard');
?>
</div>

