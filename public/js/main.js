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
  var matricule = $('.modifierEtudiant').attr('id');
  //preremplire le champs
  $('.modifierEtudiant').click(function (e) {
    e.preventDefault();

    $('#createOrUpdate').attr('name', 'createOrUpdate').val('update');
    $('#titreModal').html('Modifier etudiant');
    $('#btnSubmit').html('Modifier');
    var url = $('.modifierEtudiant').attr('href');

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
        $('#formUpdateOrCreateEtud #telephone').val(response['telephone']);
        $('#formUpdateOrCreateEtud #naissance').val(response['dateNaissance']);
        $('#formUpdateOrCreateEtud  .boursier').append(
          '<br>Montant Bourse ',
          response['montantBourse']
        );
      },
    });
  });

  //vider les donné du formulaire
  $('#addEtudiant').click(function (e) {
    e.preventDefault();
    $('.updateLabel').hide();
    $('#titreModal').html('Ajouter etudiant');
    $('#btnSubmit').html('Ajouter');
    $('#createOrUpdate').attr('name', 'createOrUpdate').val('create');
    document.getElementById('formUpdateOrCreateEtud').reset();
  });

  //   //ajouter etudiant
  function createEtudiant(data) {
    var url = $('#addEtudiant').attr('href');
    $.ajax({
      type: 'POST',
      url,
      data,
      dataType: 'json',
      success: function (response) {
        console.log(response);
        if (response == 'envoye') {
          alert('Vous avez ajoute l etudiant avec succès');
          window.location.href = redirectListeEtudiant;
        } else {
          alert('Veuillez vérifier les informations saisies svp!');
        }
      },
    });
  }
  //modifier un etudiant

  function updateEtudiant(data) {
    let url = $('.modifierEtudiant').attr('id');
    $.ajax({
      type: 'POST',
      url,
      data,
      dataType: 'json',
      success: function (response) {
        console.log(response);
      },
    });
  }
  $('#formUpdateOrCreateEtud').submit(function (e) {
    e.preventDefault();
    let createOrUpdate = $('#createOrUpdate').val();
    let data = $(this).serialize();

    if (createOrUpdate == 'create') {
      createEtudiant(data);
    } else {
      console.log('modif');
      updateEtudiant(data);
    }
  });
});
