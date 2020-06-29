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
                id="supprimerEtudiant" class="btn btn-danger supprimerEtudiant"
                role="button">supprimer</a></td>
    </tr>
    <?php endforeach ?>
</tbody>