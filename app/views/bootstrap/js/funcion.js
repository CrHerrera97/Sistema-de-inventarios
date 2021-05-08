function buscar(){
    var texto = document.getElementById('txtnom').value;
    var parametros = {
      "texto":texto
    };
    
    $.ajax({
       data:parametros,
       url:"../views/paginador.php",
       //hay que cambiar de valida.php a paginador.php para poder encontrar la variable de "texto"
       type:"POST",
       success:function(response){
           $('#datos').html(response);
       }
    });
}

function buscar_obra(){
  var texto = document.getElementById('txtnom').value;
  var parametros = {
    "texto":texto
  };
  
  $.ajax({
     data:parametros,
     url:"../views/paginador_obra.php",
     //hay que cambiar de valida.php a paginador.php para poder encontrar la variable de "texto"
     type:"POST",
     success:function(response){
         $('#datos_obras').html(response);
     }
  });
}

function buscar_empleado(){
  var texto = document.getElementById('txtnom').value;
  var parametros = {
    "texto":texto
  };
  
  $.ajax({
     data:parametros,
     url:"../views/paginador_empleado.php",
     //hay que cambiar de valida.php a paginador.php para poder encontrar la variable de "texto"
     type:"POST",
     success:function(response){
         $('#empleados').html(response);
     }
  });
}


function buscar_ver_obra(){
  var texto = document.getElementById('txtnom').value;
  var parametros = {
    "texto":texto
  };
  
  $.ajax({
     data:parametros,
     url:"",
     //hay que cambiar de valida.php a paginador.php para poder encontrar la variable de "texto"
     type:"POST",
     success:function(response){
         $('#obras').html(response);
     }
  });
}


