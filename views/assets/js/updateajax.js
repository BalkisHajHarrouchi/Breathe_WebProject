$(document).ready(function() {
    $('$update_product').click(function() {
        var tdData = $(this).attr('data-value');
      var id_prduit = $('#id'+tdData).text();
      var prix_prduit = $('#prix'+tdData).text();
      
      $('#idp').val(id_prduit);
      $('#prixp').val(prix_prduit);
    });
  });