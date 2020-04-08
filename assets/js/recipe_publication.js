$("#button-add-ustencil").on("click", function () {
    let ustencilQuantity = parseInt($("#ustencil-quantity").val());
    if (!ustencilQuantity > 0) {
        ustencilQuantity = 1;
    }
    let ustencilValue = $.trim($("#input-ustencil").val());
    let ustencilError = $("#ustencil-error");
    if (ustencilValue.length > 0) {
        $("#ustencils").append("<li><span class='ustencil-quantity'>" + ustencilQuantity + "</span> <span class='ustencil'>" + ustencilValue + " <i class='fas fa-minus text-danger pointer'></li>");
        $("#input-ustencil").val("");
        if (ustencilError.html().length > 0) {
            ustencilError.html("");
        }
    } else {
        ustencilError.html("<i class='fas fa-exclamation-triangle'></i> L'ustensile doit être renseigné.");
    }
});

$("#button-add-ingredient").on("click", function () {
    let ingredientQuantity = parseInt($("#ingredient-quantity").val());
    if (!ingredientQuantity.length > 0) {
        ingredientQuantity = 1;
    }
    let unit = $("#select-unit").val();
    let ingredientValue = $.trim($("#input-ingredient").val());
    let ingredientError = $("#ingredient-error");
    if (ingredientValue.length > 0 && unit !== null) {
        $("#ingredients").append("<li><span class='ingredient-quantity'>" + ingredientQuantity + " " + unit + "</span> <span class='ingredient'>" + ingredientValue + "</span> <i class='fas fa-minus text-danger pointer'></li>");
        $("#input-ingredient").val("");
        if (ingredientError.html().length > 0) {
            ingredientError.html("");
        }
    } else {
        ingredientError.html("<i class='fas fa-exclamation-triangle'></i> L'ingrédient et/ou l'unité doivent être renseignés.");
    }
});

$("#button-add-tag").on("click", function () {
    let tagValue = $.trim($("#input-tag").val());
    if (tagValue.length > 0) {
        $("#tags").append("<span class='badge badge-pill badge-dark ml-2 pointer'>" + tagValue + "</span>");
        $("#input-tag").val("");
    }
});

$("#button-add-allergen").on("click", function () {
    let allergenValue = $.trim($("#input-allergen").val());
    if (allergenValue.length > 0) {
        $("#allergens").append("<li class='allergen'>" + allergenValue + " <i class='fas fa-minus text-danger pointer'></li>");
        $("#input-allergen").val("");
    }
});

$("#ustencils").click(function (event) {
    if (event.target.nodeName === "svg") {
        $(event.target).parent().remove();
    } else if (event.target.nodeName === "path") {
        $(event.target).parent().parent().remove();
    }
});

$("#ingredients").click(function (event) {
    if (event.target.nodeName === "svg") {
        $(event.target).parent().remove();
    } else if (event.target.nodeName === "path") {
        $(event.target).parent().parent().remove();
    }
});

$("#tags").click(function (event) {
    if (event.target.nodeName === "SPAN") {
        $(event.target).remove();
    }
});

$("#allergens").click(function (event) {
    if (event.target.nodeName === "svg") {
        $(event.target).parent().remove();
    } else if (event.target.nodeName === "path") {
        $(event.target).parent().parent().remove();
    }
});