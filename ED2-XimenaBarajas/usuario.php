<?php
// Back-end: aquí se valida contra la base de datos.
// Se vuelven a revisar los datos por seguridad (el front-end se puede saltar).
 
$correo   = isset($_POST["correo"]) ? $_POST["correo"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
 
$correoOk   = preg_match('/^[A-Za-z0-9._]+@upemor\.edu\.mx$/', $correo) && strlen($correo) >= 16 && strlen($correo) <= 36;
$passwordOk = preg_match('/^[A-Za-z0-9#@]{7,14}$/', $password);
 
if (!$correoOk || !$passwordOk) {
    echo "Datos no válidos. <a href='index.html'>Regresar</a>";
    exit;
}
 
// TODO: conectar a la base de datos y comparar usuario y contraseña.
// Si coinciden: dar acceso. Si no: mostrar mensaje de error.
echo "Datos recibidos correctamente. Aquí se consultaría la base de datos.";
?>
 