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
<?php if($abonne->getFrais() > 0){?>
<div>
    <a href="#payer_frais" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> PAYER LES FRAIS</a>
                                        <div class="modal fade" id="payer_frais" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Payer les frais</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Voulez vous payer les frais d'un montant de <?php echo $abonne->getFrais()?>.00€ ?</p>
                                                        <div class="container-fluid">
                                                            <form method="POST" action="?action=mesFrais">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" name="payer_frais" class="btn btn-primary">Procéder au payement</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
</div>
<?php }?>

