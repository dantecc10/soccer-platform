function update_live_stats() {
    const query = (".events-container");
    const containers_array = document.querySelectorAll(query);
    let id_string;
    let id_number;
    for (let index = 0; index < containers_array.length; index++) {
        const element = containers_array[index];
        const id = element.getAttribute('id');
        id_string = id.substr(6, id.length);
        id_number = parseInt(id_string);
        update_event_data(id_number);

        console.log("Elemento " + index + "; id: " + id_number);
    }
    console.log("Hubo " + containers_array.length + " elementos");
}
function update_event_data(id) {
    var xhr = new XMLHttpRequest();
    var url = 'php scripts/actions.php?type=update-event-data';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.response);
            const response_array = xhr.response.split("*");
            document.getElementById('match-' + id).innerHTML = response_array[0];
            update_goal_container(id, response_array[1]);
        }
    };
    var data = 'id=' + encodeURIComponent(id);
    xhr.send(data);
}

function update_goal_container(id, new_score){
    const base = document.getElementById('match-' + id);
    const score_array = new_score.split("-");
    const targets = base.querySelectorAll('.goal-container');
    targets[0].innerHTML = score_array[0];
    targets[1].innerHTML = score_array[1];
}

setInterval(update_live_stats, 8000);