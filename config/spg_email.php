
	<style type="text/css">
    div.painel_e {
 			padding: 5px;
 			background: #EEEEEE;
 			width: 338px;
 		} 

    .style1 {
        	font-family: Arial, Helvetica, sans-serif;
        	width: 62px;
        	border: none !important;
            width: 100%;
            text-align: right;
        }

    .style2 {
        	font-size:12px;
        	height: 22px;
            width: 50px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
    </style>

				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">

        <p>
					<br />
        </p>

    </div>

    <!-- ***************** Lado Direiro ***************** -->
    <div class="right">
   
   					<div class="painel_e">
   					
            <h2>
                Servidor de e-mail
                <br />
            </h2>

					<?php
					$query = "SELECT email, servidor, porta, nome, usuario, senha FROM email WHERE id = 1";
					$stmt = $mysqli->prepare( $query );
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result( $email, $servidor, $porta, $nome, $usuario, $senha );
					$stmt->fetch();
					?>
                                    <form method='post' action='process.php?tipo=edit&link=email'>
                                    	
                                    	<table class="style1">
                                    	
                                        <tr>
                                            <td class="style2">
												E-mail:
                                            </td>
                                            <td class="style2">
                                                <input type='text' name='email' value='<?php echo $email;?>' size=35 maxlength=128 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Servidor:
                                            </td>
                                            <td class="style2">
                                                <input type='text' name='servidor' value='<?php echo $servidor;?>' size=35 maxlength=128 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Porta:
                                            </td>
                                            <td class="style2">
                            <input type='text' name='porta' value='<?php echo $porta;?>' size=4 maxlength=5 />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="style2">
												Nome:
                                            </td>
                                            <td class="style2">
                                                <input type='text' name='nome' value='<?php echo $nome;?>' size=35 maxlength=64 />
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Usu&aacuterio:
                                            </td>
                                            <td class="style2">
                                                <input type='text' name='usuario' value='<?php echo $usuario;?>' size=35 maxlength=128 />
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Senha:
                                            </td>
                                            <td class="style2">
                                                <input type='password' name='senha' value='<?php echo $senha;?>' size=10 maxlength=32 />
                                            </td>
                                        </tr>
                                        
										<tr>
			                                <td class="style2">
                            <br />
                        </td>
                    </tr>



                    <tr>
                        <td class="style2">
			                                	&nbsp;
			                                </td>
			                                <td class="style2">
                            <input type='submit' value='Gravar' />
			                                </td>
			                            </tr>
										
										</table>
									</form>
				</div>
				</div>
