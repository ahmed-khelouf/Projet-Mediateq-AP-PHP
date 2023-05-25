<div class="card">
    <div class="card-body">
        <form method="POST" action="?action=rechercheSimple">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>Titre</option>
                        <option value="livre" >Auteur</option>
                        <option value="dvd" >Sujet</option>
                        <option value="revue" >Collection</option>
                        <option value="dvd" >Editeur</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>Tout les mots</option>
                        <option value="livre" >Inclus</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <input id="searchText" name="searchText" class="form-control" placeholder="Saisissez les termes de votre recherche." type="text">
                </div>

                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>ET</option>
                        <option value="livre" >OU</option>
                        <option value="dvd" >SAUF</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                    <option value="tout" selected>Titre</option>
                        <option value="livre" >Auteur</option>
                        <option value="dvd" >Sujet</option>
                        <option value="revue" >Collection</option>
                        <option value="dvd" >Editeur</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>Tout les mots</option>
                        <option value="livre" >Inclus</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <input id="searchText" name="searchText" class="form-control" placeholder="Saisissez les termes de votre recherche." type="text">
                </div>
            
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>ET</option>
                        <option value="livre" >OU</option>
                        <option value="dvd" >SAUF</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                    <option value="tout" selected>Titre</option>
                        <option value="livre" >Auteur</option>
                        <option value="dvd" >Sujet</option>
                        <option value="revue" >Collection</option>
                        <option value="dvd" >Editeur</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <select class="form-control" name="searchType" id="searchType" required >
                        <option value="tout" selected>Tout les mots</option>
                        <option value="livre" >Inclus</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <input id="searchText" name="searchText" class="form-control" placeholder="Saisissez les termes de votre recherche." type="text">
                </div>

                <div class="form-group col-md-3">
                    <button type="submit" name="recherche" class="btn btn-primary col-md-12"><span class="glyphicon glyphicon-floppy-disk"></span> Lancer la recherche</a>
                </div>
            </div>
        </form>
    </div>
</div>