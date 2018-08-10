	<script>

	function checa_ing( ) {
		if( document.getElementById('ing').value == '' )
		{
			alert( "Nome de grupo inválido! O nome deve conter pelo menos 1 dígito." );
			return false;
		}
	}
	function checa_eng( ) {
		if( document.getElementById('eng').value == '' )
		{
			alert( "Nome de grupo inválido! O nome deve conter pelo menos 1 dígito." );
			return false;
		}
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
        	font-family: Arial, Helvetica, sans-serif;
        	width: 62px;
        	border: none !important;
            width: 100%;
            text-align: right;
        }

    .style2 {
        	font-size:12px;
        	height: 22px;
            width: 80px;
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
                                    <form method='post' action='process.php?tipo=insert&link=grupo'>
                                    
                                    	<table class="style1">
                            				<tr>
												<td class="style2">
													Grupo:
			                            	    </td>
												<td class="style2">
			                                    	<input id="ing" type='text' name='nome' maxlength=50" />
			                                	</td>
											</tr>
                            				<tr>
                    <td class="style2"></td>
												<td class="style2">
                        <input type='submit' value='Gravar' onClick="return checa_ing()"/>
			                            	    </td>
                </tr>
                <tr>
                    <td class="style2"></td>
												<td class="style2">
                        <br />
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
								$query = "SELECT CodUsu FROM cadusu WHERE CodGrupo = ".$eid;
								$stmt = $mysqli->prepare( $query );
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result( $CodUsu );
								if( $stmt->fetch() )
									$grupo_em_uso = 1;
								else
									$grupo_em_uso = 0;
									
								$query = "SELECT NomeGrupo FROM grupos WHERE CodGrupo = ?";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $eid );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $NomeGrupo );           // obt�m vari�veis do resultado.
									if( $stmt->fetch() )
									{
										if( $eid == 1 )
										{
											echo "<h5><strong>Acesso Negado!</strong><h/5>";
	                            		}
	                            		else if( $grupo_em_uso == 1 )
	                            		{
	                            			echo "<h5><strong>Grupo de Ramais em uso, n&atildeo pode ser exclu&iacutedo!</strong><h/5>";
	                            		}
	                            		else
	                            		{
	                            			?>
			                                    <form method='post' action='process.php?tipo=delete&link=grupo'>
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
																Confirma a exclusão do Grupo: <?php echo $NomeGrupo;?>
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
	                            			<strong>Grupo n&atildeo encontrado!</strong>
	                            		<?php
	                            	}
	                            }
							}
							else
							{
								$query = "SELECT NomeGrupo FROM grupos WHERE CodGrupo = ?";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $id );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $nome );           // obt�m vari�veis do resultado.
									if( $stmt->fetch() == 0 )
									{
										$id = 1;
										$stmt->bind_param( 'i', $id );
										$stmt->execute();                           // Executa a query preparada.
										$stmt->store_result();
										$stmt->bind_result( $nome );           // obt�m vari�veis do resultado.
										$stmt->fetch();
									}
								}
								
								?>
                                 	<form method='post' action='process.php?tipo=edit&link=grupo'>
                                    	
            <input type='hidden' value='<?php echo $id;?>' name='id' maxlength=50 />
                                    	
                                    	<table class="style1">
                            				<tr>
												<td class="style2">
													Grupo:
			                            	    </td>
												<td class="style2">
			                                    	<input id="eng" type='text' name='nome' maxlength=50 <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $nome;?>'/>
			                                	</td>
											</tr>
                            				<tr>
                    <td class="style2"></td>
                    <td class="style2"><?php if( $id != 1 ){echo "<input type='submit' value='Gravar' onClick='return checa_eng();'>";} ?>
			                            	    </td>
                </tr>
                <tr>
                    <td class="style2"></td>
												<td class="style2">
                        <br />
			                                	</td>
											</tr>
										</table>
									</form>
									
                                    <table class="style1">
                            			<tr>
											<td class="style2">
												Ramais de Acesso do Grupo:
			                           	    </td>
										</tr>
									</table>

								<?php 
								$query = "SELECT gruporamal.CodPorta, NomePorta FROM gruporamal INNER JOIN portas ON gruporamal.CodPorta = portas.CodPorta WHERE CodGrupo = ? ORDER BY NomePorta ASC";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $id );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $CodPorta, $NomePorta );           // obt�m vari�veis do resultado.
									$achou = 0;
									while( $stmt->fetch() )
									{
										if( $achou == 0 )
										{
											echo "<table style='width: 290px;'>";
											echo "<tr>";
											echo "<th style='text-align: center; width: 260px;'>Ramal</th>";
											echo "<th> </th>";
											echo "</tr>";
											echo "<tbody>";
										}
										$achou = 1;
										echo "<tr>";
										echo "<td>";
										echo $NomePorta;
										echo "</td>";
										echo "<td><a href='process.php?tipo=delete&link=portagrupo&CodPorta=".$CodPorta."&CodGrupo=".$id."'><img src='../images/icone_excluir.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
										echo "</tr>";
									}
									if( $achou == 1 )
									{
										echo "</tbody>";
										echo "</table>";
									}
									else
									{
									?>
	                                    <table class="style1">
	                            			<tr>
												<td class="style2">
                    Acesso a todos os ramais
				                           	    </td>
											</tr>
										</table>
									<?php
									}
									
									
									if( $id != 1 )
									{
										echo "<form method='post' action='process.php?tipo=insert&link=portagrupo' >";
										echo "<table class='style1'><tr>";
										echo "<td class='style2'>";
										echo "Incluir:";
										echo "</td>";
										echo "<td class='style2'>";
										echo "<input type='hidden' name='id' value=".$id." />";
										echo "<select name='porta'>";
										if( $achou != 0 )
                            			echo "<option value=0>Acesso a todos os ramais</option>";
										$query = "SELECT CodPorta, NomePorta FROM portas ORDER BY NomePorta ASC";
										if( $stmt = $mysqli->prepare( $query ) )
										{
											$stmt->execute();                           // Executa a query preparada.
											$stmt->store_result();
											$stmt->bind_result( $CodPorta, $NomePorta );           // obt�m vari�veis do resultado.
											while( $stmt->fetch() )
											{
												
												
												$query1 = "SELECT CodGrupo FROM gruporamal WHERE CodGrupo = ? AND CodPorta = ?";
												if( $stmt1 = $mysqli->prepare( $query1 ) )
												{
													$stmt1->bind_param( 'ii', $id, $CodPorta );
													$stmt1->execute();
													$stmt1->store_result();
													if( $stmt1->fetch() == 0 )
													{
														echo "<option value=".$CodPorta.">".$NomePorta."</option>";
													}
												}
												
												
											}
										}
										echo "</select>";
										echo "</td>";
										echo "<td class='style2'>";
										echo "<br/><input type='submit' value='Incluir'></p>";
										echo "</td></tr></table>";
										echo "</form>";
									}
								}
							}
						}
					?>
				</div>
				</div>
				<!-- ***************** Lado Direito ***************** -->
				<div class="right">
					<h3>
                        Rela&ccedil&atildeo de Grupos de Ramais
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
                                    			$query = "SELECT CodGrupo, NomeGrupo FROM grupos ORDER BY CodGrupo ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodGrupo, $NomeGrupo );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
                                    					echo "<tr>";
                                    					echo "<td style='text-align: center;'>".$CodGrupo."</td>";
                                    					echo "<td>".$NomeGrupo."</td>";
                                    					if( $CodGrupo != 1 )
                                    					{
                                    						echo "<td><a href='?p=grupos&id=".$CodGrupo."'><img src='../images/icone_editar.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    						echo "<td><a href='?p=grupos&eid=".$CodGrupo."'><img src='../images/icone_excluir.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					else
                                    					{
                        //echo "<td></td>";
                        //echo "<td></td>";
                        echo "<td><a href='?p=grupos&id=".$CodGrupo."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                        echo "<td><a href='?p=grupos&eid=".$CodGrupo."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					echo "</tr>";
                                    				}
                                    			}

                                    			?>
                                    	</tbody>
                 
                                    </table>
                                    
                                    <h2>
                                    <a href='?p=grupos&nid=1'>Incluir</a>
                                    </h2>
                                    <br/>						

				</div>
