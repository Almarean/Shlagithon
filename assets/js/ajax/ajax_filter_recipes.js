$(document).ready(function () {
  // Filter the recipes by a given word.
  $("#search-button").on("click", function (event) {
    event.preventDefault();
    let filter = $("#search-input").val();
    $.ajax({
      url: "filter-recipes",
      type: "GET",
      data: "category=word&filter=" + filter,
      success: function (response) {
        let data = $.parseJSON(response);
        if (data.length > 0) {
          renderTemplate(data, $("#filtered-recipes"), filter);
        } else {
          renderEmptyTemplate($("#filtered-recipes"));
        }
      }
    });
  });

  // Filter the recipes by a given tag.
  $("span[data-type='tag']").on("click", function (event) {
    let tag = $(event.target).html();
    $.ajax({
      url: "filter-recipes",
      type: "GET",
      data: "category=tag&filter=" + tag,
      success: function (response) {
        let data = $.parseJSON(response);
        if (data.length > 0) {
          renderTemplate(data, $("#filtered-recipes"), tag);
        } else {
          renderEmptyTemplate($("#filtered-recipes"));
        }
      }
    });
  });

  // Filter the recipes by a given type.
  $("span[data-type='type']").on("click", function (event) {
    let type = $(event.target).attr("id");
    $.ajax({
      url: "filter-recipes",
      type: "GET",
      data: "category=type&filter=" + type,
      success: function (response) {
        let data = $.parseJSON(response);
        if (data.length > 0) {
          renderTemplate(data, $("#filtered-recipes"), type);
        } else {
          renderEmptyTemplate($("#filtered-recipes"));
        }
      }
    });
  });

  // Reset the HTML generate by the filter.
  $("span#reset-filter").on("click", function () {
    $("#filtered-recipes").html("");
  });
});

/**
 * Render a template for the filter.
 *
 * @param {string} data
 * @param {jQuery object} div
 * @param {string} filter
 */
function renderTemplate(data, div, filter) {
  div.html("");
  $.each(data, function (key, value) {
    let description = value["rec_description"];
    if (description.length > 255) {
      description = description.substring(0, 255) + "...";
    }
    let difficulty = value["rec_difficulty"];
    let difference = 5 - difficulty;
    let difficultyToDisplay = "";
    for (let i = 0; i < difficulty; i++) {
      difficultyToDisplay += `<span><i class="fas fa-circle"></i></span>`;
    }
    for (let i = 0; i < difference; i++) {
      difficultyToDisplay += `<span><i class="far fa-circle"></i></span>`;
    }
    div.append(
      `<a href="recipe-details?filter=${filter}&id=${value["rec_id"]}" class="card text-dark mb-4 w-100">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="https://thomaslaure.alwaysdata.net/Shlagithon/assets/images/${value["rec_image"]}" class="card-img w-100" alt="image">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">${value["rec_name"]}</h5>
              <p class="card-text">${description}</p>
              <div class="row">
                <div class="col-md-4 text-center"><p class="card-text">${difficultyToDisplay}</p></div>
                <div class="col-md-4 text-center"><p class="card-text"><i class="fas fa-stopwatch"></i> ${value["rec_time"]} min</p></div>
                <div class="col-md-4 text-center"><p class="card-text"><i class="fas fa-users"></i> ${value["rec_nb_persons"]} personne.s</p></div>
              </div>
            </div>
          </div>
        </div>
      </a>`
    );
  });
}

/**
 * Render en empty template.
 *
 * @param {jQuery object} div
 */
function renderEmptyTemplate(div) {
  div.html("");
  div.append(
    `<div class="card w-100">
      <div class="card-body m-auto">
        <p class="card-text">Aucun résultat</p>
      </div>
    </div>`
  );
}