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