$(document).ready(function () {
  // Display content in relation to the value in the select.
  $("#select-requirement").change(function () {
    let selectVal = $("#select-requirement").val();
    $("#comments").html("");
    if ($.trim(selectVal) !== "") {
      $.ajax({
        url: "requirements",
        type: "POST",
        data: "category=" + selectVal,
        success: function (response) {
          $("#requirements-list").html(renderTemplate(selectVal, JSON.parse(response)));
        }
      });
    } else {
      $("#requirements-list").html("");
    }
  });

  // Remove a requirement from the list.
  $(document).on("click", ".list-group-item .remove", function (event) {
    let target = $(event.target);
    if (!target.is("a")) {
      target = target.closest("a");
    }
    $("#comments").html("");
    $.ajax({
      url: "requirements",
      type: "POST",
      data: "remove=" + target.data("id") + "&type=" + target.data("type"),
      success: function (response) {
        if (response === "1") {
          target.closest("li").remove();
        } else {
          $("#comments").html(`<div class="alert alert-danger text-center" role="alert">Une anomalie est survenue dans la suppression.</div>`);
        }
      }
    });
  });

  // Create a new requirement.
  $(document).on("click", "#apply", function (event) {
    let target = $(event.target);
    let type = $.trim(target.data("type"));
    let requirement = $.trim($("#input-requirement").val());
    $("#comments").html("");
    let data = "";
    if (type === "ingredient") {
      data = "insert=" + requirement + "&type=" + type + "&allergen=" + $("#select-allergens").val();
    } else {
      data = "insert=" + requirement + "&type=" + type;
    }
    if (requirement.length > 0) {
      $.ajax({
        url: "requirements",
        type: "POST",
        data: data,
        success: function (response) {
          if (response !== "0") {
            $("#list-group-requirements").append(
              `<li class="list-group-item">${requirement}
                <a type="button" class="text-danger float-right pointer remove" data-type="${type}" data-id="${response}" title="RemoveRequirement"><i class="fas fa-trash"></i></a>
              </li>`);
          } else {
            $("#comments").html(`<div class="alert alert-danger text-center" role="alert">Une anomalie est survenue dans l'insertion.</div>`);
          }
        }
      });
      $("#input-requirement").val("");
    }
  });
});

/**
 * Create a template to render in the AJAX callback.
 *
 * @param {string} type
 * @param {array} data
 *
 * @return {string}
 */
function renderTemplate(type, data) {
  let listTemplate = "";
  for (let [key, requirement] of Object.entries(data["requirements"])) {
    listTemplate += `<li class="list-group-item">${requirement.label}
                      <a type="button" class="text-danger float-right pointer remove" data-type="${type}" data-id="${requirement.id}" title="RemoveRequirement"><i class="fas fa-trash"></i></a>
                    </li>`;
  }
  let listAllergensTemplate = "";
  if (type === "ingredient" && data["allergens"]) {
    listAllergensTemplate += `<div class="form-group">
                                <label for="select-allergens">Allergène</label>
                                <select class="form-control" id="select-allergens">
                                  <option value="0">Rien</option>`;
    for (let [key, allergen] of Object.entries(data["allergens"])) {
      listAllergensTemplate += `<option value="${allergen.id}">${allergen.label}</option>`;
    }
    listAllergensTemplate += `</select></div>`;
  }
  return `<div class="row">
            <div class="col-md-6">
              <div class="form-group mt-3 mx-auto">
                <label for="input-requirement">${defineTitle(type)}</label>
                <input type="text" class="form-control" name="requirement" id="input-requirement" required>
              </div>
              ${listAllergensTemplate}
              <div class="text-center">
                <button class="btn btn-dark" data-type="${type}" id="apply" title="AddRequirement">Ajouter</button>
              </div>
            </div>
            <div class="col-md-6 overflow-auto" style="height: 344px;" id="${type}s">
              <ul class="list-group" id="list-group-requirements">${listTemplate}</ul>
            </div>
          </div>`;
}

/**
 * Define the title in relation to the given type.
 *
 * @param {string} type
 *
 * @return {string}
 */
function defineTitle(type) {
  let title = "";
  switch ($.trim(type)) {
    case "ingredient":
      title = "Ingrédient";
      break;
    case "ustencil":
      title = "Ustensile";
      break;
    case "tag":
      title = "Tag";
      break;
    case "allergen":
      title = "Allergène";
      break;
  }
  return title;
}