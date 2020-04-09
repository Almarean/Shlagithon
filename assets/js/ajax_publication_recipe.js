$(document).ready(function () {
    $("#add").on("click", function () {
        event.preventDefault();

        let ustencils = $.map($("#ustencils > li"), element => {
            return {
                name: $.trim($(element).find(".ustencil").text()).toLowerCase(),
                quantity: $.trim($(element).find(".ustencil-quantity").text()).toLowerCase()
            };
        });

        let ingredients = $.map($("#ingredients > li"), element => {
            return {
                name: $.trim($(element).find(".ingredient").text()).toLowerCase(),
                quantity: $.trim($(element).find(".ingredient-quantity").text()).toLowerCase()
            };
        });

        let tags = $.map($("#tags > span"), element => {
            return {name: $.trim($(element).text().toLowerCase())};
        });

        let allergens = $.map($("#allergens > li"), element => {
            return {name: $.trim($(element).text().toLowerCase())};
        });

        if (ustencils.length > 0 && ingredients.length > 0) {
            if ($("#comments").length > 0) {
                $("#comments").html("");
            }
            $("#apply").attr("disabled", false);
            $.ajax({
                url: "publication-recipe",
                type: "POST",
                data: "ustencils=" + JSON.stringify(ustencils) + "&ingredients=" + JSON.stringify(ingredients) + "&tags=" + JSON.stringify(tags) + "&allergens=" + JSON.stringify(allergens),
                success: function () {
                    $("#comments").append("<p class='text-success'><i class='fas fa-check'></i> Ajouts réussis.</p>");
                }
            });
        } else {
            $("#comments").append("<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> Veuillez renseigner des ustensiles et des ingrédients.</p>");
        }
    });
});