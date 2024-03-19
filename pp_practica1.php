<?php
session_start();
//$_SESSION['datos'];
//$datos[0]='nombre';
//$datos[1]='codigo';
?>
<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="UTF-8"/>
        <meta description="Registro y cotrol de las prácticas pedagógicas de la Universidad de Nariño"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
        <script type="text/javascript">
            $().ready(function() {	
                $("#course").autocomplete("autocomp_estu.php", {
                    width: 460,
                    matchContains: false,
                    mustMatch: false,
                    selectFirst: false
                });
                $("#course2").autocomplete("autocomp_inst.php", {
                    width: 460,
                    matchContains: false,
                    mustMatch: false,
                    selectFirst: false
                });
	
                $("#course").result(function(event, data, formatted) {
                    $("#course_val").val(data[1]);
                });
                $("#course2").result(function(event, data, formatted) {
                    $("#course_val2").val(data[1]);
                });
            });
        </script>
        <title>Prácticas Pedag&oacute;gicas</title>
    </head>
    <script language="JavaScript">
        function validar(){
            var error='';
            if(document.form1.id_estudiante.value==''){error+="Estudiante\n";}
            if(document.form1.tipo_practica.value==''){error+="Práctica\n";}
            if(document.form1.id_facultad.value==''){error+="Facultad\n";}
            if(document.form1.id_departamento.value==''){error+="Departamento\n";}
            if(document.form1.id_programa.value==''){error+="Programa\n";}
            if(document.form1.semestre.value==''){error+="Semestre\n";}
            if(document.form1.nombre_acompa.value==''){error+="Nombre del acompañante\n";}
            if(document.form1.vinculacion.value==''){error+="Tipo de vinculacion\n";}
            if(document.form1.email_acompa.value==''){error+="Email del acompañante\n";}
            if(document.form1.telefono_acompa.value==''){error+="Teléfono del acompañante\n";}
            if(document.form1.id_institucion.value==''){error+="Institución\n";}
            if(document.form1.nombre_titular.value==''){error+="Nombre del titular\n";}
            if(document.form1.email_titular.value==''){error+="Email del titular\n";}
            if(document.form1.telefono_titular.value==''){error+="Teléfono del titular\n";}
            if(error!=''){
                alert("Es necesario complementar la siguiente información:\n"+error);
            }
            else{
                document.form1.submit();
            }
        }
    </script>
<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_practica.php");
$link=conectarbd();
?>
<form name='form1' method="post" action="pp_practica11.php">
    <?php
        require("pp_datos_practica.php");
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
    <!--<script language='JavaScript'>
        document.form1.numero_ident.value="<?php echo $_POST['numero_ident'];?>";
        document.form1.id_estudiante.value="<?php echo $_POST['id_estudiante'];?>";
        document.form1.codigo.value="<?php echo $codigo;?>";
        document.form1.telefono.value="<?php echo $telefono;?>";
        document.form1.email.value="<?php echo $email;?>";
    </script>-->
</form>
</body>
</html>