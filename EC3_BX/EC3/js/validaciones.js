/* ===== Expresiones regulares (variables) ===== */
var expreNomyApe = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
var expreDir     = /^[a-zA-Z0-9À-ÿ\s]{1,40}$/;
var expreTel     = /^\d{7,14}$/;
var expreEmail   = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
var expreComent  = /^[\s\S]{20,128}$/;   // mínimo 20 y máximo 128 caracteres

/* ===== Utilidades ===== */
function mostrarAlerta(idContenedor, mensaje) {
  document.getElementById(idContenedor).innerHTML =
    '<div class="alert alert-danger mt-2 mb-0 py-2" role="alert">' +
    '<strong>Error:</strong> ' + mensaje + '</div>';
}

function limpiarAlerta(idContenedor) {
  document.getElementById(idContenedor).innerHTML = '';
}

function marcarInvalido(elemento) {
  elemento.classList.add('invalido');
}

function limpiarInvalido(elemento) {
  elemento.classList.remove('invalido');
}

/* Valida un campo de texto con su expresión regular.
   Si falla: alerta Bootstrap, borde rojo y foco. */
function validarTexto(id, expresion, mensaje) {
  var campo = document.getElementById(id);
  var valor = campo.value.trim();
  campo.value = valor;

  if (!expresion.test(valor)) {
    mostrarAlerta('msg-' + id, mensaje);
    marcarInvalido(campo);
    campo.focus();
    return false;
  }
  limpiarAlerta('msg-' + id);
  limpiarInvalido(campo);
  return true;
}

/* ===== Validación principal (se llama con onclick) ===== */
function validarFormulario() {
  limpiarAlerta('msg-exito');

  // Se recorren los campos en orden; se detiene en el primer error
  if (!validarTexto('nombre', expreNomyApe,
      'El nombre debe llenarse solo con letras y espacios (máximo 40 caracteres).')) return false;

  if (!validarTexto('apellido', expreNomyApe,
      'El apellido debe llenarse solo con letras y espacios (máximo 40 caracteres).')) return false;

  if (!validarTexto('direccion', expreDir,
      'La dirección debe llenarse con letras, números y espacios (máximo 40 caracteres).')) return false;

  if (!validarTexto('telefono', expreTel,
      'El teléfono debe contener solo números, entre 7 y 14 dígitos.')) return false;

  if (!validarTexto('email', expreEmail,
      'Escribe un correo electrónico válido, por ejemplo: nombre@dominio.com.')) return false;

  if (!validarGenero()) return false;

  if (!validarComentarios()) return false;

  document.getElementById('msg-exito').innerHTML =
    '<div class="alert alert-success mb-3" role="alert">Los datos se validaron correctamente.</div>';
  return true;
}

/* Género: sin expresión regular, solo verifica que haya uno seleccionado */
function validarGenero() {
  var radios = document.querySelectorAll('.genero');
  var seleccionado = document.querySelector('.genero:checked');

  if (!seleccionado) {
    mostrarAlerta('msg-genero', 'Debes seleccionar una opción de género.');
    radios.forEach(function (r) { marcarInvalido(r); });
    radios[0].focus();
    return false;
  }
  limpiarAlerta('msg-genero');
  radios.forEach(function (r) { limpiarInvalido(r); });
  return true;
}

/* Comentarios: solo se validan si el usuario eligió "Sí" */
function validarComentarios() {
  var quiereComentar = document.getElementById('comentarioSi').checked;
  var campo = document.getElementById('comentarios');

  if (!quiereComentar) {
    limpiarAlerta('msg-comentarios');
    limpiarInvalido(campo);
    return true;
  }
  return validarTexto('comentarios', expreComent,
    'El comentario debe tener entre 20 y 128 caracteres.');
}

/* ===== Automatizaciones ===== */
document.addEventListener('DOMContentLoaded', function () {

  // Minúsculas a mayúsculas (nombre, apellido y dirección; los números se respetan)
  ['nombre', 'apellido', 'direccion'].forEach(function (id) {
    document.getElementById(id).addEventListener('input', function () {
      this.value = this.value.toUpperCase();
    });
  });

  // Teléfono: solo caracteres numéricos
  document.getElementById('telefono').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '');
  });

  // Mostrar u ocultar comentarios según el radio Sí / No
  var bloque = document.getElementById('bloqueComentarios');
  var campoComentario = document.getElementById('comentarios');

  document.getElementById('comentarioSi').addEventListener('change', function () {
    if (this.checked) {
      bloque.classList.remove('d-none');
      campoComentario.focus();
    }
  });

  document.getElementById('comentarioNo').addEventListener('change', function () {
    if (this.checked) {
      bloque.classList.add('d-none');
      campoComentario.value = '';
      limpiarAlerta('msg-comentarios');
      limpiarInvalido(campoComentario);
    }
  });

  // Quitar borde rojo y alerta del género al elegir una opción
  document.querySelectorAll('.genero').forEach(function (r) {
    r.addEventListener('change', validarGenero);
  });
});