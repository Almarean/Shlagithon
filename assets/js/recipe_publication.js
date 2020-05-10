$("#button-add-ustencil").on("click", function () {
  let ustencilQuantity = parseInt($("#ustencil-quantity").val());
  if (!ustencilQuantity > 0) {
    ustencilQuantity = 1;
  }
  let ustencilValue = $.trim($("#input-ustencil").val().toLowerCase());
  let ustencils = $.map($(".ustencil"), function (ustencil) {
    return $.trim($(ustencil).text().toLowerCase());
  });
  if (ustencilValue.length > 0 && $.inArray(ustencilValue, ustencils)) {
    $("#ustencils").append("<li><span class='ustencil-quantity'>" + ustencilQuantity + "</span> <span class='ustencil'>" + ustencilValue + "</span> <i class='fas fa-minus text-danger pointer'></li>");
    $("#input-ustencil").val("");
    enableApplyButton();
  }
});

$("#button-add-ingredient").on("click", function () {
  let ingredientQuantity = parseInt($("#ingredient-quantity").val());
  if (ingredientQuantity.length === 0) {
    ingredientQuantity = 0;
  }
  let ingredientValue = $.trim($("#input-ingredient").val().toLowerCase());
  let ingredients = $.map($(".ingredient"), function (ingredient) {
    return $.trim($(ingredient).text().toLowerCase());
  });
  if (ingredientValue.length > 0 && $.inArray(ingredientValue, ingredients)) {
    let unit = $("#select-unit").val().toLowerCase();
    if (ingredientQuantity !== 0) {
      $("#ingredients").append("<li><span class='ingredient-quantity'>" + ingredientQuantity + " " + unit + "</span> <span class='ingredient'>" + ingredientValue + "</span> <i class='fas fa-minus text-danger pointer'></li>");
    } else {
      $("#ingredients").append("<li><span class='ingredient'>" + ingredientValue + "</span> <i class='fas fa-minus text-danger pointer'></li>");
    }
    $("#input-ingredient").val("");
    enableApplyButton();
  }
});

$("#button-add-tag").on("click", function () {
  let tagValue = $.trim($("#input-tag").val());
  let tags = $.map($("#tags .badge"), function (tag) {
    return $.trim($(tag).text());
  });
  if (tagValue.length > 0 && $.inArray(tagValue, tags)) {
    $("#tags").append("<span class='badge badge-pill badge-dark ml-2 pointer'>" + tagValue + "</span>");
    $("#input-tag").val("");
  }
});

$("#button-add-step").on("click", function () {
  let stepValue = $.trim($("#input-step").val());
  if (stepValue.length > 0) {
    $("#steps").append("<li class='step'>" + stepValue + " <i class='fas fa-minus text-danger pointer'></li>");
    $("#input-step").val("");
    enableApplyButton();
  }
});

$("#ustencils").click(event => removeElement(event));
$("#ingredients").click(event => removeElement(event));
$("#steps").click(event => removeElement(event));

$("#tags").click(function (event) {
  if (event.target.nodeName === "SPAN") {
    $(event.target).remove();
  }
});

/**
 * Enable the apply button if we can find ustencils and ingredients.
 */
function enableApplyButton() {
  if ($("#ustencils > li").length > 0 && $("#ingredients > li").length > 0 && $("#steps > li").length > 0) {
    $("#apply").prop("disabled", false);
  } else {
    $("#apply").prop("disabled", true);
  }
}

/**
 * Remove an element from a list.
 *
 * @param {*} event
 */
function removeElement(event) {
  if (event.target.nodeName === "I") {
    $(event.target).closest("li").remove();
  }
  enableApplyButton();
}