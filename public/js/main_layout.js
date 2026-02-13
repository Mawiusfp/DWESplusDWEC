
async function replace_body(category, subcategory) {
    const res = await fetch('json/submenu.jsonx');
    const json = await res.json();

    const item = json[category].find(x => x.title === subcategory);
    console.log(category, item.description);

    body_div.innerHTML = "";

    let h2 = document.createElement('h2');
    h2.textContent = category;

    let desc = document.createElement('p');
    desc.textContent = item.description;

    body_div.appendChild(h2);
    body_div.appendChild(desc);
}


async function populate_selects() {
    const res = await fetch('json/submenu.jsonx');
    const data_json = await res.json();
    
    navbar_ids.forEach(id => {
        const select = document.getElementById(id);
        if (!select) {
            console.log(`[ERROR] El elemento #${id} no existe`);
            return;
        }

        data_json[id].forEach(element => {
            const opt = document.createElement('option');
            opt.value = element.title;
            opt.textContent = element.title;
            select.appendChild(opt);
        });

        select.addEventListener('change', () => {
            replace_body(id, select.value);
        });
    });
}

let navbar_ids = ['inicio', 'planes', 'sesiones', 'bloques', 'resultados'];

let body_div;

document.addEventListener('DOMContentLoaded', () => {
    populate_selects();
    body_div = document.getElementById('body');
});
