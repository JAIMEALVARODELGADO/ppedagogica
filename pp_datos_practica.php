
        <fieldset><legend>Información del Estudiante</legend>
        <div class="fila">
        <span class="etiqueta"><label for="numero_ident">Estudiante:</label></span>
        <span class="form-el">
            <input type='text' id='course' class='texto' name='nombre_est' size='60' required='' />
            <input type='hidden' id='course_val' name='id_estudiante'/>
        </span>            
        </div>
        </fieldset>
        
        <fieldset><legend>Información de la Práctica</legend>
        <div class="fila">
        <span class="etiqueta"><label>Práctica:</label></span>
        <span class="form-el"><select name='tipo_practica' >
        <option value=''></option>
        <option value='I'>I</option>
        <option value='II'>II</option>
        <option value='III'>III</option>
        <option value='IV'>IV</option> 
        <option value='V'>V</option> 
        <option value='VI'>VI</option> 
        <option value='VII'>VII</option> 
        <option value='VIII'>VIII</option> 
        <option value='IX'>IX</option> 
        <option value='X'>X</option> 
        </select></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Facultad:</label></span>
        <span class="form-el"><select name='id_facultad'>
        <option value=''></option>
        <?php
            $consultafac="SELECT id_facultad,nombre FROM facultad ORDER BY nombre";
            //echo "<br>".$consultaest;
            $consultafac=$link->query($consultafac);
            if($consultafac->num_rows<>0){
                while($rowfac=$consultafac->fetch_array()){
                    echo "<option value='$rowfac[id_facultad]'>$rowfac[nombre]</option>";
                }
            }
        ?>
        </select></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Departamento:</label></span>
        <span class="form-el"><select name='id_departamento' >
        <option value=''></option>
        <?php
            $consultadep="SELECT id_departamento,nombre FROM departamento ORDER BY nombre";
            //echo "<br>".$consultaest;
            $consultadep=$link->query($consultadep);
            if($consultadep->num_rows<>0){
                while($rowdep=$consultadep->fetch_array()){
                    echo "<option value='$rowdep[id_departamento]'>$rowdep[nombre]</option>";
                }
            }
        ?>   
        </select></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Programa:</label></span>
        <span class="form-el"><select name='id_programa' >
        <option value=''></option>
        <?php
            $consultapro="SELECT id_programa,descripcion FROM programa ORDER BY descripcion";
            //echo "<br>".$consultapro;
            $consultapro=$link->query($consultapro);
            if($consultapro->num_rows<>0){
                while($rowpro=$consultapro->fetch_array()){
                    echo "<option value='$rowpro[id_programa]'>$rowpro[descripcion]</option>";
                }
            }
        ?>
        </select></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Semestre:</label></span>
        <span class="form-el"><select name='semestre' >
        <option value=''></option>
        <option value='08'>08</option>
        <option value='09'>09</option>
        <option value='10'>10</option>
        </select></span>
        </div>
        </fieldset>
        <fieldset><legend>Información del Acompañante</legend>
        <div class="fila">
        <span class="etiqueta"><label for="nombre_acompa">Nombra del Acompañante:</label></span>
        <span class="form-el"><input type='text' id='nombre_acompa' name='nombre_acompa' maxlength='45' size='45' required=''/></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label>Tipo de Vinculación:</label></span>
        <span class="form-el"><select name='vinculacion'>
        <option value=''></option>
        <option value='Hora Catedra'>Hora Catedra</option>
        <option value='Tiempo Completo'>Tiempo Completo</option>
        </select></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="email_acompa">E-mail del Acompañante:</label></span>
        <span class="form-el"><input type='email' id='email_acompa' name='email_acompa' maxlength='90' size='90' required=''/></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="telefono_acompa">Teléfono del Acompañante:</label></span>
        <span class="form-el"><input type='text' id='telefono_acompa' name='telefono_acompa' maxlength='25' size='25' required=''/></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="institucion">Institucion:</label></span>
        <span class="form-el">
            <input type='text' id='course2' class='texto' name='nombre_ins' size='80' required='' />
            <input type='hidden' id='course_val2' name='id_institucion'/>
        </span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="sece">Sede:</label></span>
        <span class="form-el"><input type='text' id='sede' name='sede' maxlength='80' size='80' required=''/></span>
        </div>
        </fieldset>
        <fieldset><legend>Información del Titular</legend>
        <div class="fila">
        <span class="etiqueta"><label for="nombre_titular">Nombre del Titular:</label></span>
        <span class="form-el"><input type='text' id='nombre_titular' name='nombre_titular' maxlength='45' size='45' required=''/></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="nombre_titular">E-mail del Titular:</label></span>
        <span class="form-el"><input type='email' id='email_titular' name='email_titular' maxlength='90' size='90' required=''/></span>
        </div>
        <div class="fila">
        <span class="etiqueta"><label for="nombre_titular">Teléfono del Titular:</label></span>
        <span class="form-el"><input type='text' id='telefono_titular' name='telefono_titular' maxlength='25' size='25' required=''/></span>
        </div>
        </fieldset>