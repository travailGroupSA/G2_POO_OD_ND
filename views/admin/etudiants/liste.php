<div class="row">
    <h3 class="col-6">Liste Etudiant</h3>
    <button href="<?= URLROOT ?>/etudiant/create" id="addEtudiant"
        class=" btn btn-success float-right offset-4 " data-toggle="modal"
        data-target=".modalAddEtudiant" role="button">Ajouter
        Etudiant</button>
</div>
<p class="lead">
    <!-- Search form -->
    <form class="col-6 offset-3 mt-5" method="POST" id="formSearch">
        <input type="hidden" id="rooturl" name="rooturl" value="<?= URLROOT ?>">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="searched"
                placeholder="Recherhe..">
            <div class="input-group-append">
                <select class="form-control" id="sel" name="type">
                    <?php if (count($typeSearch) > 0) {
                        foreach ($typeSearch as $type) {
                            echo "<option value=" . $type . ">" . $type . "</option>";
                        }
                    } ?>
                </select>
                <button class="btn btn-primary" type="submit"
                    name="search">Recherche</button>
            </div>
        </div>
    </form>
</p>
<table class="table table-bordered bg-white col-12">
    <thead class="bg-primary text-light">
        <tr>
            <th>Matricule</th>
            <th>Prenom et Nom</th>
            <th>Email</th>
            <th>Date de Nais</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $key => $objectEtudiant) : ?>
        <tr>
            <td><?= $objectEtudiant->getMatricule() ?></td>
            <td>
                <?= $objectEtudiant->getPrenom() ?>
                <?= $objectEtudiant->getNom() ?>
            </td>
            <td>j<?= $objectEtudiant->getMail() ?></td>
            <td><?= $objectEtudiant->getDateNaissance() ?></td>
            <td><a href="<?= URLROOT ?>/etudiant/show/<?= $objectEtudiant->getMatricule() ?>"
                    id="<?= URLROOT ?>/etudiant/update/<?= $objectEtudiant->getMatricule() ?>"
                    type="button" class="btn btn-warning modifierEtudiant"
                    data-toggle="modal" data-target=".openModelEtudiant"
                    role="button">modifier</a>
            </td>
            <td><a href="<?= URLROOT ?>/etudiant/delete/<?= $objectEtudiant->getMatricule() ?>"
                    id="supprimerEtudiant"
                    class="btn btn-danger supprimerEtudiant"
                    role="button">supprimer</a></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- modal ajouter-->
<div class="modal fade modalAddEtudiant" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titreModal">Ajouter Un Etudiant</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <form method="POST" id="formCreate">
                    <input type="hidden" name="create" value="create">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control"
                                name="prenom" placeholder="Prenom" id="prenom">
                        </div>
                        <div class="col">
                            <input type="text" name="nom" class="form-control"
                                placeholder="Nom" id="nom">
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="input-group-append">

                            <div class="col-10">
                                <input type="email" class="form-control"
                                    placeholder="Email" name="email" id="email">
                            </div>
                            <div class="col-10">
                                <select class="form-control" id="boursier"
                                    name="typeBourse">
                                    <?php if (count($typeSearch) > 0) {
                                        foreach ($selectTypeBourse as $key => $type) {
                                            echo "<option value=" . $type . ">" . $key . "</option>";
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" name="telephone"
                                class="form-control"
                                placeholder="Numero Telephone" id="telephone">
                        </div>
                        <div class="col">
                            <input type="text" name="dateNaissance"
                                class="form-control"
                                placeholder="Date Naissance" id="naissance">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <input type="text" name="address"
                                class="form-control" placeholder="address"
                                id="address">
                        </div>
                        <div class="col">
                            <input type="text" name='chambre'
                                class="form-control" placeholder="chambre"
                                id="chambre">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success"
                            name="create" id="btnCreate">Aouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal add etudiant-->

<!-- modal Modifier-->
<div class="modal fade openModelEtudiant" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titreModal">Info et Modification de
                    L'etududiant
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-dark">
                <form method="POST" id="formUpdate">
                    <div class="form-row">
                        <div class="col">
                            <label for="prenom"
                                class="updateLabel">Prenom</label>
                            <input type="text" class="form-control"
                                name="prenom" placeholder="Prenom" id="prenom">
                        </div>
                        <div class="col">
                            <label for="nom" class="updateLabel">Nom</label>
                            <input type="text" name="nom" class="form-control"
                                placeholder="Nom" id="nom">
                        </div>
                    </div>

                    <div class="form-row mt-2">
                        <div class="input-group-append">

                            <div class="col-10">
                                <label for="email"
                                    class="updateLabel">*Mail</label>
                                <input type="email" class="form-control"
                                    placeholder="Email" name="email" id="email">
                            </div>
                            <div class="col-10">
                                <label for="boursier"
                                    class="updateLabel boursier">Boursier</label>
                                <select class="form-control" id="boursier"
                                    name="typeBourse">
                                    <?php if (count($typeSearch) > 0) {
                                        foreach ($selectTypeBourse as $key => $type) {
                                            echo "<option value=" . $type . ">" . $key . "</option>";
                                        }
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="telephone" class="updateLabel">Numero
                                Telephone</label>
                            <input type="text" name="telephone"
                                class="form-control"
                                placeholder="Numero Telephone" id="telephone">
                        </div>
                        <div class="col">
                            <label for="naissance" class="updateLabel">Date
                                Naissance</label>
                            <input type="text" name="dateNaissance"
                                class="form-control"
                                placeholder="Date Naissance" id="naissance">
                        </div>
                    </div>
                    <div class="form-row mt-2">
                        <div class="col">
                            <label for="address" class="updateLabel">Adresse
                                pour les non
                                boursier</label>
                            <input type="text" name="address"
                                class="form-control" placeholder="address"
                                id="address">
                        </div>
                        <div class="col">
                            <label for="chambre" class="updateLabel">Chambre
                                Etudiant loge</label>
                            <input type="text" name='chambre'
                                class="form-control" placeholder="chambre"
                                id="chambre">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" name="update"
                            class="btn btn-success"
                            id="btnupdate">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>