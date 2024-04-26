function set_zeros() {
    var collection = document.querySelectorAll(".goal-container");
    for (let index = 0; index < collection.length; index++) {
        const element = collection[index];
        if (element.textContent == "") {
            element.textContent = "0";
        }
    }
}

set_zeros();

function upload_image(element) {
    element.closest('td').querySelectorAll("input")[0].click();
}
function paint_upload_button(element) {
    if (this.value != '') {
        element.closest('td').querySelectorAll("button")[0].classList.add("loaded-img-button");
        element.closest('td').querySelectorAll("button")[0].textContent = "✅ Archivo cargado";
    } else {
        element.closest('td').querySelectorAll("button")[0].classList.remove("loaded-img-button");
        element.closest('td').querySelectorAll("button")[0].textContent = "Cargar archivo";
    }
}

function add_player_row_form() {
    var players = document.querySelectorAll(".player-row").length;
    if (players == 0) {
        players = 0;
        var target = document.querySelectorAll("#form-table-body")[0];
    } else {
        var target = document.querySelector(".player-row").closest("tbody");
    }
    var dom = ('<tr class="player-row"><td class="submain-bg-color"> <input class="form-control main-bg-color submain-color player-field" type="text" name="player-name' + players + '" id="player-name' + players + '" required /></td> <td class="submain-bg-color"><input class="form-control main-bg-color submain-color player-field" type="text" name="player-last-names-' + players + '" id="player-last-names-' + players + '" required /></td> <td class="submain-bg-color"><button class="btn form-control submain-color text-nowrap" type="button" style="background-color: gray;" onclick="javascript:upload_image(this);">Cargar archivo</button><input id="player_photo" class="form-control d-none player-field" type="file" name="player-photo' + players + '" id="player-photo' + players + '" accept="img/*" required onchange="javascript:paint_upload_button(this);" /></td> <td class="submain-bg-color"><input class="form-control main-bg-color submain-color player-field" type="text" name="player-nickname-' + players + '" id="player-nickname-' + players + '" /></td> <td class="submain-bg-color" type="number" name><input class="form-control main-bg-color submain-color player-field" type="text" name="player-number-' + players + '" id="player-number-' + players + '" /></td> </tr>');
    target.innerHTML += dom;
    if (document.querySelectorAll(".player-row").length > 1) {
        document.getElementById("delete-button").removeAttribute("disabled");
    }
}
function remove_player_row_form() {
    var players = document.querySelectorAll(".player-row").length;
    var target = document.querySelector(".player-row").closest("tbody");
    if (players > 1) {
        target.removeChild(document.querySelectorAll(".player-row")[players - 1]);
    } else {
        document.getElementById("delete-button").setAttribute("disabled", "true");
    }
}