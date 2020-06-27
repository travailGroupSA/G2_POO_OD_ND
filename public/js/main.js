$(document).ready(function () {
  //   $('#formSearch').submit(function (e) {
  //     e.preventDefault();
  //   });

  let rooturl = $('#rooturl').val();
  let redirectListeEtudiant = `${rooturl}/etudiant/liste`;

  //supprimer un etudiant
  $('.supprimerEtudiant').click(function (e) {
    e.preventDefault();
    let url = $('#supprimerEtudiant').attr('href');
    let confirmDelete = confirm("voulez-vous vraiment supprimer l'etudiant");
    if (confirmDelete) {
      window.location.href = url;
    }
  });

  //button modifier possibilite dafficher les infos et modifier
  $('.modifierEtudiant').click(function (e) {
    document.getElementById('formUpdateOrCreateEtud').reset();
    $('#createOrUpdate').attr('name', 'createOrUpdate').val('update');
    $('#titreModal').html('Modifier etudiant');
    $('#btnSubmit').html('Modifier');
    var url = $(this).attr('href');

    $.ajax({
      type: 'POST',
      url: url,
      data: null,
      dataType: 'json',
      success: function (response) {
        $('#formUpdateOrCreateEtud  .boursier').html('');
        $('#formUpdateOrCreateEtud #prenom').val(response['prenom']);
        $('#formUpdateOrCreateEtud #nom').val(response['nom']);
        $('#formUpdateOrCreateEtud #email').val(response['mail']);
        $('#formUpdateOrCreateEtud #address').val(response['address']);
        $('#formUpdateOrCreateEtud #chambre').val(response['chambre']);

        $('#formUpdateOrCreateEtud #telephone').val(response['telephone']);
        $('#formUpdateOrCreateEtud #naissance').val(response['dateNaissance']);
        $('#formUpdateOrCreateEtud  .boursier').append(
          '<br>Montant Bourse ',
          response['montantBourse']
        );
      },
    });
  });

  //button ajouter vider les donné du formulaire
  $('#addEtudiant').click(function (e) {
    $('.updateLabel').hide();
    $('#titreModal').html('Ajouter etudiant');
    $('#btnSubmit').html('Ajouter');
    $('#createOrUpdate').attr('name', 'createOrUpdate').val('create');
    document.getElementById('formUpdateOrCreateEtud').reset();
  });
});
