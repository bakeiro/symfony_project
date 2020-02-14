window.addEventListener("DOMContentLoaded", (event) => {
    
    // Click
    let search_button = window.document.getElementById("search_pokemon_button");
    search_button.addEventListener("click", (event) => {        
        let pokemon_name = window.document.getElementById("pokemon_name").value;
        
        fetch(`/pokemon_api/${pokemon_name}`).then((headers) => {
            return headers.json();
        }).then((response) => {

            if(typeof response.pokemon_information.name !== "undefined") {
                let pokemon_info_div = window.document.getElementById("pokemon_info");
                let content_html = `
                    <h1>Pokemon info</h1>
                    <p>name: ${response.pokemon_information.name} </p>
                    <p>order: ${response.pokemon_information.order} </p>
                    <p>weight: ${response.pokemon_information.weight} </p>
                    <p>base experience: ${response.pokemon_information.base_experience} </p>
                `;
                pokemon_info_div.innerHTML = content_html;
            } else {
                alert("Not found!");
            }

        }).catch((response) => {
            console.log(`Error during ajax: ${response.message}`);
        });

    });
});