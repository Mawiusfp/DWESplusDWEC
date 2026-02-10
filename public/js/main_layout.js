
function load_document() {
    fetch('json/submenu.json')
        .then(response => response.json()
        .then(data => {
            console.log(data)
        })
    );
 }

let navbar_ids = ['inicio', 'planes', 'sesiones', 'bloques', 'resultados'];

document.addEventListener('DOMContentLoaded', () => {
    navbar_ids.forEach(id => {
        const select = document.getElementById(id);

        if (!select) return;

        select.addEventListener('change', function () {
            
            console.log(id, "selected:", this.value);
        });
    });
});


/*
    Si te vas a /resources/views/home.blade.php

    veras que hay un <div id="body"> que esta vacio

    lo que hay que hacer es que al clickar en uno de los selects que hay

    dentro de este div salgan las cosas que estan en el .json 

    (hay uno en /public/json/submenu.json que puedes usar aunque ta
    un poco cutre)
*/