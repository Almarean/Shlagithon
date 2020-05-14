$(document).ready(function () {
  $(".delete").on("click", function () {
    return confirm("Confirmez-vous la suppression ?");
  });
});