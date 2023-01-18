<body>
<?php echo form_open('Usuario/update/'.$usuario->usuid);?>
            <table class="table table-hover" >
                <caption>&nbsp;</caption>
                <thead></thead>
                <tbody>
                   <tr>
                       <td class="col-xs-2">Usuario</td>
                       <td class="col-xs-2"><input type="input" readonly class="form-control" id="usuuser" name="usuuser"  value='<?php echo $usuario->usuuser;?>'></td>
                   </tr>

                   <tr>
                       <td class="col-xs-2">Contraseña</td>
                       <td class="col-xs-2"><input type="password" class="form-control" id="usupass" name="usupass"  value='<?php echo $pass;?>'></td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Nombre</td>
                       <td class="col-xs-2"><input type="input" class="form-control" id="usunom" name="usunom" value='<?php echo $usuario->usunom;?>'></td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Apellido</td>
                       <td class="col-xs-2"><input type="input" class="form-control" id="usuape" name="usuape" value='<?php echo $usuario->usuape;?>'></td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Correo Electronico</td>
                       <td class="col-xs-2"><input type="input" class="form-control" id="usumai" name="usumai" value='<?php echo $usuario->usumai;?>'></td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Lista Correo Electronico</td>
                       <td class="col-xs-2">
                           <textarea name="usulstmai" id="usulstmai" rows="5" cols="75"><?php echo $usuario->usulstmai;?></textarea>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Grupo</td>
                       <td class="col-xs-2">
                           <select class="form-control" id="gruid" name="gruid">
                               <?php foreach($grupos as $grupo){ ?>
                                   <?php if ($grupo->gruid == $usuario->gruid){ ?>
                                       <option selected value= <?php echo $grupo->gruid;?>><?php echo $grupo->grudsc; ?></option>
                                   <?php }else{ ?>
                                       <option value=  <?php echo $grupo->gruid;?>><?php echo $grupo->grudsc; ?></option>
                                   <?php }?>
                               <?php }?>
                           </select>
                       </td>
                   </tr>

                   <tr>
                       <td class="col-xs-2">Estado</td>
                       <td>
                           <select class="form-control" id="usuest" name="usuest">
                               <?php if ($usuario->usuest == 1){ ?>
                                   <option selected value='<?php echo 1 ?>'><?php echo 'Habilitado' ?></option>
                                   <option value='<?php echo 0 ?>'><?php echo 'Deshabilitado' ?></option>
                               <?php }else{ ?>
                                   <option  value='<?php echo 1 ?>'><?php echo 'Habilitado' ?></option>
                                   <option selected value='<?php echo 0;?>'><?php echo 'Deshabilitado'; ?></option>
                               <?php }?>
                           </select>
                       </td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Recibe Correo</td>
                       <td>
                           <select class="form-control" id="usumarmai" name="usumarmai">
                               <?php if ($usuario->usumarmai == 1){ ?>
                               <option selected value='<?php echo 1 ?>'><?php echo 'Habilitado' ?></option>
                               <option  value='<?php echo 0 ?>'><?php echo 'Deshabilitado'; ?></option>
                               <?php }else{ ?>
                                   <option  value='<?php echo 1 ?>'><?php echo 'Habilitado' ?></option>
                                   <option selected value='<?php echo 0 ?>'><?php echo 'Deshabilitado'; ?></option>
                               <?php }?>
                           </select>
                       </td>
                   </tr>
                       </td>
                   </tr>

                <tr>
                    <td>
                        <input type="submit" class="btn btn-primary" value="Guardar" />
                        <?=form_close();?>
                    </td>
                    <td><a href=<?php echo base_url().'index.php?/usuario/index';?>>
                        <submit type="submit" class="btn btn-danger"> Cancelar</submit></a></td>
                </tr>
                </tbody>
            </table>
</body>