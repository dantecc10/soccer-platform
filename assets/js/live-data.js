function update_live_stats() {
    const query = (".events-container");
    const containers_array = document.querySelectorAll(query);
    let id_string;
    let id_number;
    for (let index = 0; index < containers_array.length; index++) {
        const element = containers_array[index];
        const id = element.getAttribute('id');
        id_string = id.substr(5, id.length);
        id_number = parseInt(id_string);
        element.innerHTML(update_event_data(id_number));

        console.log("Elemento " + index + "; id: " + id_number);
    }
    console.log("Hubo " + containers_array.length + " elementos");
}

function update_event_data(id) {
    var xhr = new XMLHttpRequest();
    var url = 'php scripts/actions.php?type=update-event-data';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            return xhr.responseText;
            console.log('Solicitud enviada correctamente.');
        }
    };
    xhr.send(id);
}