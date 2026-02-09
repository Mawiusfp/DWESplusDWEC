
function load_document() {
    fetch('json/submenu.json')
        .then(response => response.json()
        .then(data => {
            console.log(data)
        })
    );
 }

document.addEventListener('DOMContentLoaded', () => {
    console.log("This is the js for the template of all (most) pages");
    load_document();   
});
