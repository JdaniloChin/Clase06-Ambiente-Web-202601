document.addEventListener('DOMContentLoaded', function(){
    //Login Form
    const loginForm = document.getElementById('loginform');
    const loginError = document.getElementById('login-error');

    loginForm.addEventListener('submit', function(e){
        e.preventDefault();

        const user = document.getElementById('user').value;
        const password = document.getElementById('password').value;

        if(user === 'test@example.com' && password === 'password123'){
            window.location.href='home.html';
        }else{
            loginError.style.display = 'block'
        }
    });

    //Register form
    const registerForm = document.getElementById('registerform');
    const registerError = document.getElementById('register-error');
    const registerSuccess = document.getElementById('register-success');

    registerForm.addEventListener('submit',function(e){
        e.preventDefault();

        const name= document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-password-confirm')

        //Validar que las contraseñas coincidan
        if(password !== confirmPassword){
            registerError.innerHTML('<p>Las contraseñas no coinciden.<\p>')
            registerError.style.display = 'block';
            registerSuccess.style.display = 'none';
            return;
        }

        //Aqui vamos a escribir la logica para guardar en el servidor
        //Por ahora, solo simulamos

        registerError.style.display = 'none';
        registerSuccess.style.display = 'block';

        //Redirigir en 2 segundos
        setTimeout(()=>{
            window.location.href = 'home.html';
        }, 2000);
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