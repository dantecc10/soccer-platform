function update_live_stats() {
    const query = (".events-container");
    const containers_array = document.querySelectorAll(query);
    for (let index = 0; index < containers_array.length; index++) {
        const element = containers_array[index];
        const id = element.getAttribute('id');
        console.log("Elemento " + index + "; id: " + id);
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
            console.log('Solicitud enviada correctamente.');
            return xhr.responseText;
        }
    };
    xhr.send(id);
}