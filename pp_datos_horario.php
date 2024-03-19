    <fieldset><legend>Horario</legend>
        <table>
            <th>Día</th>
            <th>Hora</th>
            <th>Asignatura</th>
            <th>Grado</th>
            <th>Grupo</th>
            <th>Jornada</th>
            <th>Nivel</th>
            <th><span class="icon-save"></span></th>
            <tr>
                <td><select name='id_dia' >
                    <option value=''></option>
                    <?php
                    $consdia="SELECT id_dia,nombre_dia FROM dia";
                    //echo "<br>".$consdia;
                    $consdia=$link->Query($consdia);
                    while($rowdia=$consdia->fetch_array()){
                        //echo "<br>".$rowdia['nombre_dia'];
                        echo "<option value='$rowdia[id_dia]'>$rowdia[nombre_dia]</option>";
                    }
                    ?>
                    </select>
                </td>
                <td><input type="text" name="hora" size="11" maxlength="11"></td>
                <td>
                    <select name='id_asignatura' >
                    <option value=''></option>
                    <?php
                    $consasig="SELECT id_asignatura,nombre FROM asignatura";
                    //echo "<br>".$consdia;
                    $consasig=$link->Query($consasig);
                    while($rowasig=$consasig->fetch_array()){
                        //echo "<br>".$rowasig['nombre'];
                        echo "<option value='$rowasig[id_asignatura]'>$rowasig[nombre]</option>";
                    }
                    ?>
                    </select>
                </td>
                <td>
                    <select name='grado' >
                    <option value=''></option>
                    <option value='01'>01</option>
                    <option value='02'>02</option>
                    <option value='03'>03</option>
                    <option value='04'>04</option>
                    <option value='05'>05</option>
                    <option value='06'>06</option>
                    <option value='07'>07</option>
                    <option value='08'>08</option>
                    <option value='09'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    </select>
                </td>
                <td><input type="text" name="grupo" size="2" maxlength="2"></td>
                <td>
                    <select name='jornada' >
                    <option value=''></option>
                    <option value='Mañana'>Mañana</option>
                    <option value='Tarde'>Tarde</option>
                    </select>
                </td>
                <td>
                    <select name='nivel' >
                    <option value=''></option>
                    <option value='Basica primaria'>Basica Primaria</option>
                    <option value='Basica secundaria'>Basica Secundaria</option>
                    <option value='Media Vocacional'>Media Vocacional</option> 
                    </select>
                </td>
                <td width="5%"><a href="#" onclick='validar()' title="Guardar" class="btnhref"><span class="icon-save"></span></a></td>
            </tr>
        </table>
        <input type='hidden' name='id_practica' value='<?php echo $id_practica;?>'/>
        </fieldset>