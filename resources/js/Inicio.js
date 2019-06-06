$(init);


function init(){
    // Inicializa el NavBar
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

    
    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

    // Clic del boton circular para validar correo y contraseña
    $("#un_lock").on("click",function(){
        $('#frm-acceso').submit();
    });

    // Clic del boton circular Agregar Registro Nuevo formulario modal
    $("#add_record").on("click",function(){
        $("#corr").val('');
        $("#nom").val('');
        $("#pwd").val('');
        $("#modalRegistro").modal('open');
        $("#corr").focus();
    });
    
    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-registro').submit();
    });
       
}

function validateForm(){
    $('#frm-acceso').validate({
        rules: {
            correo:{required:true, email:true, minlength:4, maxlength:120},
            contra:{required:true, minlength:4, maxlength:32},
        },
        messages: {
            correo:{required:"No puedes dejar este campo vacío",email:"Se requiere correo valido",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 120 caracteres"},
            contra:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 32 caracteres"},
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            validaData();
        }
    });
    $('#frm-registro').validate({
        rules: {
            corr:{required:true, email:true, minlength:4, maxlength:120},
            nom:{required:true, minlength:4, maxlength:100},
            pwd:{required:true, minlength:4, maxlength:32},
        },
        messages: {
            corr:{required:"No puedes dejar este campo vacío",email:"Se requiere correo valido",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 120 caracteres"},
            nom:{required:"No se puede dejar el campo vacio",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
            pwd:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 32 caracteres"},
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
// Envia los datos del formulario de registro a la base de datos
function saveData(){
    var sURL = "actRegistroGuarda.php";
    var parametros = 'corr=' + $("#corr").val() + 
                     '&nom=' + $("#nom").val() + 
                     '&pwd=' + $("#pwd").val();
    $.ajax({
        type:"post",
        url:sURL,
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                $("#correo").val($("#corr").val());
                M.toast({html: 'Registro exitoso', classes: 'rounded', displayLength: 4000});
                $("#modalRegistro").modal('close');
                $("#contra").focus();
            }
            else{
                M.toast({html: 'Error al Registrar Usuario', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function validaData(){
    var sURL = "actValidaUsr.php";
    var parametros = 'correo=' + $("#correo").val() + 
                     '&contra=' + $("#contra").val();
    $.ajax({
        type:"post",
        url:sURL,
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                $(location).attr('href',respuesta['data']);
                M.toast({html: 'Registro exitoso', classes: 'rounded', displayLength: 4000});
                $("#modalRegistro").modal('close');
            }
            else{
                M.toast({html: 'Error al Registrar Usuario', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

