function validacion(){
 
    if(document.getElementById("nombre").value.length == 0){
    alert("Debe ingresar su nombre");
    document.frm.nombre.focus();
    return false;
  }
  if(document.getElementById("apellidos").value.length == 0){
    alert("Debe ingresar su apellidos");
    document.frm.apellidos.focus();
    return false;
  }
  if(document.getElementById("Direccion").value.length == 0){
    alert("Debe ingresar su direccion");
    document.frm.Direccion.focus();
    return false;
  }
  if(document.getElementById("Telefono").value.length == 0){
    alert("Debe ingresar su telefono");
    document.frm.Telefono.focus();
    return false;
  }
  if(document.getElementById("Movil").value.length == 0){
    alert("Debe ingresar su movil");
    document.frm.Movil.focus();
    return false;
  }
  frm.submit();

  return false;
    
  }
  
  
