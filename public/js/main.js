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
    document.getElementById('formUpdate').reset();
    var url = $(this).attr('href');
    $('#titreModal').append(` ${matricule}`);

    $.ajax({
      type: 'POST',
      url: url,
      data: null,
      dataType: 'json',
      success: function (response) {
        $('#formUpdate  .boursier').html('');
        $('#formUpdate #prenom').val(response['prenom']);
        $('#formUpdate #nom').val(response['nom']);
        $('#formUpdate #email').val(response['mail']);
        $('#formUpdate #address').val(response['address']);
        $('#formUpdate #chambre').val(response['chambre']);

        $('#formUpdate #telephone').val(response['telephone']);
        $('#formUpdate #naissance').val(response['dateNaissance']);
        $('#formUpdate  .boursier').append(
          '<br>Montant Bourse ',
          response['montantBourse']
        );
      },
    });
  });

  //button ajouter vider les donné du formulaire
  $('#addEtudiant').click(function (e) {
    document.getElementById('formCreate').reset();
  });

  //ajout etudiant
  $('#formCreate').submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    let url = $('#addEtudiant').attr('href');
    $.post(url, data, function (response, status) {
      if (response) {
        alert('Vous avez ajoute l etudiant avec succès');
        window.location.href = redirectListeEtudiant;
      } else {
        alert('Veuillez vérifier les informations saisies svp!');
      }
    });
  });

  //update etudiant
  $('#formUpdate').submit(function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    let url = $('.modifierEtudiant').attr('id');
    $.post(url, data, function (response, status) {
      if (response) {
        alert('Vous avez modifier l etudiant avec succès');
        window.location.href = redirectListeEtudiant;
      } else {
        alert('Veuillez vérifier les informations saisies svp!');
      }
    });
  });
  //end query
});
