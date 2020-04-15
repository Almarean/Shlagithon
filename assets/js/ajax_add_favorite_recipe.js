$(document).ready(function () {
    $("#button-add-favorite").on("click", function () {
        $.ajax({
            url: "add-favorite-recipe",
            type: "POST",
            data: "recipe-id=" + $("#button-add-favorite").val(),
            success: function () {
                const buttonAddFavorite = $("#button-add-favorite");
                buttonAddFavorite.html("<i class='fas fa-star'></i> Supprimer des favoris")
            }
        });
    });
});