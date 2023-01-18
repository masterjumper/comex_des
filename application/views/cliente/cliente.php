<body>
<?php echo form_open(base_url().'cliente/update/'.$usuario->usuid);?>
            <table class="table table-hover" > 
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
                       <td class="col-xs-2">Empresa</td>
                       <td class="col-xs-2">
                           <select class="form-control" id="empid" name="empid">
                               <?php foreach ($empresas as $empresa){?>
                               <?php if ($usuario->empid === $empresa->empid){ ?>
                                   <option selected value=<?php echo $empresa->empid;?>><?php echo $empresa->emprazsoc; ?></option>
                               <?php }else{ ?>
                                    <option value=<?php echo $empresa->empid;?>><?php echo $empresa->emprazsoc; ?></option>
                               <?php }}?>
                           </select>
                       </td>
                   </tr>
                   <tr>
                       <td class="col-xs-2">Estado</td>
                       <td>
                           <select class="form-control" id="usuest" name="usuest">

                               <?php if ($usuario->usuest === '1'){ ?>
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
                    <td>                         
                        <button type="submit" class="btn btn-primary" value="Guardar">
                            <span class="glyphicon glyphicon-ok-sign" aria-hidden="true" data-toggle="Aceptar" data-placement="top" title="Aceptar"></span>    
                            Aceptar
                        </button>
                        <?=form_close()?>
                        <?php echo form_open(base_url().'cliente/index/'.$_SESSION['current_page']);?>
                        <!-- <a href=<?php //echo base_url().'cliente/index/';?>>                         -->
                            <button type="submit" class="btn btn-warning" value="Cancelar">
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true" data-toggle="Cancelar" data-placement="top" title="Cancelar"></span>    
                                Cancelar
                            </button>                             
                        <!-- </a> -->
                        <?=form_close()?>                        
                        
                    </td>                    
                </tr>
                </tbody>
            </table>
</body>