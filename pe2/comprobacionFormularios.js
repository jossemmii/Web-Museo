function validarLogin(){
    const usuario = document.getElementById('usuario').value.trim();
    const password = document.getElementById('pass').value.trim();
    let mensajeError = "";

    if (usuario.length > 30) {
        mensajeError += "¡¡¡El usuario debe tener menos de 30 caracteres!!!\n";
    }
    if (password.length > 30) {
        mensajeError += "¡¡¡La contraseña debe tener menos de 30 caracteres!!!\n";
    }
    if (usuario == '') {
        mensajeError += "¡¡¡Por favor, escriba su nombre de usuario!!!\n";
    }
    if (password == '') {
        mensajeError += "¡¡¡Por favor, escriba su contraseña!!!\n";
    }

    if (mensajeError != "") {
        alert(mensajeError);
        return false;
    }

    return true;
}

function validarRegistro() {
    const dni = document.getElementById('dni').value;
    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('pass').value;
    const email = document.getElementById('email').value;
    const nombre = document.getElementById('nombre').value;
    const apellido1 = document.getElementById('apellido1').value;
    const apellido2 = document.getElementById('apellido2').value;
    const direccion = document.getElementById('direccion').value;

    const dniExpresion = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/;

    const emailExpresion = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    let mensajeError = "";

    // Validar longitud del DNI
    if (dni.length != 9 || !dniExpresion.test(dni)) {
        mensajeError += "¡¡¡El DNI no es válido!!!\n";
    }

    // Validar longitud del usuario y contraseña
    if (usuario.length > 50) {
        mensajeError += "¡¡¡El usuario debe tener menos de 30 caracteres!!!\n";
    }


    // Validar formato de correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        mensajeError += "¡¡¡Por favor, escriba un correo electrónico válido!!!\n";
    }

    if (dni === '' || usuario === '' || password === '' || email === '' || nombre === '' || apellido1 === '' || apellido2 === '' || direccion === '') {
        mensajeError += "¡¡¡Por favor, complete todos los campos!!!\n";
    }

    if (mensajeError !=  "") {
        alert(mensajeError);
        return false;
    }

    return true;
}

function validarExperiencia() {

    const titulo = document.getElementById('titulo').value;
    const texto = document.getElementById('texto').value;
    const valoracion = document.getElementById('valoracion').value;
    let mensajeError = "";

    if (texto.length > 70) {
        mensajeError += "¡¡¡Haz un comentario más breve!!!\n";
    }

    if(titulo === '' || texto === '' || valoracion === ''){
        mensajeError += "¡¡¡Por favor, complete todos los campos!!!\n";
    }

    if (mensajeError !== "") {
        alert(mensajeError);
        return false;
    }

    return true;
}

function validarFormulario() {
    const titulo = document.getElementById('titulo').value;
    const siglo = document.getElementById('siglo').value;
    const autor = document.getElementById('autor').value;
    const tema = document.getElementById('tema').value;
    const imagen = document.getElementById('imagen').value;
    const descripcion = document.getElementById('descripcion').value;

    let mensajeError = "";

    if (titulo === '') {
        mensajeError += "¡Por favor, ingresa el título de la obra!\n";
    }

    if (siglo === '') {
        mensajeError += "¡Por favor, ingresa el siglo de la obra!\n";
    }

    if (autor === '') {
        mensajeError += "¡Por favor, ingresa el nombre del autor!\n";
    }

    if (tema === '') {
        mensajeError += "¡Por favor, ingresa el tema de la obra!\n";
    }

    if (imagen === '') {
        mensajeError += "¡Por favor, selecciona una imagen para la obra!\n";
    }

    if (descripcion === '') {
        mensajeError += "¡Por favor, ingresa una descripción de la obra!\n";
    }
    else if (descripcion.length < 20) {
        mensajeError += "¡La descripción debe tener al menos 20 caracteres!\n";
    }

    if (mensajeError !== "") {
        alert(mensajeError);
        return false;
    }

    return true;
}

function validarCambiarTitulo() {
    const titulo = document.getElementById('titulo').value;

    if (titulo === '') {
        alert("¡Por favor, ingresa el nuevo título!");
        return false;
    }

    return true;
}

function validarCambiarSiglo() {
    const siglo = document.getElementById('siglo').value;

    if (siglo === '') {
        alert("¡Por favor, ingresa el nuevo siglo!");
        return false;
    }

    return true;
}

function validarCambiarAutor() {
    const autor = document.getElementById('autor').value;

    if (autor === '') {
        alert("¡Por favor, ingresa el nuevo autor!");
        return false;
    }

    return true;
}

function validarCambiarTema() {
    const tema = document.getElementById('tema').value;

    if (tema === '') {
        alert("¡Por favor, ingresa el nuevo tema!");
        return false;
    }

    return true;
}

function validarCambiarImagen() {
    const imagen = document.getElementById('imagen').value;

    if (imagen === '') {
        alert("¡Por favor, selecciona una nueva imagen!");
        return false;
    }

    return true;
}

function validarCambiarDescripcion() {
    const descripcion = document.getElementById('descripcion').value;

    if (descripcion === '') {
        alert("¡Por favor, ingresa la nueva descripción!");
        return false;
    }

    if (descripcion.length <= 20) {
        alert("¡La descripción debe tener más de 20 caracteres!");
        return false;
    }

    return true;
}