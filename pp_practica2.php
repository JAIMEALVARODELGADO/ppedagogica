<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
        <meta description="Registro y cotrol de las pr�cticas pedag�gicas de la Universidad de Nari�o"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Pr�ctica Pedag&oacute;gica Integral Investigativa</title>
    </head>
    <script language="JavaScript">
        function validar(){
            var error='';
            if(document.form1.nombre_ins.value=='' && document.form1.numero_ident.value==''&& document.form1.apellidos.value=='' && document.form1.nombres.value==''){
                alert("Para la busqueda, al menos se debe digitar el valor de un campon"+error);
            }
            else{
                document.form1.submit();
            }
        }
        function eliminar(id_,numiden_){
            if(confirm("Desea eliminar la pr�ctica del estudiante con la identifici�n\n"+numiden_)){
                window.open("pp_practica22.php?id_practica="+id_,"_self");
            }
        }
        function editar(id_){
            window.open("pp_practica21.php?id_practica="+id_,"_self");
        }
        function horario(id_){
            window.open("pp_horariopractica2.php?id_practica="+id_,"_self");
        }
        function imprimir(id_){
            window.open("pp_practica23.php?id_practica="+id_,"_new","width=600,height=800,toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0");
        }
    </script>

<body>

<?php
require("pp_funciones.php");
require("pp_menu.php");
require("pp_menu_practica.php");
$id_practica='';
$nombre_ins='';
$numero_ident='';
$apellidos='';
$nombres='';
$orden='';
if(isset($_GET['id_practica'])){$id_practica=$_GET['id_practica'];}
if(isset($_POST['nombre_ins'])){$nombre_ins=$_POST['nombre_ins'];}
if(isset($_POST['numero_ident'])){$numero_ident=$_POST['numero_ident'];}
if(isset($_POST['apellidos'])){$apellidos=$_POST['apellidos'];}
if(isset($_POST['nombres'])){$nombres=$_POST['nombres'];}
if(isset($_POST['orden'])){$orden=$_POST['orden'];}
?>
<form name='form1' method="post" action="pp_practica2.php">
    <span class="form-el"><input type='text' id='numero_ident' name='numero_ident' maxlength='20' size='20' placeholder='Identificaci�n del estud' value="<?php echo $numero_ident;?>"/></span>
    <span class="form-el"><input type='text' id='apellidos' name='apellidos' maxlength='20' size='30' placeholder='Apellidos' value="<?php echo $apellidos;?>"/></span>
    <span class="form-el"><input type='text' id='nombres' name='nombres' maxlength='20' size='30' placeholder='Nombres' value="<?php echo $nombres;?>"/></span>
    <span class="form-el"><input type='text' id=' nombre_ins' name='nombre_ins' maxlength='20' size='30' placeholder='Institucion' value="<?php echo $nombre_ins;?>"/></span>
    <span class="form-el">Orden
        <select id='orden' name='orden' value="<?php echo $orden;?>">
            <option value='numero_ident'>Identificaci�n</option>
            <option value='apellidos'>Apellidos</option>
            <option value='nombres'>Nombres</option>
            <option value='nombre_ins'>Instituci�n</option>
        </select>
    </span>
    <a href="#" onclick='validar();' title='Buscar'><span class="icon-magnifying-glass"></span> </a>
<?php
$condicion='';
if(!empty($id_practica)){$condicion=$condicion."id_practica='$id_practica' AND ";}
if(!empty($nombre_ins)){$condicion=$condicion."nombre_ins LIKE '%$nombre_ins%' AND ";}
if(!empty($numero_ident)){$condicion=$condicion."numero_ident='$numero_ident' AND ";}
if(!empty($apellidos)){$condicion=$condicion."apellidos LIKE '%$apellidos%' AND ";}
if(!empty($nombres)){$condicion=$condicion."nombres LIKE '%$nombres%' AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,-5);
    //echo "<br>".$condicion;
    if(empty($orden)){$orden='numero_ident';}
    $consulta="SELECT id_practica,fecha_inscripcion,tipo_practica,semestre,nombre_acompa,numero_ident,apellidos,nombres,nombre_ins,estado
     FROM vw_practica WHERE ".$condicion." ORDER BY ".$orden;
    //echo "<br>".$consulta;
    $consulta=$link->query($consulta);
    if($consulta->num_rows<>0){
        echo "<br><br><table width='100%'>";
        echo "<th colspan='4'>Opciones</th>".
            "<th>Identificaci�n.</th>".
            "<th>Apellidos</th>".
            "<th>Nombres</th>".
            "<th>Fecha Ins.</th>".
            "<th>Tip.</th>".
            "<th>Sem.</th>".
            "<th>Instituci�n</th>".
            "<th>Estado</th>";
        while($row=$consulta->fetch_array()){
            echo "<tr>";
            echo "<td width='5%'><a href='#' onclick=horario($row[id_practica]) title='Horario' class='btnhref'><span class='icon-calendar'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=editar($row[id_practica]) title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
            if($row['estado']=='A'){
                echo "<td width='5%'><a href='#' onclick=eliminar($row[id_practica],$row[numero_ident]) title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            }
            else{
                echo "<td width='5%'><a href='#' title='Practica cerrada para eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            }
            echo "<td width='5%'><a href='#' onclick=imprimir($row[id_practica]) title='Imprimir' class='btnhref'><span class='icon-print'></span></a></td>";
            echo "<td>$row[numero_ident]</td>";
            echo "<td>$row[apellidos]</td>";
            echo "<td>$row[nombres]</td>";
            echo "<td>$row[fecha_inscripcion]</td>";
            echo "<td>$row[tipo_practica]</td>";
            echo "<td>$row[semestre]</td>";
            echo "<td>$row[nombre_ins]</td>";
            echo "<td>$row[estado]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>
</form>
</body>
</html>
