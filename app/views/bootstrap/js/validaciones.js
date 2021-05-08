function valida(){

    var form = document.form_add;

    var cantidad = form.cantidad.value;
    
    if( isNaN(cantidad)){
        alert("se deben ingresar datos numericos")
        return false;
    }

    if(form.marca.value==0||form.referencia.value==0||form.descripcion.value==0||form.codigo_barras.value==0||form.cantidad.value==0||form.precio.value==0){
        alert("Se deben llenar todos los datos");
        return false;
    }else{
        return true;
    }
}

function soloNumeros(e) {
  var key = e.keyCode || e.which,
    tecla = String.fromCharCode(key).toLowerCase(),
    numeros = "1234567890",
    especiales = [8, 37, 39, 46],
    tecla_especial = false;

  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (numeros.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}