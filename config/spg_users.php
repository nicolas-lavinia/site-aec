	<script>
	function checa_new_user( ) {
		if( document.getElementById('iu').value == '' )
		{
			alert( "Nome de usário inválido! O nome deve conter pelo menos 1 dígito." );
			return false;
		}
		else if( document.getElementById('il').value == '' )
		{
			alert( "Login inválido! Utilize entre 1 e 8 dígitos." );
			return false;
		}
		else if( document.getElementById('is').value == '' )
		{
			alert( "Senha inválida! Utilize entre 1 e 8 dígitos." );
			return false;
		}
		else if( ( document.getElementById('ise').value == '' ) || ( document.getElementById('ise').value < 0 ) || ( document.getElementById('ise').value > 999 ) )
		{
			alert( "Tempo de expirar senha inválida! O valor deve estar entre 0 e 999 dias" );
			return false;
		}
		return true;
	}
	function checa_edit_user( ) {
		if( document.getElementById('eu').value == '' )
		{
			alert( "Nome de usuário inválido!" );
			return false;
		}
		else if( document.getElementById('el').value == '' )
		{
			alert( "Login inválido! Utilize entre 1 e 8 dígitos." );
			return false;
		}
		else if( document.getElementById('es').value == '' )
		{
			alert( "Senha inválida! Utilize entre 1 e 8 dígitos." );
			return false;
		}
		else if( ( document.getElementById('ese').value == '' ) || ( document.getElementById('ese').value < 0 ) || ( document.getElementById('ese').value > 999 ) )
		{
			alert( "Tempo de expirar senha inválida! O valor deve estar entre 0 e 999 dias" );
			return false;
		}
		return true;
	}
	</script>
	<style type="text/css">
		table {
			font-family: Arial, Helvetica, sans-serif;
		    border-collapse: collapse; /* CSS2 */
		    background: white;
		    width: 602px;
		}
		 
		table tr {
		    background: #EEEEEE;
		    color: black;
		}
		
            table tr:hover {
			background: #008A8C;
			font-weight:bold;
			}
			
		table th {
		    border: 1px solid #999999;
		    color: white;
		    background: #27619C;
		    font-size:13px;
		    font-weight:bold;
		}
		
		table td {
		    border: 1px solid #999999;
		    background: #EEEEEE;
		    color: black;
		    font-size:12px;
		    text-align: left;
		}
		
    div.painel_e {
			padding: 5px;
			background: #EEEEEE;
			width: 338px;
		}
	</style>
	
	<style type="text/css">
    .style1 {
        	width: 62px;
        	border: none !important;
            width: 100%;
            text-align: right;
        }

    .style2 {
        	height: 22px;
            width: 120px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
    </style>

			<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">
					<h3>
        Dados Cadastrais
        <br />
                    </h3>
					<br />
   
   					<div class="painel_e">
   					
					<?php
						//require('db_connect.php');
						
						$nid = null;
						$eid = null;
						$id = null;
						
						$nid = @$_GET["nid"];
						$eid = @$_GET["eid"];
						$id = @$_GET["id"];
						
						if( $nid != null )
						{
							?>
                                    <form method='post' action='process.php?tipo=insert&link=user'>
                                    	
                                    	<table class="style1">
                                        <tr>
                                            <td class="style2">
												Usu&aacuterio:
                                            </td>
                                            <td class="style2">
                                                <input id="iu" type='text' name='nome' maxlength=50 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Login:
                                            </td>
                                            <td class="style2">
                                                <input id="il" type='text' name='login' maxlength=8 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Senha:
                                            </td>
                                            <td class="style2">
                                                <input id="is" type='password' name='senha' maxlength=8 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Perfil de Acesso:
                                            </td>
                                            <td class="style2">
                                               	<select name='perfil' >
                                    			<?php 
                                    			//require('db_connect.php');
                                    			$query = "SELECT CodPerfil, NomePerfil FROM perfil ORDER BY NomePerfil ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodPerfil, $NomePerfil );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
														echo "<option value=".$CodPerfil.">".$NomePerfil."</option>";                                    			
                                    				}
                                    			}
                                    			?>
                                    			</select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Grupo de Ramal:
                                            </td>
                                            <td class="style2">
	                                       		<select name='grupo' >
	                                    			<?php 
	                                    			//require('db_connect.php');
	                                    			$query = "SELECT CodGrupo, NomeGrupo FROM grupos ORDER BY NomeGrupo ASC";
	                                    			if( $stmt = $mysqli->prepare( $query ) )
	                                    			{
	                                    				$stmt->execute();                           // Executa a query preparada.
	                                    				$stmt->store_result();
	                                    				$stmt->bind_result( $CodGrupo, $NomeGrupo );           // obt�m vari�veis do resultado.
	                                    				while( $stmt->fetch() )
	                                    				{
															echo "<option value=".$CodGrupo.">".$NomeGrupo."</option>";                                    			
	                                    				}
	                                    			}
	                                    			?>
	                                    		</select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Senha expira a cada (dias):
                                            </td>
                                            <td class="style2">
                        						<input id="ise" type='text' name='expira' size=4 maxlength=3 />
                                            </td>
                                        </tr>
                                        
										<tr>
                    					<td class="style2"></td>
			                                <td class="style2">
                        						<input type='submit' value='Gravar' onClick="return checa_new_user()" />
			                                </td>
			                            </tr>
										
										</table>
									</form>
							<?php
						}
						else
						{
							if( $eid != null )
							{
								//require('db_connect.php');
								$query = "SELECT NomeUsu FROM cadusu WHERE CodUsu = ?";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $eid );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $NomeUsu );           // obt�m vari�veis do resultado.
									if( $stmt->fetch() )
									{
										if( $eid == 1 )
										{
											?>
        									<h5>
	                            				<strong>Acesso Negado</strong>	                                    
        									</h5>
	                            			<?php
	                            		}
	                            		else
	                            		{
	                            			?>
			                                    <form method='post' action='process.php?tipo=delete&link=user'>
            										<input type='hidden' value='<?php echo $eid;?>' name='id' />
													<table class="style1">
			                            				<tr>
															<td class="style2">
																<strong>Aten&ccedil&atildeo:</strong>
						                            	    </td>
                    									<td class="style2"></td>
														</tr>
			                            				<tr>
															<td class="style2" colspan=2>
																Confirma a exclusão do Usu&aacuterio: <?php echo $NomeUsu;?>
						                            	    </td>
														</tr>
			                            				<tr>
                    										<td class="style2"></td>
															<td class="style2">
                        										<input type='submit' value='Prosseguir' />
						                                	</td>
														</tr>
													</table>
													
												</form>
		                            		<?php                    			
	                            		}
	                            	}
	                            	else
	                            	{
	                            		?>
        								<h2>
	                            			<strong>Usuário n&atildeo encontrado!</strong>
       									</h2>
	                            		<?php
	                            	}
	                            }
							}
							else
							{
								$query = "SELECT NomeUsu, Login, Senha, CodPerfil, CodGrupo, QtdDias FROM cadusu WHERE CodUsu = ?";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $id );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $nome, $login, $senha, $CodPerfilUsu, $CodGrupoUsu, $expira );           // obt�m vari�veis do resultado.
									if( $stmt->fetch() == 0 )
									{
										$id = 1;
										$stmt->bind_param( 'i', $id );
										$stmt->execute();                           // Executa a query preparada.
										$stmt->store_result();
										$stmt->bind_result( $nome, $login, $senha, $CodPerfilUsu, $CodGrupoUsu, $expira );           // obt�m vari�veis do resultado.
										$stmt->fetch();
									}
								}
								
								?>
                                 	<form method='post' action='process.php?tipo=edit&link=user'>
                                    	
            							<input type='hidden' value='<?php echo $id;?>' name='id' maxlength=50 />
                                    
                                        <table class="style1">
                                    	
                                        <tr>
                                            <td class="style2">
												Usu&aacuterio:
                                            </td>
                                            <td class="style2">
                                                <input id="eu" type='text' name='nome' maxlength=50 <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $nome;?>'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Login:
                                            </td>
                                            <td class="style2">
                                                <input id="el" type='text' name='login' maxlength=8 <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $login;?>'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Senha:
                                            </td>
                                            <td class="style2">
                                                <input id="es" type='password' name='senha' maxlength=8 <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $senha;?>'/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Perfil de Acesso:
                                            </td>
                                            <td class="style2">
                                    			<select name='perfil' <?php if( $id == 1 ){echo "disabled ";} ?> >
                                    			<?php 
                                    			//require('db_connect.php');
                                    			$query = "SELECT CodPerfil, NomePerfil FROM perfil ORDER BY NomePerfil ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodPerfil, $NomePerfil );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
                                    					if( $CodPerfilUsu == $CodPerfil )
                                    						echo "<option value=".$CodPerfil." selected>".$NomePerfil."</option>";                                    			
                                    					else
                                    						echo "<option value=".$CodPerfil.">".$NomePerfil."</option>";                                    			
                                    				}
                                    			}
                                    			?>
                                    			</select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Grupo de Ramal:
                                            </td>
                                            <td class="style2">
                                       			<select name='grupo' <?php if( $id == 1 ){echo "disabled ";} ?> >
                                    			<?php 
                                    			//require('db_connect.php');
                                    			$query = "SELECT CodGrupo, NomeGrupo FROM grupos ORDER BY NomeGrupo ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodGrupo, $NomeGrupo );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
                                    					if( $CodGrupoUsu == $CodGrupo )
                                    						echo "<option value=".$CodGrupo." selected >".$NomeGrupo."</option>";
                                    					else
															echo "<option value=".$CodGrupo.">".$NomeGrupo."</option>";                                    			
                                    				}
                                    			}
                                    			?>
                                    			</select>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="style2">
												Senha expira a cada (dias):
                                            </td>
                                            <td class="style2">
                        						<input id="ese" type='text' name='expira' <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $expira;?>' size=5 maxlength=3 />
                                            </td>
                                        </tr>
                                        
										<tr>
                    						<td class="style2"></td>
			                                <td class="style2">
			                                    <?php if( $id != 1 ){echo "<input type='submit' value='Gravar' onClick='return checa_edit_user()' >";} ?>
			                                </td>
			                            </tr>
										
										</table>
							</form>
								<?php 
								
							}
						}
					?>
				</div>
				</div>
				
				
				<!-- ***************** Lado Direito ***************** -->
				<div class="right">
						
					<h3>
                        Rela&ccedil&atildeo de Usu&aacuterios
                    </h3>
					<br />
						
						<input type="hidden" name="id" value="<?php echo $id;?>"/>
					
					                <table>
                                    	<tr>
                                    		<th style="width:1%;">C&oacutedigo</th>
	                                    	<th style="width:90%;">Descri&ccedil&atildeo</th>
	                                    	<th></th>
	                                    	<th></th>
                                    	</tr>
                                    	<tbody>
                                    			<?php
                                    			//require('db_connect.php');
                                    			$query = "SELECT CodUsu, NomeUsu FROM cadusu ORDER BY CodUsu ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodUsu, $NomeUsu );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
                                    					echo "<tr>";
                                    					echo "<td style='text-align: center;'>".$CodUsu."</td>";
                                    					echo "<td>".$NomeUsu."</td>";
                                    					if( $CodUsu != 1 )
                                    					{
                                    						echo "<td><a href='?p=users&id=".$CodUsu."'><img src='../images/icone_editar.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    						echo "<td><a href='?p=users&eid=".$CodUsu."'><img src='../images/icone_excluir.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					else
                                    					{
									                        //echo "<td></td>";
									                        //echo "<td></td>";
                        									echo "<td><a href='?p=users&id=".$CodUsu."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                        									echo "<td><a href='?p=users&eid=".$CodUsu."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					echo "</tr>";
                                    				}
                                    			}

                                    			?>
                                    	</tbody>
                 
                                    </table>
                                    
                                    <h2>
                                    <a href='?p=users&nid=1'>Incluir</a>
                                    </h2>
                                    <br/>			
				</div>
