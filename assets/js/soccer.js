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
    } else {
        element.closest('td').querySelectorAll("button")[0].classList.remove("loaded-img-button");
        element.closest('td').querySelectorAll("button")[0].textContent = "✅ Archivo cargado";
    }
}