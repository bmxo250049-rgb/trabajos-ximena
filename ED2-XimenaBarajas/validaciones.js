// Expresiones regulares
// Correo: letras, números, punto y guion bajo, luego @upemor.edu.mx
var regexCorreo = /^[A-Za-z0-9._]+@upemor\.edu\.mx$/;
// Contraseña: letras, números, # y @, de 7 a 14 caracteres
var regexPassword = /^[A-Za-z0-9#@]{7,14}$/;
 
function correoValido() {
    var correo = document.getElementById("correo").value;
    // El largo total debe ser de 16 a 36 caracteres
    if (correo.length < 16 || correo.length > 36) {
        return false;
    }
    return regexCorreo.test(correo);
}
 
function passwordValida() {
    var password = document.getElementById("password").value;
    return regexPassword.test(password);
}
 
// Muestra u oculta un alert de Bootstrap
function mostrar(id, visible) {
    var alerta = document.getElementById(id);
    if (visible) {
        alerta.classList.remove("d-none");
    } else {
        alerta.classList.add("d-none");
    }
}
 
// Revisa los campos. Si forzar es true, también avisa cuando están vacíos.
function revisar(forzar) {
    var correo = document.getElementById("correo");
    var password = document.getElementById("password");
    var correoOk = correoValido();
    var passwordOk = passwordValida();
 
    // Alert del correo (desaparece cuando cumple)
    mostrar("alertaCorreo", !correoOk && (forzar || correo.value !== ""));
    // Alert de la contraseña (desaparece cuando cumple)
    mostrar("alertaPassword", !passwordOk && (forzar || password.value !== ""));
    // Alert verde solo si ambos están bien
    mostrar("alertaOk", correoOk && passwordOk);
}
 
// Se llama con onclick en el botón Enviar
function validar() {
    revisar(true);
    if (correoValido() && passwordValida()) {
        // Datos correctos: viaja a usuario.php por submit
        document.getElementById("formulario").submit();
    }
    // Si hay errores, no se envía nada al back-end
}
 