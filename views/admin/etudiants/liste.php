<div class="row">
    <h3 class="col-6">Liste Etudiant</h3>
    <button name="" id="" class="btn btn-success float-right offset-4" href="#"
        role="button">Ajouter Etudiant</button>
</div>
<p class="lead">
    <!-- Search form -->

    <form class="col-6 offset-3 mt-5" method="POST">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="text"
                placeholder="Recherhe..">
            <div class="input-group-append">
                <select class="form-control" id="sel" name="type">
                    <?php if (count($typeSearch) > 0) {
                        foreach ($typeSearch as $type) {
                            echo "<option>" . $type . "</option>";
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
        <tr>
            <td>htmmd</td>
            <td>assane Fall</td>
            <td>john@example.com</td>
            <td>12/01/2012</td>
            <td><a name="" id="" class="btn btn-warning" href="#"
                    role="button">modifier</a></td>
            <td><a name="" id="" class="btn btn-danger" href="#"
                    role="button">supprimer</a></td>
        </tr>
    </tbody>
</table>