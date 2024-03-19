    <fieldset><legend>Información de la Práctica</legend>
        <div class="fila">
        <span class="etiqueta"><label for="nombre_est">Estudiante:</label></span>
       
            <input type='text' id='course' class='texto' name='nombre_est' size='60' required='' /><a href='#' onclick='recargar()'><span class="icon-magnifying-glass"></span></a>
            <input type='hidden' id='course_val' name='id_estudiante'/>

        </div>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Práctica:</label></span>
        <span class="form-el"><select name='id_practica' onchange='recargar()' value='<?php echo $id_practica;?>'>
        <option value=''></option>
        <?php
            $consultapra="SELECT id_practica,CONCAT(nombre_ins,' Programa: ',nombre_prog,' Practica: ',tipo_practica) AS practica FROM vw_practica WHERE estado='A' AND id_estudiante='$id_estudiante' ORDER BY id_practica";
            echo "<br>".$consultapra;
            $consultapra=$link->query($consultapra);
            if($consultapra->num_rows<>0){
                while($rowpra=$consultapra->fetch_array()){
                    echo "<option value='$rowpra[id_practica]'>$rowpra[practica]</option>";
                }
            }
        ?>
        </select></span>
        </div>
        <?php
        if(!empty($id_practica)){
            $consultapractica="SELECT nombre_prog,semestre,nombre_acompa,fecha_inscripcion FROM vw_practica WHERE id_practica='$id_practica'";
            //echo "<br>".$consultapractica;
            $consultapractica=$link->query($consultapractica);
            if($consultapractica->num_rows<>0){
                $rowpractica=$consultapractica->fetch_array();
                $nombre_prog=$rowpractica['nombre_prog'];
                $semestre=$rowpractica['semestre'];
                $nombre_acompa=$rowpractica['nombre_acompa'];
                $fecha_inscripcion=$rowpractica['fecha_inscripcion'];
            }
        }
        ?>

        <div class="fila">
        <span class="etiqueta"><label>Programa:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $nombre_prog;?></label></span>
        <span class="etiqueta"><label>Fecha de Inscripción:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $fecha_inscripcion;?></label></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Semestre:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $semestre;?></label></span>
        <span class="etiqueta"><label>Nombra del Acompañante:</label></span>
        <span class="form-el"><label class="labelmostrar"><?php echo $nombre_acompa;?></label></span>
        </div>
        </fieldset>
            
        <fieldset><legend>Evaluación</legend>
        <div class="fila">
        <span class="etiqueta"><label>Fecha:</label></span>
        <span class="form-el"><input type='date' id='fecha_eval' name='fecha_eval' required=''/></span>
        </div>
        