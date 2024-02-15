$(document).ready(function () {
    $("#search").keyup(function () {
      let specialty = 0;
      let check = document.querySelectorAll(".form-check-input");
      for (let i = 0; i < check.length; i++) {
        if (check[i].checked == true) specialty = check[i].value;
      }
      let input = $(this).val();
      $.ajax({
        url: "../views/search.php",
        method: "POST",
        data: { input: input, specialty: specialty },
        success: function (data) {
          $("#result_search").html(data);
        },
      });
      $("#result_search").html("");
    });
  });