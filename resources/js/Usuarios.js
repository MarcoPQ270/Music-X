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
    cargausuario();      

    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

    // Clic del boton circular Imprimir
    $("#print-record").on("click",function(){
        document.location.href = "http://localhost/pruebas/TCPDF/Reportes/ReporteUsuarios.php"
    });
    // Clic del boton circular Agregar
    $("#add-record").on("click",function(){
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });
    
    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-usuario').submit();
    });
    // clic de Borrar
    $(document).on("click", '.delete', function(){
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // clic de Editar
    $(document).on("click", '.edit', function(){
        var id = $(this).attr("id-record");
        $("#corr").val(cursos[id]["correo"]).next().addClass('active');
        $("#nom").val(cursos[id]["nomusuario"]).next().addClass('active');
        $("#tipus").val(cursos[id]["tipousr"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#corr").focus();
    });
    
}

function validateForm(){
    $('#frm-usuario').validate({
        rules: {
            corr:{required:true,email:true, minlength:3, maxlength:60},
            nom:{required:true,  minlength:3, maxlength:126},
            tipus:{required:true,number:true},         
        },
        messages: {
            corr:{required:"No puedes dejar este campo vacío",email:"El formato del correo es incorrecto", minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            nom:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 126 caracteres"},
            tipus:{required:"Debes ingresar un costo válido",number:"Este campo debe ser numérico"},             
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

function cargausuario(){
    var parametros = "";
    $.ajax({
        type:"post",
        url:"llenaArrayusuario.php",
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
    var sURL = "";
    if (id == "0")
    {
        sURL="actusuarioAgregar.php"
    }else{
        sURL = "actusuarioActualizar.php"
    }
    parametros = new FormData($("#frm-usuario")[0]);
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
                $("#corr").val('');
                $("#nom").val('');
                $("#tipus").val('');
                $("#modalRegistro").modal('close');
                M.toast({html: 'Usuario Guardado', classes: 'rounded', displayLength: 4000});
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
                M.toast({html: 'Error al Agregar Usuario', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function deleteData(id){
    var boton = "&boton=Borrar";
    var parametros='pk='+ id + boton;
    $.ajax({
        type:"post",
        url:"actusuarioEliminar.php",
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                M.toast({html: 'Usuario Eliminado', classes: 'rounded', displayLength: 4000});
                actualizaDataTable(respuesta['data'],'delete')
            }
            else{
                M.toast({html: 'Error al Eliminar Usuario', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function actualizaDataTable(data, action) {
    console.log(data);
    if (action === 'insert'){
        var row = table.row.add([
            data.corr,
            data.nom,
            data.tipus,
            '<i class="material-icons edit" id-record="' + data.pk + '">create</i>' +
            '<i class="material-icons delete" id-record="' + data.pk +  '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id',data.pk);
        //Agrega el registro al arreglo cursos
        cursos[data.pk]={
            "idusuario":      data.pk,
            "corr":     data.corr,
            "nomusuario": data.nom,
            "tipousr":        data.tipus,
        }
    } 
    else if (action === 'delete'){
        table.row('#'+ data.pk).remove().draw();   
    }
}

