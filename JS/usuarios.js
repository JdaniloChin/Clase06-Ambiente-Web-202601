document.addEventListener('DOMContentLoaded', function(){
    const tablaUsuarios = document.getElementById('tablaUsuarios');
    const form = document.getElementById('formUsuarios');

    form.addEventListener('submit', function(e){
        e.preventDefault();

        const nombre = document.getElementById('nombre');
        const identificacion = document.getElementById('identificacion');
        const genero = document.getElementById('genero');
        const provincia = document.getElementById('provincia');
        const email = document.getElementById('email');
        const direccion = document.getElementById('direccion');

        //validaciones
        if(!nombre || !email || !identificacion || !provincincia == "-1"){
            alert("Por favor, complete los campos obligatorios");
            return;
        }

        
    });
});