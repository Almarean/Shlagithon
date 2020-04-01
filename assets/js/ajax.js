$(document).ready(function () {
  $("#search-button").on("click", function (event) {
    event.preventDefault();
    let filter = $("#search-input").val();
    $.ajax({
      url: "filter-recipes",
      type: "POST",
      data: "filter=" + filter,
      success: function (response) {
        let div = $("#filtered-recipes");
        let data = $.parseJSON(response);
        $.each(data, function (key, value) {
          div.append(
            "<a href='recipe-details?id=" + value["rec_id"] + "' class='col-md-4'>" +
              "<div class='card' style='width: 18rem;'>" +
                  "<img class='card-img-top mx-auto' src='" + value["rec_image"] + "' style='width: 250px; height: 250px;' alt='image'>" +
                  "<div class='card-body'>" +
                    "<h5 class='card-title'>" + value["rec_name"] + "</h5>" +
                  "</div>" +
              "</div>" +
            "</a>"
          );
        });
      }
    });
  });
});