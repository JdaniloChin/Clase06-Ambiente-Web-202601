document.addEventListener('DOMContentLoaded', function(){
    const tablaUsuarios = document.getElementById('tablaUsuarios');
    const form = document.getElementById('formUsuarios');
    const modalElement = document.getElementById('modalUsuarios')
    const modal = new bootstrap.Modal(modalElement);
    const modalTitle = document.getElementById('modalUsuariosLabel');
    

    cargarUsuarios();

    //Create (Guardar Usuario)
    $(form).on('submit', function(e){
        e.preventDefault();

        const datos = $(this).serialize();

        $.post('./includes/procesar_usuario.php', datos, function(respuesta){
            const data = JSON.parse(respuesta);
            console.log("Valor de respuesta: ", respuesta);
            const alerta = `<div class="alert alert-${data.tipo} alert-dismissible fade show" role="alert">
                ${data.mensaje} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>`;
            
            $('.modal-body').prepend(alerta);

            setTimeout(()=>{
                modal.hide();
                cargarUsuarios();
            },2000);

        });

    });

    //limpiar formulario del modal al cerrarlo
    $(modalElement).on('hidden.bs.modal',() =>{
        form.reset();
        $('#id_usuario').val('');
        modalTitle.textContent = 'Registro de Usuarios';
    });

    function cargarUsuarios(){
        $.get('./includes/obtener_usuarios.php', function(data){
            $('#tablaUsuarios tbody').html(data);
        });
    }
});