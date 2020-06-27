$(document).ready(function () {
  //   $('#formSearch').submit(function (e) {
  //     e.preventDefault();
  //   });

  let rooturl = $('#rooturl').val();
  let redirectListeEtudiant = `${rooturl}/etudiant/liste`;
  // scroll

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
        // window.location.href = redirectListeEtudiant;
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
        // window.location.href = redirectListeEtudiant;
      } else {
        alert('Veuillez vérifier les informations saisies ou svp!');
      }
    });
  });

  //scroll
  // $('#loader').append(
  //   '<div id="loader"><img src="../public/images/loader" alt="loader ajax"></div>'
  // );
  // $('.scroll-table').scroll(function () {
  //   if ($('.scroll-table').height() - $('.scroll-table').scrollTop() < 250) {
  //     let offset = 10;
  //     let url = `${rooturl}/etudiant/listeScrolle/${offset}`;
  //     // ici on ajoute un petit loader de chargement
  //     //$('#content').append('<div id="loader"><img src="/img/ajax-loader.gif" alt="loader ajax"></div>');
  //     if ($('.scroll-table').height() - $('.scroll-table').scrollTop() < 250) {
  //       // on affiche donc loader
  //       $('#loader').fadeIn(400);
  //       // puis on fait la requête pour liste les etudiant
  //       console.log(url);

  //       try {
  //         $.get(url, function (data) {
  //           // s'il y a des données

  //           if (data != '') {
  //             // on les insère juste avant le loader.gif
  //             $('table tbody').append(data);

  //             // on les affiche avec un fadeIn
  //             $('.hidden').fadeIn(400);

  //             /* enfin on incrémente notre offset de 20
  //              * afin que la fois d'après il corresponde toujours
  //              */
  //             offset += 10;
  //           }
  //           // le chargement est terminé, on fait disparaitre notre loader
  //           $('#loader').fadeOut(400);
  //         });
  //       } catch (error) {}
  //     }
  //   }
  // });
  //end query
});
