$("#button-add-ustencil").on("click", function () {
    let ustencilQuantity = parseInt($("#ustencil-quantity").val());
    if (!ustencilQuantity > 0) {
        ustencilQuantity = 1;
    }
    $("#ustencils").append("<li><span class='ustencil-quantity'>" + ustencilQuantity + "</span> <span class='ustencil'>" + $.trim($("#input-ustencil").val()) + "</span> <i class='fas fa-minus text-danger pointer'></li>");
    $("#input-ustencil").val("");
});

$("#button-add-ingredient").on("click", function () {
    let ingredientQuantity = parseInt($("#ingredient-quantity").val());
    if (!ingredientQuantity.length > 0) {
        ingredientQuantity = 1;
    }
    let unit = $("#select-unit").val();
    $("#ingredients").append("<li><span class='ingredient-quantity'>" + ingredientQuantity + " " + unit + "</span> <span class='ingredient'>" + $.trim($("#input-ingredient").val()) + "</span> <i class='fas fa-minus text-danger pointer'></li>");
    $("#input-ingredient").val("");
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