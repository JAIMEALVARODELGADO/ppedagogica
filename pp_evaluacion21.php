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
        <title>Práctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function validar(cont_){
            var error='';
            if(document.form1.fecha_eval.value==''){error+="Ingresar la fecha de la Práctica\n";}
            for(c=0;c<cont_;c++){
                cmd_='document.form1.calificacion'+c+'.value';
                if(eval(cmd_)==''){error+="Ingresar la calificación al item "+c+"\n";}
                if((eval(cmd_)<1) || (eval(cmd_)>5)){error+="La calificación del item "+c+" no es válida \n";}
            }
            if(error!=""){
                alert("Para continuar, debe:\n"+error);
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
require("pp_menu_evaluacion.php");
$link=conectarbd();
$consulta="SELECT id_estudiante,CONCAT(numero_ident,' ',nombres,' ',apellidos) AS nombre_est,fecha_eval,id_practica,observacion_eval FROM vw_evaluacion WHERE id_evaluacion='$_GET[id_evaluacion]'";
//echo "<br>".$consulta;
$consulta=$link->query($consulta);
if($consulta->num_rows > 0){
    $row=$consulta->fetch_array();
    $id_estudiante=$row['id_estudiante'];
    $nombre_est=$row['nombre_est'];
    $fecha_eval=$row['fecha_eval'];
    $id_practica=$row['id_practica'];
    $observacion_eval=$row['observacion_eval'];
}
?>
<form name='form1' method="post" action="pp_evaluacion211.php">
    <?php
    require("pp_datos_evaluacion.php");
    echo "<input type='hidden' name='id_evaluacion' value='$_GET[id_evaluacion]'/>";
    ?>
    <table width="50%">
            <th colspan='2'>Item</th>
            <th>Aspecto</th>
            <th>Calificacion</th>
            <?php
            $consulta_aspectos="SELECT id_evaluacion_aspecto,id_evaluacion,id_aspecto,calificacion,codigo,tipo,descripcion FROM vw_evaluacion_aspecto WHERE id_evaluacion='$_GET[id_evaluacion]' ORDER BY codigo";
            //echo "<br>".$consulta_aspectos;
            $consulta_aspectos=$link->query($consulta_aspectos);
            if($consulta_aspectos->num_rows<>0){
                $cont=0;
                while($rowasp=$consulta_aspectos->fetch_array()){
                    echo "<tr>";
                    echo "<td>$cont</td>";
                    echo "<td>";
                    $var='id_evaluacion_aspecto'.$cont;
                    //echo $var;
                    echo "<input type='hidden' name='$var' value='$rowasp[id_evaluacion_aspecto]'/>$rowasp[codigo]";
                    echo "</td>";
                    echo "<td>";
                    if($rowasp['tipo']=='T'){echo "<b>".$rowasp['descripcion']."</b>";}
                    else{echo $rowasp['descripcion'];}
                    echo "</td>";
                    $var='calificacion'.$cont;
                    //echo $var;
                    echo "<td><input type='number' name='$var' size='3' maxlength='3' min='1' max='5' step='0.5' required/ value='$rowasp[calificacion]'></td>";
                    echo "</tr>";
                    $cont++;
                }
            }
            ?>
        </table>
        <div class="fila">
        <span class="etiqueta"><label>Observación:</label></span>
        <span class="form-el"><textarea cols='80' rows='4' maxlength='250' id='observacion_eval' name='observacion_eval' required='' placeholder="Máximo 250 caracteres para este campo"></textarea></span>
        </div>
        </fieldset>
    <button type="button" onclick='validar(<?php echo $cont;?>)'><span class="icon-save"></span> Guardar</button>
    <input type='hidden' name='cont' value='<?php echo $cont;?>'>
    <script language="JavaScript">
        document.form1.nombre_est.value='<?php echo $nombre_est;?>';
        document.form1.nombre_est.disabled=true;
        document.form1.id_estudiante.value='<?php echo $id_estudiante;?>';
        document.form1.id_practica.value='<?php echo $id_practica;?>';
        document.form1.id_practica.disabled=true;
        document.form1.fecha_eval.value='<?php echo $fecha_eval;?>';
        document.form1.observacion_eval.value='<?php echo $observacion_eval;?>';
    </script>
</form>
</body>
</html>
