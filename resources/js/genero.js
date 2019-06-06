$(init);
var table = null;
var cursos = null;

function init(){
    // Inicializa el NavBar
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

    // Configuración del DataTable
    table = $('#cur').DataTable({"aLengthMenu": 
           [[10,25,50,75,100],[10,25,50,75,100]],
           "iDisplaylength":15});

    //Llena el arrelo de cursos con la Información BD
    cargagenero();      

    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

     // Clic del boton circular Imprimir
     $("#print-record").on("click",function(){
        document.location.href = "http://localhost/pruebas/TCPDF/Reportes/ReporteGeneros.php"
    });
    // Clic del boton circular Agregar
    $("#add-record").on("click",function(){
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });
    
    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-genero').submit();
    });

    // clic de Borrar
    $(document).on("click", '.delete', function(){
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // clic de Editar
    $(document).on("click", '.edit', function(){
        //Muestra el arreglo que se esta llenando en cursos
        //console.log(cursos);
        var id = $(this).attr("id-record");
        $("#genero").val(cursos[id]["genero"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#genero").focus();
      
    });
    
}

function validateForm(){
    $('#frm-genero').validate({
        rules: {
            genero:{required:true, minlength:3, maxlength:60},      
        },
        messages: {
            genero:{required:"No puedes dejar este campo vacío"},
      },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            saveData();
        }
    });
}

function cargagenero(){
    var parametros = "";
    $.ajax({
        type:"post",
        url:"llenaArraygenero.php",
        dataType:'json',
        data:parametros,
        success:function(respuesta){
            if (respuesta['status']){
                cursos=respuesta['data'];
            } else{
                cursos=null;
            }
        }
    });
}

function saveData(){
    var id = $("#pk").val(); 
    var boton = "";
    var sURL = "";
    if (id == "0")
    {
        sURL="actgeneroAgregar.php"
    }else{
        sURL = "actgeneroActualizar.php"
    }
    parametros = new FormData($("#frm-genero")[0]);
    $.ajax({
        type:"post",
        url:sURL,
        contentType: false,
        processData:false,
        dataType:'json',
        data: parametros,
        success: function(respuesta){
         
            if (respuesta['status']){
                $("#pk").val('0');
                $("#genero").val('');
                $("#modalRegistro").modal('close');
                M.toast({html: 'Genero Guardado', classes: 'rounded', displayLength: 4000});
                if (id == "0"){ // Insert
                    actualizaDataTable(respuesta['data'],'insert')
                }
                else // Update
                {
                    
                    actualizaDataTable(respuesta['data'],'delete')
                    actualizaDataTable(respuesta['data'],'insert')
                }
            }
            else{
                M.toast({html: 'Error al Agregar Genero', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function deleteData(id){
    var boton = "&boton=Borrar";
    var parametros='pk='+ id + boton;
    $.ajax({
        type:"post",
        url:"actgeneroEliminar.php",
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                M.toast({html: 'Genero Eliminado', classes: 'rounded', displayLength: 4000});
                actualizaDataTable(respuesta['data'],'delete')
            }
            else{
                M.toast({html: 'Error al Eliminar Genero', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function actualizaDataTable(data, action) {
    //muestra el arreglo que llega en el Json
    //console.log(data);
    if (action === 'insert'){
        var row = table.row.add([
            data.genero,
            '<i class="material-icons edit" id-record="' + data.pk + '">create</i>' +
            '<i class="material-icons delete" id-record="' + data.pk +  '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id',data.pk);
        //Agrega el registro al arreglo cursos
        cursos[data.pk]={
            "idgenero":      data.pk,
            "genero":     data.genero,
        }
    } 
    else if (action === 'delete'){
        table.row('#'+ data.pk).remove().draw();   
    }
}

