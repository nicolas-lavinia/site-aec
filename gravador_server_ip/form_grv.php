<?php
    $id = @$_GET["id"];
    $new = @$_GET["new"];
    
    if( $new == 0 )
    {
        require('db_connect.php');
        $query = "SELECT grv_enable, server_ip, server_port, local_port, diretorio, nome1, nome2, nome3, nome4, nome5, nome6, nome7, nome8 FROM gravadores WHERE id = ?";
        if( $stmt = $mysqli->prepare( $query ) )
        {
            $stmt->bind_param( 'i', $id );
            $stmt->execute();                           // Executa a query preparada.
            $stmt->store_result();
            $stmt->bind_result( $grv_enable, $server_ip, $server_port, $local_port, $diretorio, $nome1, $nome2, $nome3, $nome4, $nome5, $nome6, $nome7, $nome8 );           // obtŽm vari‡veis do resultado.
            $stmt->fetch();
        }
        $query = "SELECT id_status FROM processo WHERE id_grv = ?";
        if( $stmt = $mysqli->prepare( $query ) )
        {
            $stmt->bind_param( 'i', $id );
            $stmt->execute();                           // Executa a query preparada.
            $stmt->store_result();
            $stmt->bind_result( $id_status );           // obtŽm vari‡veis do resultado.
            $stmt->fetch();
        }
    }
    else
    {
        $nome_grv = "ServerIP";
        $grv_enable = "0";
        $server_ip = "";
        $server_port = "";
        $local_port = "";
        $diretorio = "gravacoes";
        $nome1 = "Porta_".((($id-1)*8)+1);
        $nome2 = "Porta_".((($id-1)*8)+2);
        $nome3 = "Porta_".((($id-1)*8)+3);
        $nome4 = "Porta_".((($id-1)*8)+4);
        $nome5 = "Porta_".((($id-1)*8)+5);
        $nome6 = "Porta_".((($id-1)*8)+6);
        $nome7 = "Porta_".((($id-1)*8)+7);
        $nome8 = "Porta_".((($id-1)*8)+8);
        $id_status = 1;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Cliente Stand-Alone Gravador Multicanal</title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
        <!-- <script src="scripts.js" type="text/javascript"></script> -->
    </head>
    <body>
        <div id="shadow-one">
            <div id="shadow-two">
                <div id="shadow-three">
                    <div id="shadow-four">
                        <div id="page">
                            <div style="padding:0 0 5px 5px" align="center"><img src="logo.gif" alt="www.nexttech.com.br"/></div>
                            <div id="footer"></div>
                            <div id="content" align="center">
                                
                                <form method="post" action="<?php if($new==0){echo 'process.php?tipo=edit&link=grv';}else{echo 'process.php?tipo=insert&link=grv';}?>" name="edt_grv">
    
                                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                    
                                    <fieldset>
                                    
                                    <div>
                                    <label>Gravador:</label>
                                    <input type="radio" name="grv_enable" value="1" <?php if( $grv_enable){echo checked;} ?> />Habilitado
                                    <input type="radio" name="grv_enable" value="0" <?php if(!$grv_enable){echo checked;} ?> />Desabilitado                                
                                    </div>
                                    
                                    <div>
                                    <label>IP Servidor:</label>
                                    <input name="server_ip" type="text" value="<?php echo $server_ip;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="15"  />
                                    </div>
                                    
                                    <div>
                                    <label>Porta Servidor:</label>
                                    <input name="server_port" type="text" value="<?php echo $server_port;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="5"  />
                                    </div>
                                    
                                    <div>
                                    <label>Porta Local:</label>
                                    <input name="local_port" type="text" value="<?php echo $local_port;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="5"  />
                                    </div>
                                    
                                    <div>
                                    <label>Diret&oacuterio:</label>
                                    <input name="diretorio" type="text" value="<?php echo $diretorio;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="256"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 1:</label>
                                    <input name="nome1" type="text" value="<?php echo $nome1;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 2:</label>
                                    <input name="nome2" type="text" value="<?php echo $nome2;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 3:</label>
                                    <input name="nome3" type="text" value="<?php echo $nome3;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 4:</label>
                                    <input name="nome4" type="text" value="<?php echo $nome4;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 5:</label>
                                    <input name="nome5" type="text" value="<?php echo $nome5;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 6:</label>
                                    <input name="nome6" type="text" value="<?php echo $nome6;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 7:</label>
                                    <input name="nome7" type="text" value="<?php echo $nome7;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <div>
                                    <label>Nome Linha 8:</label>
                                    <input name="nome8" type="text" value="<?php echo $nome8;?>" <?php if($id_status!=1){echo readonly;} ?> maxlength="16"  />
                                    </div>
                                    
                                    <input type="submit" class="sm" value="Atualizar" />
                                    
                                    </fieldset>
                                </form>
                            </div>
                            <div class="spacer">&nbsp;</div>
                            <div id="footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>