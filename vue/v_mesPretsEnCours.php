<div>
    <a href="#prolonger_all" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> PROLONGER TOUT LES EMPRUNTS</a>
                                        <div class="modal fade" id="prolonger_all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Prolonger tout les emprunts</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center">Êtes-vous sûr de vouloir prolonger tout les emprunts prolongeables d'une semaine ?</p>
                                                        <div class="container-fluid">
                                                            <form method="POST" action="?action=mesPretsEnCours">
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" name="prolong_all" class="btn btn-primary">Confirmer la prolongation</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
</div>
