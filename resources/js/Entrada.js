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
    cargaCanciones();     
    
    //Valida audio
    
$("#add").validate({
    rules: {
        song: {
            required:true,
            },
           file: { 
                required: false,
                extension: "mp3"
            }, 
        },
    });

    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

    // Clic del boton circular Agregar
    $("#add-record").on("click",function(){
        $("#modalRegistro").modal('open');
        $("#nomcancion").focus();
    });
    
    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-canciones').submit();
    });

    // clic de Borrar
    $(document).on("click", '.delete', function(){
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // clic de Editar
    $(document).on("click", '.edit', function(){
        var id = $(this).attr("id-record");
        $("#nomcancion").val(cursos[id]["nomcancion"]).next().addClass('active');
        $("#fechapub").val(cursos[id]["fechacancion"]).next().addClass('active');
        $("#genero").val(cursos[id]["idgenero"]).next().addClass('active');
        $("#artista").val(cursos[id]["idcompositor"]).next().addClass('active');
        $("#imagen").val(cursos[id]["imagen"]).next().addClass('active');
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#nomcancion").focus();
    });

       
}

function validateForm(){
    $('#frm-canciones').validate({
        rules: {
            nomcancion:{required:true,minlength:2, maxlength:60},
            fechapub:{required:true, date:true},
            genero:{required:true, number:true}, 
            artista:{required:true, number:true}        
        },
        messages: {
            nomcancion:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            fechapub:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 126 caracteres"},
            genero:{required:"Debes ingresar un costo válido",number:"Este campo debe ser numérico"}, 
            artista:{required:"No puedes dejar este campo vacion", number:"Este campo es numerico"}            
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

function cargaEntrada(){
    var parametros = "";
    $.ajax({
        type:"post",
        url:"llenaArrayEntrada.php",
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
        sURL="actCancionAgregar.php"
    }else{
        sURL = "actCancionActualizar.php"
    }
        
    //var parametros='pk='+ id + "&tit=" + $("#tit").val() +
    //               "&descrip=" + $("#descrip").val() + 
    //               "&costo=" + $("#costo").val()+ boton;
    parametros = new FormData($("#frm-canciones")[0]);
    alert(parametros);
    $.ajax({
        type:"post",
        url:sURL,
        contentType: false,
        processData:false,
        dataType:'json',
        data: parametros,
        success: function(respuesta){
            alert(respuesta['status']);
            if (respuesta['status']){
                $("#pk").val('0');
                $("#nomcancion").val('');
                $("#fechapub").val('');
                $("#genero").val('');
                $("#artista").val('');
                $("#modalRegistro").modal('close');
                M.toast({html: 'Cancion Guardada', classes: 'rounded', displayLength: 4000});
                if (id == "0"){ // Insert
                    console.log(respuesta['data']);
                    actualizaDataTable(respuesta['data'],'insert')
                }
                else // Update
                {
                    actualizaDataTable(respuesta['data'],'delete')
                    actualizaDataTable(respuesta['data'],'insert')
                }
            }
            else{
                M.toast({html: 'Error al Agregar Cancion', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function deleteData(id){
    var boton = "&boton=Borrar";
    var parametros='pk='+ id + boton;
    $.ajax({
        type:"post",
        url:"actCancionEliminar.php",
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                M.toast({html: 'Cancion Eliminada', classes: 'rounded', displayLength: 4000});
                actualizaDataTable(respuesta['data'],'delete')
            }
            else{
                M.toast({html: 'Error al Eliminar Cancion', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function actualizaDataTable(data, action) {
    console.log(data);
    if (action === 'insert'){
        var row = table.row.add([
            data.nomcancion,
            data.fechapub,
            data.idtipgenero,
            data.idtipcom,
            
            '<img src="'+data.imagen+'" width="80">',
            '<img src="'+data.mp3+'" width="80">',

            '<i class="material-icons edit" id-record="' + data.pk + '">create</i>' +
            '<i class="material-icons delete" id-record="' + data.pk +  '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id',data.pk);
        //Agrega el registro al arreglo cursos
       
        cursos[data.pk]={
            "idcancion":      data.pk,
            "nomcancion":     data.nomcancion,
            "fechacancion": data.fechapub,
            "imagen":       data.imagen,
            "mp3": data.mp3,
            "genero": data.genero,
            "nomc": data.nomc,
        }
    } 
    else if (action === 'delete'){
        table.row('#'+ data.pk).remove().draw();   
    }
}

