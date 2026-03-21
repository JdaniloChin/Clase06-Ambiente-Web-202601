$(document).ready(function(){
    const vPokemon = prompt("Ingrese el nombre del pokémon:","pikachu");

    if(!vPokemon){
        $('#resultados').html('<p class="text-danger><strong>Debe ingresar nombre pokémon.</strong></p>"')
    }

    const url = `https://pokeapi.co/api/v2/pokemon/${vPokemon.toLowerCase()}`;

    $.get(url)
        .done(function(data){
            const tipos = data.types.map(t=> t.type.name.charAt(0).toUpperCase() + t.type.name.slice(1)).join(', ');
            $('#resultados').html(`
                <div class="text-center">
                    <h5 class="text-success text-capitalize">${data.name}</h5>
                    <img src="${data.sprites.front_default}" alt="${data.name}" class="img-fluid mb-3" width="150">
                    <p><strong>Id de pkémon:</strong> ${data.id}</p>
                    <p><strong>Tipo(s):</strong> ${tipos}</p>
                </div>`); 
        })
        .fail(function(){
            $('#resultados').html('<p class="text-danger><strong>Pokémon No encontrado.</strong></p>"')
        });
});