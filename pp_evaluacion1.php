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
                
    
                $("#course").result(function(event, data, formatted) {
                    $("#course_val").val(data[1]);
                });
                
            });
        </script>
        <script language='JavaScript'>
            function recargar(){
                document.form1.action="pp_evaluacion1.php";
                document.form1.submit();
            }
            function validar(cont_){
                error="";
                if(document.form1.nombre_est.value==''){error+="Seleccionar al Estudiante\n";}
                if(document.form1.id_practica.value==''){error+="Seleccionar la Práctica\n";}
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
        </script>
        <title>Prácticas Pedag&oacute;gicas</title>
    </head>
<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_evaluacion.php");
$id_estudiante='';
$nombre_est='';
$rowpractica='';
$nombre_prog='';
$semestre='';
$nombre_acompa='';
$fecha_inscripcion='';
if(isset($_POST['id_estudiante'])){$id_estudiante=$_POST['id_estudiante'];}
if(isset($_POST['nombre_est'])){$nombre_est=$_POST['nombre_est'];}
if(isset($_POST['id_practica'])){$id_practica=$_POST['id_practica'];}
$link=conectarbd();
?>

<form method="post" name='form1' action="pp_evaluacion11.php">
    <!--<div class="caja2">-->   
    <?php
    require("pp_datos_evaluacion.php");
    ?>
    <table width="50%">
            <th colspan='2'>Item</th>
            <th>Aspecto</th>
            <th>Calificacion</th>
            <?php
            $consulta_aspectos="SELECT id_aspecto,codigo,descripcion,tipo FROM aspecto WHERE estado='A' ORDER BY codigo";
            $consulta_aspectos=$link->query($consulta_aspectos);
            if($consulta_aspectos->num_rows<>0){
                $cont=0;
                while($rowasp=$consulta_aspectos->fetch_array()){
                    echo "<tr>";
                    echo "<td>$cont</td>";
                    echo "<td>";
                    $var='id_aspecto'.$cont;
                    //echo $var;
                    echo "<input type='hidden' name='$var' value='$rowasp[id_aspecto]'/>$rowasp[codigo]";
                    echo "</td>";
                    echo "<td>";
                    if($rowasp['tipo']=='T'){echo "<b>".$rowasp['descripcion']."</b>";}
                    else{echo $rowasp['descripcion'];}
                    echo "</td>";
                    $var='calificacion'.$cont;
                    //echo $var;
                    echo "<td><input type='number' name='$var' size='3' maxlength='3' min='1' max='5' step='0.5' required/></td>";
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
    <!--</div>-->

    <script type="text/javascript" language='JavaScript'>
        document.form1.nombre_est.value='<?php echo $nombre_est;?>';
        document.form1.id_estudiante.value='<?php echo $id_estudiante;?>'
        document.form1.id_practica.value='<?php echo $id_practica;?>'
    </script>
</form>
</body>
</html>