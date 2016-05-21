<!-- Modal -->
        <div style="width:auto;" class="modal fade" id="contato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4>Contato - <?php echo $Loja_Nome;?></h4>
                    </div>
                    <div class="modal-body">                        
                        <div class="contatos">
                            <h4><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Telefone</h4>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Loja_Telefone;?><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Loja_Telefone1;?><br/>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Loja_Telefone2;?>
                            <h4><span class="glyphicon glyphicon-envelope"></span>&nbsp;Email</h4>
                            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Loja_Email;?>                              
                        </div>
                        <div class="formulario">
                            <label for="txtNome">Nome:</label>
                            <input type="text" name="txtNome" id="txtNome" class="form-control">
                            <label for="txtEmail">Email:</label>
                            <input type="text" name="txtEmail" id="txtEmail" class="form-control">
                            <label for="txtFone">Fone:</label>
                            <input type="text" name="txtFone" id="txtFone" class="form-control">                            
                            <label for="txtMensagem">Mensagem:</label>
                            <textarea name="txtMensagem" id="txtMensagem" class="form-control"></textarea>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btnEnviarFormularioContato">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim Modal-->


                <!-- Modal -->
        <div style="width:auto;" class="modal fade" id="localizacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4>Localização - <?php echo $Loja_Nome; ?></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo $Loja_Localizacao;?>             
                    </div>              
                </div>
            </div>
        </div>
        <!--Fim Modal-->        


        