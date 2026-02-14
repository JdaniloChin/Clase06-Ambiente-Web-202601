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

        const nuevaFila = tabla.insertRow();
        nuevaFila.innerHTML = `
        <td>${nombre}</td>
        <td>${cedula}</td>
        <td>${email}</td>
        <td>${genero}</td>
        <td>${provincia}</td>
        <td>${direccion}</td>
        <td>
            <a href="#" class="btn btn-warning btn-sm btnEditar">Editar</a>
            <a href="#" class="btn btn-danger btn-sm"
            onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
        </td>
        `;

        form.reset();

        const modal = bootstrap.Modal.getInstance(document.getElementById('modalFormulario'));
        modal.hide();
    });
});