function showSearchBar() {
    var x = document.getElementById("searchBox");

    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function showBook(title) {
    var x = document.getElementById(title);

    x.style.display = "block";
}

function hideBook(title) {
    var x = document.getElementById(title);

    x.style.display = "none";
}

function addStopper(element) {
    element.addEventListener('click', event=>{
        event.stopPropagation();
    })
}

window.addEventListener('load', event=> {
    let elements = document.querySelectorAll('.bookInfo');
    for (let elem of elements) {
        addStopper(elem);
    }
})