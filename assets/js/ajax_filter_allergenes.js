var type_ing = "ingredient";
var type_alle = "allergene";
var type_tag = "tag";
var type_uste = "ustencil";
$(document).ready(function () {
    let list;
    let validInput;
    let input;

    $("#select-filter").change(function () {
        let selectVal = $("#select-filter").val();
        window.location.search = "?filter=" + selectVal;
    });
    
    switch ($("#select-filter").val()) {
        case "allergene":
            break;
        case type_ing:
            list = document.getElementsByName("ingred");

            for (element of list) {
                let elementid = element.id;
                element.onclick = function () {
                    deleteAllergene(elementid, type_ing);
                };
            }

            input = document.getElementById(type_ing);
            input.oninput = function () {
                checkIfExists(input.value, type_ing);
            };

            validInput = document.getElementById("apply");
            validInput.onclick = function () {
                addAllergene(input.value, type_ing);
            };
            break;
        case type_uste:
            list = document.getElementsByName("uste");

            for (element of list) {
                let elementid = element.id;
                element.onclick = function () {
                    deleteAllergene(elementid, type_uste);
                };
            }

            input = document.getElementById(type_uste);
            input.oninput = function () {
                checkIfExists(input.value, type_uste);
            };

            validInput = document.getElementById("apply");
            validInput.onclick = function () {
                addAllergene(input.value, type_uste);
            };
            break;
        case "tag":
            list = document.getElementsByName("ta");

            for (element of list) {
                let elementid = element.id;
                element.onclick = function () {
                    deleteAllergene(elementid, type_tag);
                };
            }

            input = document.getElementById(type_tag);
            input.oninput = function () {
                checkIfExists(input.value, type_tag);
            };

            validInput = document.getElementById("apply");
            validInput.onclick = function () {
                addAllergene(input.value, type_tag);
            };
            break;
    }
});


function checkIfExists(label, type) {
    $.ajax({
        url: "filter-allergenes",
        type: "POST",
        data: "test-" + type + "=" + $.trim(label),
        success: function (data) {
            if (data) {
                document.getElementById(type).style.borderColor = "red";
                document.getElementById('apply').disabled = true;
            } else {
                document.getElementById(type).style.borderColor = "green";
                document.getElementById('apply').disabled = false;
            }
        }
    });
}

function addAllergene(label, type) {
    $.ajax({
        url: "filter-allergenes",
        type: "POST",
        data: "add-" + type + "=" + $.trim(label),
        success: function (data) {
            if (data) {
                showToast(label);
                addAllergeneToList(label, type)
            }
        }
    });
}

async function showToast(label) {
    let toast = "<div class='alert alert-success' id='toast' role='alert'>" +
        label + " ajouté avec succès" +
        "</div>";
    document.body.innerHTML += toast;
    await new Promise(r => setTimeout(r, 2000));

    $("#toast").remove();
}

function addAllergeneToList(label, type) {
    $.ajax({
        url: "filter-allergenes",
        type: "POST",
        data: "getid-" + type + "=" + label,
        success: function (data) {
            let div = "<li class='list-group-item'>" + label +
                "<a class=' text-danger' name='ingred' style='float:right;' title='removeIngredient' id="+ data +">" +
                "<i class='fas fa-trash'></i>" +
                "</a>" +
                "</li>";
            let list = document.getElementById("list-group-" + type);
            list.innerHTML += div;
            document.getElementById(data).onclick = function () {
                deleteAllergene(data, type);
            };
        }
    });
}

function deleteAllergene(id, type) {
    $.ajax({
        url: "filter-allergenes",
        type: "POST",
        data: "rm-" + type + "=" + id,
        success: function (data) {
            if (data) {
                removeFromList(id, type);
            }
        }
    });
}

function removeFromList(id, type) {
    document.getElementById(id).parentElement.remove();
}