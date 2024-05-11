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
    if (element.value != '') {
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
    var dom = ('<tr class="player-row">' +
        '           <td class="submain-bg-color" >' +
        '               <input class="form-control main-bg-color submain-color player-field" type="text" name="player-name-' + players + '" id="player-name-' + players + '" required />' +
        '           </td >' +
        '           <td class="submain-bg-color">' +
        '           <input class="form-control main-bg-color submain-color player-field" type="text" name="player-last-names-' + players + '" id="player-last-names-' + players + '" required />' +
        '           </td>' +
        '           <td class="submain-bg-color">' +
        '               <button class="btn form-control submain-color text-nowrap" type="button" style="background-color: gray;" onclick="javascript:upload_image(this);">Cargar archivo</button>' +
        '               <input id="player-photo-' + players + '" class="form-control d-none player-field" type="file" name="player-photo-' + players + '" id="player-photo-' + players + '" accept="img/*" required onchange="javascript:paint_upload_button(this);" />' +
        '           </td>' +
        '           <td class="submain-bg-color">' +
        '               <input class="form-control main-bg-color submain-color player-field" type="text" name="player-number-' + players + '" id="player-number-' + players + '" required/>' +
        '           </td>' +
        '           <td class="submain-bg-color">' +
        '               <select id="player-position-' + players + '" class="form-select main-bg-color submain-color player-field" name="player-position-' + players + '" required>' +
        '                   <optgroup label="Posiciones">' +
        '                       <option value="Portero">Portero</option>' +
        '                       <option value="Defensa">Defensa</option>' +
        '                       <option value="Lateral">Lateral</option>' +
        '                       <option value="Mediocampista">Mediocampista</option>' +
        '                       <option value="Delantero">Delantero</option>' +
        '                       <option value="Extremo">Extremo</option>' +
        '                   </optgroup></select>' +
        '           </td>' +
        '           <td class="submain-bg-color">' +
        '              <input class="form-control main-bg-color submain-color player-field" type="text" name="player-nickname-' + players + '" id="player-nickname-' + players + '" />' +
        '           </td>' +
        '       </tr > ');
    target.insertAdjacentHTML('beforeend', dom);
    if (document.querySelectorAll(".player-row").length > 1) {
        document.getElementById("delete-button").removeAttribute("disabled");
    }
    set_hidden_input_value();
}
function remove_player_row_form() {
    var players = document.querySelectorAll(".player-row").length;
    var target = document.querySelector(".player-row").closest("tbody");
    if (players > 1) {
        target.removeChild(document.querySelectorAll(".player-row")[players - 1]);
    } else {
        document.getElementById("delete-button").setAttribute("disabled", "true");
    }
    set_hidden_input_value();
}

function set_hidden_input_value() {
    var quantity = document.querySelectorAll(".player-row").length;
    document.getElementById("players-quantity").value = quantity;
}
//set_hidden_input_value();

function checkbox_analyze(element) {
    checkboxes = document.querySelectorAll(".card-checkbox");
    for (let index = 0; index < checkboxes.length; index++) {
        if (element != checkboxes[index]) {
            checkboxes[index].checked = false;
        }
    }
}
function checkbox_clicker(element) {
    element.querySelector("input").click();
}

$(document).ready(function () {
    $('#foul-form').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        // Envía los datos mediante AJAX
        $.ajax({
            type: 'POST',
            url: 'php scripts/actions.php?type=foul',
            data: formData,
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

function team_detail(id) {
    var url = ("https://soccer.castelancarpinteyro.com/team-detail.php?id=" + id);

    window.location.href = url;
}
function add_players(id) {
    var url = ("https://soccer.castelancarpinteyro.com/add-players.php?team-id=" + id);

    window.location.href = url;
}

function check_selected_teams() {
    const local_id = document.getElementById("local-team").value;
    const visitor_id = document.getElementById("visitor-team").value;
    return (local_id != visitor_id);
}
document.getElementById("add-match-form").addEventListener("submit", function (event) {
    event.preventDefault();
    if (check_selected_teams()) {
        document.getElementById("add-match-form").submit();
    } else {
        alert("Los equipos seleccionados son los mismos, por favor selecciona equipos diferentes.");
    }
});

document.addEventListener('DOMContentLoaded', function () {
    // Tu código problemático aquí
    $('#foul-sender').click(function (event) {
        var formData = $('#foul-form').serialize();

        $.ajax({
            url: '../php%20scripts/actions.php?type=foul',
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

function foul_ajax(match, referee) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php%20scripts/actions.php?type=foul', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // La solicitud fue exitosa
            var response = (xhr.responseText);
            console.log("'" + response + "'");
            if (response == "true") {
                $('#modal-foul').modal('hide');
            }
        } else {
            console.error('Error: ' + xhr.status);
        }
    };

    xhr.onerror = function () {
        console.error('Error de red');
    };

    var formData = $('#foul-form').serialize();

    xhr.send(formData + "&match-id=" + match + "&referee-id=" + referee + "&match-score=" + match_score());
}

function goal_ajax(match, referee) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'php%20scripts/actions.php?type=goal', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            // La solicitud fue exitosa
            var response = (xhr.responseText);
            console.log(response);
            if (response == "true") {
                $('#modal-goal').modal('hide');
                (local_id == document.getElementById('goal-team').value) ? document.querySelectorAll(".goal-container")[0].innerHTML = (parseInt($('.goal-container')[0].innerHTML) + 1) : document.querySelectorAll(".goal-container")[1].innerHTML = (parseInt($('.goal-container')[1].innerHTML) + 1);
            }
        } else {
            console.error('Error: ' + xhr.status);
        }
    };

    xhr.onerror = function () {
        console.error('Error de red');
    };

    var formData = $('#goal-form').serialize();
    (local_id == document.getElementById('goal-team').value) ? "&local=true" : "&visitor=true";  
    xhr.send(formData + "&match-id=" + match + "&referee-id=" + referee + "&match-score=" + match_score());
}

function match_score() {
    return (document.querySelectorAll(".goal-container")[0].innerHTML + "," + document.querySelectorAll(".goal-container")[1].innerHTML);
}