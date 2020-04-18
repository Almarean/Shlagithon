$(document).ready(function () {
    $("#apply").on("click", function (event) {
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

        let steps = $.map($("#steps > li"), element => {
            return { description: $.trim($(element).text()) };
        });

        let formData = new FormData($("#form-recipe")[0]);
        formData.append("image", $("#image")[0].files);
        formData.append("ustencils", JSON.stringify(ustencils));
        formData.append("ingredients", JSON.stringify(ingredients));
        formData.append("tags", JSON.stringify(tags));
        formData.append("steps", JSON.stringify(steps));

        if (ustencils.length > 0 && ingredients.length > 0 && steps.length > 0) {
            if ($("#comments").length > 0) {
                $("#comments").html("");
            }
            $("#apply").attr("disabled", false);
            $.ajax({
                url: "publication",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    let responseData = JSON.parse(response);
                    $("#comments").html("");
                    if (Array.isArray(responseData)) {
                        $("#comments").append("<div class='m-auto'>");
                        responseData.forEach(function (error) {
                            $("#comments").append("<div class='alert alert-danger text-center' role='alert'><i class='fas fa-exclamation-triangle'></i> " + error + "</div>");
                        });
                        $("#comments").append("</div>");
                    } else {
                        if (responseData === "success") {
                            $("#comments").append("<div class='alert alert-success text-center' role='alert'><i class='fas fa-check'></i> Publication réussie !</div>");
                        }
                    }
                }
            });
        } else {
            $("#comments").append("<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> Veuillez compléter l'intégralité du formulaire.</p>");
        }
    });
});