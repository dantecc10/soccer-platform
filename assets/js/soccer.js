function set_zeros() {
    var collection = document.querySelectorAll(".goal-container");
    for (let index = 0; index < collection.length; index++) {
        const element = collection[index];
        if (element.textContent == "") {
            element.textContent = "0";
        }
    }
}