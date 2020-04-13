$(document).ready(function () {
    $("#apply").on("click", function () {
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
            return { name: $.trim($(element).text().toLowerCase()) };
        });

        let steps = $.map($("#step > li"), element => {
            return { name: $.trim($(element).text()) };
        });

        let formData = new FormData($("#form-recipe").get[0]);
        console.log(formData);
        let data = {
            name: $.trim($("#name").text()),
            description: $.trim($("#description").text()),
            time: $.trim($("#time").text()),
            type: $.trim($("#type").val()),
            difficulty: $.trim($("#difficulty").text()),
            nbPersons: $.trim($("#nb-persons").text()),
            advice: $.trim($("#advice").text()),
            ustencils: ustencils,
            ingredients: ingredients,
            tags: tags,
            steps: steps
        };

        if (ustencils.length > 0 && ingredients.length > 0) {
            if ($("#comments").length > 0) {
                $("#comments").html("");
            }
            $("#apply").attr("disabled", false);
            $.ajax({
                url: "publication",
                type: "POST",
                data: "data=" + JSON.stringify(data) + "&formData=" + JSON.stringify(formData),
                success: function () {}
            });
        } else {
            $("#comments").append("<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> Veuillez compléter l'intégralité du formulaire.</p>");
        }
    });
});