document.addEventListener('DOMContentLoaded', function(){
    const tablaUsuarios = document.getElementById('tablaUsuarios');
    const form = document.getElementById('formUsuarios');
    const modalElement = document.getElementById('modalUsuarios')
    const modal = new bootstrap.Modal(modalElement);
    const modalTitle = document.getElementById('modalUsuariosLabel');
    const inputPassword = document.getElementById('password');
    

    cargarUsuarios();

    //Create - Update (Guardar Usuario)
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
        inputPassword.setAttribute('required','');
    });

    //Read obtener lista usuarios
    function cargarUsuarios(){
        $.get('./includes/obtener_usuarios.php', function(data){
            $('#tablaUsuarios tbody').html(data);
        });
    }

    //Update Modificar usuario
    $(document).on('click', '.btnEditar', function(){
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        const correo = $(this).data('correo');
        const genero = $(this).data('genero');
        const rol = $(this).data('rol');
        const estado = $(this).data('estado');

        //cambiar el titulo del formulario
        modalTitle.textContent = "Editar Usuario";

        //precargar los datos del usuario en la tabla del formulario
        $('#id_usuario').val(id);
        $('#nombre').val(nombre);
        $('#email').val(correo);
        $('#rol').val(rol);
        $('#estado').val(estado);

        //Genero radio buttons
        $('input[name="genero"]').prop('checked',false);
        $('input[name="genero"][vaule="'+ genero +'"]').prop('checked',true);

        $('#password').val('');
        inputPassword.removeAttribute('required');

        modal.show();
    });

    //Delete Eliminar usuario
    $(document).on('click','.btnEliminar',function(e){
        e.preventDefault();
        if(!confirm('¿Esta seguro de eliminar este usuario?')) return;
        const id = $(this).data('id');

        $.get(`./includes/procesar_usuario.php?eliminar=${id}`, function(respuesta){
            const data = JSON.parse(respuesta);
            alert(data.mensaje);
            cargarUsuarios();
        });
    });
});