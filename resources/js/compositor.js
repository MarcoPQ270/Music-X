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
    cargacomp();      

    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

    // Clic del boton circular Agregar
    $("#add-record").on("click",function(){
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });
      // Clic del boton circular Imprimir
      $("#print-record").on("click",function(){
        document.location.href = "http://localhost/pruebas/TCPDF/Reportes/ReporteCompositor.php"
    });
    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-compos').submit();
    });

    // clic de Borrar
    $(document).on("click", '.delete', function(){
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // clic de Editar
    $(document).on("click", '.edit', function(){
        var id = $(this).attr("id-record");
        console.log(cursos[id]);
        $("#comp").val(cursos[id]["nomc"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#comp").focus();
      
    });
    
}

function validateForm(){
    $('#frm-compos').validate({
        rules: {
            comp:{required:true, minlength:3, maxlength:60},      
        },
        messages: {
            comp:{required:"No puedes dejar este campo vacío"},
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

function cargacomp(){
    var parametros = "";
    $.ajax({
        type:"post",
        url:"llenaArraycompos.php",
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
        sURL="actcomposAgregar.php"
    }else{
        sURL = "actcomposActualizar.php"
    }
    parametros = new FormData($("#frm-compos")[0]);
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
                $("#comp").val('');
                $("#modalRegistro").modal('close');
                M.toast({html: 'Compositor Guardado', classes: 'rounded', displayLength: 4000});
                if (id == "0"){ // Insert
                    actualizaDataTable(respuesta['data'],'insert')
                }
                else // Update0
                {
                    actualizaDataTable(respuesta['data'],'delete')
                    actualizaDataTable(respuesta['data'],'insert')
                }
            }
            else{
                M.toast({html: 'Error al Agregar Compositor', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function deleteData(id){
    var boton = "&boton=Borrar";
    var parametros='pk='+ id + boton;
    $.ajax({
        type:"post",
        url:"actcomposEliminar.php",
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                M.toast({html: 'Compositor Eliminado', classes: 'rounded', displayLength: 4000});
                actualizaDataTable(respuesta['data'],'delete')
            }
            else{
                M.toast({html: 'Error al Eliminar Compositor', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function actualizaDataTable(data, action) {
    console.log(data);
    if (action === 'insert'){
        var row = table.row.add([
            data.comp,
            '<i class="material-icons edit" id-record="' + data.pk + '">create</i>' +
            '<i class="material-icons delete" id-record="' + data.pk +  '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id',data.pk);
        //Agrega el registro al arreglo cursos
        cursos[data.pk]={
            "idcompositor":      data.pk,
            "nomc":     data.comp,
        }
    } 
    else if (action === 'delete'){
        table.row('#'+ data.pk).remove().draw();   
    }
}

