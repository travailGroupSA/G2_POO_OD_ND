$(document).ready(function () {
  function loadPage(page) {
    $.ajax({
      url: '../dao/Pagination.php',
      method: 'POST',
      data: { page: page },
      success: function (rendu) {
        $('#pagination_data').html(rendu);
      },
      dataType: 'text',
    });
  }
  //on charge la premiere page
  loadPage(1);
  $(document).on('click', '.lienPagination', function () {
    let idLink = $(this).attr('id');
    page = idLink;
    loadPage(page);
  });
  $(document).on('click', '.precedent', function () {
    let idLink = $(this).attr('id');
    page = idLink;
    loadPage(page);
  });
  $(document).on('click', '.suivant', function () {
    let idLink = $(this).attr('id');
    page = idLink;
    loadPage(page);
  });
  //ajout
  $(document).on('click', '.addIcon', function () {
    let numBatiment = $('#numBatiment').text(),
      type = $('#type').text();
    $.ajax({
      url: '../dao/Pagination.php',
      method: 'POST',
      data: { numBatiment: numBatiment, type: type },
      success: function (data) {
        $('#result').html(data);
      },
      dataType: 'text',
    });
  });
  function edit_data(id, text, column_name) {
    $.ajax({
      url: '../dao/Pagination.php',
      method: 'POST',
      data: { id: id, text: text, column_name: column_name },
      dataType: 'text',
      success: function (data) {
        $('#result').html(data);
      },
    });
  }
  $(document).on('blur', '.numBatiment', function () {
    var id = $(this).attr('id');
    var numBatiment = $(this).text();
    edit_data(id, numBatiment, 'numBatiment');
  });

  $(document).on('blur', '.type', function () {
    var id = $(this).attr('id');
    var type = $(this).text();
    edit_data(id, type, 'type');
  });
  //suppression de chambre
  $(document).on('click', '.supIcon', function () {
    theId = $(this).attr('id');
    $.ajax({
      url: '../dao/Pagination.php',
      method: 'POST',
      data: { theId: theId },
      dataType: 'text',
      success: function (data) {
        $('#result').html(data);
        loadPage(1);
      },
    });
  });
});
