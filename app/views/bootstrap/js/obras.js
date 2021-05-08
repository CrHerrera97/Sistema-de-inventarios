//funcion para agregar y remover material

function agg(){
    $(document).ready(function(){
        $("#adicional").on("click",function(){
            $("#tabla tbody tr:eq(0)").clone().removeClass('fila').appendTo("#tabla");
        });
        //ahora la funcion que me permite eliminar
        $(document).on("click",".eliminar",function(){
            var parent = $(this).parents().get(0);
            $(parent).remove();
        });
        
    });
    
}
