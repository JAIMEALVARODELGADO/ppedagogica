<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        <title>Práctica Pedag&oacute;gica Integral Investigativa</title>
    </head>

   <script language="JavaScript">
        function validar(){
            var error='';
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
        function recargar(opc_){
            document.form1.opcion.value=opc_;
            document.form1.action='pp_estudiante1.php';
            document.form1.submit();
        }
        
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_practica.php");
$link=conectarbd();
$consulta="SELECT practica.id_practica,practica.fecha_inscripcion,practica.tipo_practica,practica.id_estudiante,practica.id_facultad,practica.id_departamento,practica.id_programa,practica.semestre,practica.nombre_acompa,practica.vinculacion,practica.email_acompa,practica.telefono_acompa,practica.id_institucion,practica.sede,practica.nombre_titular,practica.email_titular,practica.telefono_titular,practica.estado,practica.fecha_reg,practica.usuario_reg, CONCAT(estudiante.numero_ident,' ',estudiante.nombres,' ',estudiante.apellidos) AS nombre_est,
institucion.nombre AS nombre_ins
FROM practica 
INNER JOIN estudiante ON estudiante.id_estudiante=practica.id_estudiante
INNER JOIN institucion ON institucion.id_institucion=practica.id_institucion
WHERE id_practica='$_GET[id_practica]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows > 0){
    $row=$consulta->fetch_array();
    $nombre_est=$row['nombre_est'];
    $fecha_inscripcion=$row['fecha_inscripcion'];
    $tipo_practica=$row['tipo_practica'];
    $id_estudiante=$row['id_estudiante'];
    $id_facultad=$row['id_facultad'];
    $id_departamento=$row['id_departamento'];
    $id_programa=$row['id_programa'];
    $semestre=$row['semestre'];
    $nombre_acompa=$row['nombre_acompa'];
    $vinculacion=$row['vinculacion'];
    $email_acompa=$row['email_acompa'];
    $telefono_acompa=$row['telefono_acompa'];
    $id_institucion=$row['id_institucion'];
    $sede=$row['sede'];
    $nombre_titular=$row['nombre_titular'];
    $email_titular=$row['email_titular'];
    $telefono_titular=$row['telefono_titular'];
    $estado=$row['estado'];
    $nombre_ins=$row['nombre_ins'];
}
?>
<form name='form1' method="post" action="pp_practica211.php">
    <?php
    require("pp_datos_practica.php");
    echo "<input type='hidden' name='id_practica' value='$_GET[id_practica]'/>";
    ?>
    <button type="button" onclick='validar()'><span class="icon-save"></span> Guardar</button>
    
    <script language="JavaScript">
        document.form1.nombre_est.value='<?php echo $nombre_est;?>';
        document.form1.tipo_practica.value='<?php echo $tipo_practica;?>';
        document.form1.id_facultad.value='<?php echo $id_facultad;?>';
        document.form1.id_departamento.value='<?php echo $id_departamento;?>';
        document.form1.id_programa.value='<?php echo $id_programa;?>';
        document.form1.semestre.value='<?php echo $semestre;?>';
        document.form1.nombre_acompa.value='<?php echo $nombre_acompa;?>';
        document.form1.vinculacion.value='<?php echo $vinculacion;?>';
        document.form1.email_acompa.value='<?php echo $email_acompa;?>';
        document.form1.telefono_acompa.value='<?php echo $telefono_acompa;?>';
        document.form1.nombre_ins.value='<?php echo $nombre_ins;?>';
        document.form1.id_institucion.value='<?php echo $id_institucion;?>';
        document.form1.sede.value='<?php echo $sede;?>';
        document.form1.nombre_titular.value='<?php echo $nombre_titular;?>';
        document.form1.email_titular.value='<?php echo $email_titular;?>';
        document.form1.telefono_titular.value='<?php echo $telefono_titular;?>';
        document.form1.nombre_est.disabled=true;

    </script>
</form>
</body>
</html>
