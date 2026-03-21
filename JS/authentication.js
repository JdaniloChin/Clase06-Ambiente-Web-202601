document.addEventListener('DOMContentLoaded', function(){
    //Login Form
    const loginForm = document.getElementById('loginform');
    const loginError = document.getElementById('login-error');

       //Login usuario ajax
    $(loginForm).on('submit', function(e){
        e.preventDefault();
        
        const datos = $(this).serialize();

        $.post('./includes/login.php', datos, function(respuesta){
            console.log("Login al sistema: ", respuesta);
            if(!loginError){
                console.error("no existe el div login-error");
                return;
            }
            loginError.innerHTML = `<p> ${respuesta} </p>`;
            loginError.classList.remove('alert-info', 'alert-danger', 'alert-success');
            if(respuesta.trim() === "Login exitoso"){
                loginError.classList.add('alert-success');
                loginError.style.display = "block";
                setTimeout(()=> {
                    window.location.href = 'home.php';
                }, 2000);
            }else{
                loginError.classList.add('alert-danger');
                loginError.style.display = "block";
            }
            
        });

    });

    //Register form
    const registerForm = document.getElementById('registerform');
    const registerError = document.getElementById('register-error');

    $(registerForm).on('submit',function(e){
        e.preventDefault();

        const password = $('#register-password').val();
        const confirm  = $('#register-password-confirm').val();

        //validacion del lado cliente rapida
        if(password !== confirm){
            registerError.className = 'alert alert-danger mt-3';
            registerError.innerHTML = '<p>Las contraseñas no coinciden.</p>';
            registerError.style.display = 'block';
            return;
        }

        const datos = $(this).serialize();
        $.post('./includes/register.php', datos, function(respuesta){
            const res = JSON.parse(respuesta);
            console.error('Respuesta de Register:', res)
            registerError.className = `alert alert-${res.tipo} mt-3`;
            registerError.innerHTML = `<p>${res.mensaje}</p>`;
            registerError.style.display = 'block';

            if(res.tipo === 'success'){
                setTimeout(()=>{
                    window.location.href = 'index.php';
                },2000);
            }
        });
    });

    // Toggle password dinamico
    const toggleButtons = document.querySelectorAll('button[id^="toggle"]');

    toggleButtons.forEach(button =>{
        button.addEventListener('click', function(){
            //Encontrar el input de contraseña asociado al boton en el input-group
            const passwordInput = this.parentElement.querySelector('input[type="password"], input[type="text"]');
            
            if(!passwordInput) return;

            const start = passwordInput.selectionStart;
            const end = passwordInput.selectionEnd;

            const mostrar = passwordInput.type === 'password';
            passwordInput.type = mostrar ? 'text' : 'password';

            const icon = this.querySelector('i');
            icon.classList.toggle('bi-eye', !mostrar);
            icon.classList.toggle('bi-eye-slash', mostrar);

            this.setAttribute('aria-label', mostrar ? 'Ocultar contraseña' : 'Mostrar contraseña');
            this.setAttribute('title', this.getAttribute('aria-label'));

            setTimeout(() => {
                passwordInput.focus();
                if (start !== null && end !== null) passwordInput.setSelectionRange(start, end);
            }, 0);

        });
    });

});