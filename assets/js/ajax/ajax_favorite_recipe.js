$(document).ready(function () {
  // Add a favorite recipe.
  $("#button-add-favorite").on("click", function () {
    let recipeId = $("#button-add-favorite").val();
    $.ajax({
      url: "favorite-recipe",
      type: "POST",
      data: "action=add&recipe-id=" + recipeId,
      success: function () {
        $("#button-delete-favorite").attr("hidden", false);
        $("#button-add-favorite").attr("hidden", true);
      }
    });
  });

  // Remove a favorite recipe.
  $("#button-delete-favorite").on("click", function () {
    let recipeId = $("#button-delete-favorite").val();
    $.ajax({
      url: "favorite-recipe",
      type: "POST",
      data: "action=delete&recipe-id=" + recipeId,
      success: function () {
        $("#button-delete-favorite").attr("hidden", true);
        $("#button-add-favorite").attr("hidden", false);
      }
    });
  });
});