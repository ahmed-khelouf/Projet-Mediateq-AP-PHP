<h1>Recherche avancée dans le catalogue</h1>
<br />

<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=rechercheAvancee" id="searchForm">
            <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="searchType" id="searchType">
                            <option value="titre">Titre</option>
                            <option value="auteur">Auteur / Réalisateur</option>
                            <option value="isbn">ISBN (livre)</option>
                            <option value="descripteur">Descripteur (Revue)</option>
                            <option value="collection">Collection (Livre)</option>
                            <option value="periodicite">Périodicité (Revue)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="" class="form-control" name="searchText" id="searchText" placeholder="Entrez les mots-clés">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="searchOption2" id="searchOption">
                            <option value="et">ET</option>
                            <option value="ou">OU</option>
                            <option value="sauf">SAUF</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="searchType2" id="searchType2">
                            <option value="titre">Titre</option>
                            <option value="auteur">Auteur / Réalisateur</option>
                            <option value="isbn">ISBN (livre)</option>
                            <option value="descripteur">Descripteur(Revue)</option>
                            <option value="collection">Collection (Livre)</option>
                            <option value="periodicite">Périodicité (Revue)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="" class="form-control" name="searchText2" id="searchText2" placeholder="Entrez les mots-clés">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" name="searchOption3" id="searchOption2">
                            <option value="et">ET</option>
                            <option value="ou">OU</option>
                            <option value="sauf">SAUF</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="searchType3" id="searchType3">
                            <option value="titre">Titre</option>
                            <option value="auteur">Auteur / Réalisateur</option>
                            <option value="isbn">ISBN (livre)</option>
                            <option value="descripteur">Descripteur (Revue)</option>
                            <option value="collection">Collection (Livre)</option>
                            <option value="periodicite">Périodicité (Revue)</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="form-group">
                        <input type="" class="form-control" name="searchText3" id="searchText2" placeholder="Entrez les mots-clés">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <button type="submit" name="rechercheAvancee" class="btn btn-primary col-md-12"><span class="glyphicon glyphicon-floppy-disk"></span> Rechercher</button>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <button type="reset" name="clear" form="searchForm" class="btn btn-secondary">Effacer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>








<!-- <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator1">Opérateur :</label>
                        <select class="form-control" name="operator1" id="operator1">
                            <option value="AND">ET</option>
                            <option value="OR">OU</option>
                            <option value="NOT">SAUF</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="index2">Index :</label>
                        <select class="form-control" name="index2" id="index2">
                            <option value="title">Titre</option>
                            <option value="author">Auteur</option>
                            <option value="subject">Sujet</option>
                            <option value="collection">Collection</option>
                            <option value="publisher">Éditeur</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="keywords2">Mots-clés :</label>
                        <input type="text" class="form-control" name="keywords2" id="keywords2" placeholder="Entrez les mots-clés">
                    </div>
                </div>
            </div> -->
<!-- <div class="form-row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="operator2">Opérateur :</label>
                        <select class="form-control" name="operator2" id="operator2">
                            <option value="AND">ET</option>
                            <option value="OR">OU</option>
                            <option value="NOT">SAUF</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="index3">Index :</label>
                        <select class="form-control" name="index3" id="index3">
                            <option value="title">Titre</option>
                            <option value="author">Auteur</option>
                            <option value="subject">Sujet</option>
                            <option value="collection">Collection</option>
                            <option value="publisher">Éditeur</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="keywords3">Mots-clés :</label>
                        <input type="text" class="form-control" name="keywords3" id="keywords3" placeholder="Entrez les mots-clés">
                    </div>
                </div>
            </div> -->


<script src="script.js"></script>