	<script>
	function checa_ipa( ) {
		if( document.getElementById('ipa').value == '' )
		{
			alert( "Nome do perfil de acesso inválido! O nome deve conter pelo menos 1 dígito." );
			return false;
		}
	}
	function checa_epa( ) {
		if( document.getElementById('epa').value == '' )
		{
			alert( "Nome do perfil de acesso inválido! O nome deve conter pelo menos 1 dígito." );
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
		
		table tr:hover
		{
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
		
		div.painel_e
		{
			padding: 5px;
			background: #EEEEEE;
			width: 338px;
		}
	</style>
				
	<style type="text/css">
        .style1
        {
        	width: 100%;
            width: 62px;
            text-align: right;
            border: none !important;
        }
        .style2
        {
            width: 78px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
        .style4
        {
        	width: 100%;
            width: 262px;
            text-align: right;
            border: none !important;
        }
         .style3
        {
        	height: 22px;
            width: 260px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
        .style5
        {
            width: 150px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
        .style7
        {
            width: 97px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
        .style8
        {
            width: 69px;
            text-align: left;
            border: none !important;
        }
    </style>
    
				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">
					
                    <h3>
                        Dados Cadastrais<br />
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
                            	<form method="post" action="process.php?tipo=insert&link=perfil">
                                    
                                	<table class="style1">
                                  		<tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style2" colspan="3">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                <span class="style2">
												Descri&ccedil&atildeo:
                                                </span>
                                            </td>
                                            <td class="style2" colspan="3">
                                                <input id="ipa" type='text' name='nome' maxlength=50 style="width:220px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                <input type="checkbox" name="opc_1"  id="opc_1" />Config
                                            </td>
                                            <td class="style5" colspan="2">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
												<input type="checkbox" name="opc_2"  id="opc_2"  />Player
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_3"  id="opc_3"  onclick='SetOpc( 3, 2)'/>Excluir grava&ccedil&otildees
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_4"  id="opc_4"  onclick='SetOpc( 4, 2)'/>Copiar grava&ccedil&otildees
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_5"  id="opc_5"  onclick='SetOpc( 5, 2)'/>Enviar por email
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_6"  id="opc_6"  onclick='SetOpc( 6, 2)'/>Coment&aacuterios
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_7"  id="opc_7"  onclick='SetOpc( 7, 2)'/>Exportar p/ Excel
                                            </td>
                                        </tr>
                                        
                                        </table>
									
       	                			<input type='submit' value='Gravar' onClick="return checa_ipa()" >
								</form>
							<?php
						}
						else
						{
							if( $eid != null )
							{
								//echo "eid";
									
								$query = "SELECT CodUsu FROM cadusu WHERE CodPerfil = ".$eid;
								$stmt = $mysqli->prepare( $query );
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result( $CodUsu );
								if( $stmt->fetch() )
									$perfil_em_uso = 1;
								else
									$perfil_em_uso = 0;
								
								$query = "SELECT NomePerfil FROM perfil WHERE CodPerfil = ?";
								if( $stmt = $mysqli->prepare( $query ) )
								{
									$stmt->bind_param( 'i', $eid );
									$stmt->execute();                           // Executa a query preparada.
									$stmt->store_result();
									$stmt->bind_result( $NomePerfil );           // obt�m vari�veis do resultado.
									if( $stmt->fetch() )
									{
										if( $eid == 1 )
										{
											echo "<h5><strong>Acesso Negado!</strong></h5>";
										}
										else if( $perfil_em_uso == 1 )
										{
											echo "<h5><strong>Perfil em uso, n&atildeo pode ser exclu&iacutedo!</strong><h/5>";
										}
										else
										{
											?>
			                                    <form method='post' action='process.php?tipo=delete&link=perfil'>
												
													<input type='hidden' value='<?php echo $eid;?>' name='id'>
												
					                            	<table class="style4">
			                            				<tr>
															<td class="style3">
																<strong>Aten&ccedil&atildeo:</strong>
						                            	    </td>
															<td class="style3">
						                                	</td>
														</tr>
			                            				<tr>
															<td class="style3" colspan=2>
																Confirma a exclusão do Perfil: <?php echo $NomePerfil;?>
						                            	    </td>
														</tr>
			                            				<tr>
															<td class="style3">
						                            	    </td>
															<td class="style3">
						                                    	<input type='submit' value='Prosseguir'>
						                                	</td>
														</tr>
													</table>
													
												</form>
		                            		<?php                    			
			                            	}
			                            }
			                            else
			                            {
			                            	echo "<strong>Perfil não encontrado!</strong>";
			                        	}
			                  		}
								}
								else
								{
									$query = "SELECT NomePerfil, opc_01, opc_02, opc_03, opc_04, opc_05, opc_06, opc_07, opc_08, opc_09, opc_10, opc_11, opc_12, opc_13 FROM perfil WHERE CodPerfil = ?";
									if( $stmt = $mysqli->prepare( $query ) )
									{
										$stmt->bind_param( 'i', $id );
										$stmt->execute();                           // Executa a query preparada.
										$stmt->store_result();
										$stmt->bind_result( $NomePerfil, $opc_01, $opc_02, $opc_03, $opc_04, $opc_05, $opc_06, $opc_07, $opc_08, $opc_09, $opc_10, $opc_11, $opc_12, $opc_13 );           // obt�m vari�veis do resultado.
										if( $stmt->fetch() == 0 )
										{
											$id = 1;
											$stmt->bind_param( 'i', $id );
											$stmt->execute();                           // Executa a query preparada.
											$stmt->store_result();
											$stmt->bind_result( $NomePerfil, $opc_01, $opc_02, $opc_03, $opc_04, $opc_05, $opc_06, $opc_07, $opc_08, $opc_09, $opc_10, $opc_11, $opc_12, $opc_13 );           // obt�m vari�veis do resultado.
											$stmt->fetch();
									
										}
									}
									
									?>
									<form method='post' action='process.php?tipo=edit&link=perfil'>
		                                    	
				                        <input type='hidden' value='<?php echo $id;?>' name='id' maxlength=50>
				                        
				                        <table class="style1">
                                  		<tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style2" colspan="3">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                <span class="style2">
												Descri&ccedil&atildeo:
                                                </span>
                                            </td>
                                            <td class="style2" colspan="3">
                                                <input id="epa" type='text' name='nome' <?php if( $id == 1 ){echo "disabled ";} ?> value='<?php echo $NomePerfil; ?>' maxlength=50 style="width: 220px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                <input type="checkbox" name="opc_1"  id="opc_1"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_01 == 1 ){echo "checked";}?> />Config
                                            </td>
                                            <td class="style5" colspan="2">
                                                &nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
												<input type="checkbox" name="opc_2"  id="opc_2"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_02 == 1 ){echo "checked";}?> />Player
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_3"  id="opc_3"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_03 == 1 ){echo "checked";}?> onclick='SetOpc( 3, 2)'/>Excluir grava&ccedil&otildes
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_4"  id="opc_4"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_04 == 1 ){echo "checked";}?> onclick='SetOpc( 4, 2)'/>Copiar grava&ccedil&otildees
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_5"  id="opc_5"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_05 == 1 ){echo "checked";}?> onclick='SetOpc( 5, 2)'/>Enviar por email
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_6"  id="opc_6"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_06 == 1 ){echo "checked";}?> onclick='SetOpc( 6, 2)'/>Coment&aacuterios
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style8">
                                                &nbsp;
                                            </td>
                                            <td class="style7">
                                                &nbsp;
                                            </td>
                                            <td class="style5" colspan="2">
                                                <input type="checkbox" name="opc_7"  id="opc_7"  <?php if( $id == 1 ){echo "disabled ";};if( $opc_07 == 1 ){echo "checked";}?> onclick='SetOpc( 7, 2)'/>Exportar p/ Excel
                                            </td>
                                        </tr>
                                        
                                        </table>

				
										<?php if( $id != 1 ){echo "<input type='submit' value='Gravar' onClick='return checa_epa()' >";} ?>
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
                        Rela&ccedil&atildeo de Perfis de Acessos
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
                                    			$query = "SELECT CodPerfil, NomePerfil FROM perfil ORDER BY CodPerfil ASC";
                                    			if( $stmt = $mysqli->prepare( $query ) )
                                    			{
                                    				$stmt->execute();                           // Executa a query preparada.
                                    				$stmt->store_result();
                                    				$stmt->bind_result( $CodPerfil, $NomePerfil );           // obt�m vari�veis do resultado.
                                    				while( $stmt->fetch() )
                                    				{
                                    					echo "<tr>";
                                    					echo "<td style='text-align: center;'>".$CodPerfil."</td>";
                                    					echo "<td>".$NomePerfil."</td>";
                                    					if( $CodPerfil != 1 )
                                    					{
                                    						echo "<td><a href='?p=perfil&id=".$CodPerfil."'><img src='../images/icone_editar.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    						echo "<td><a href='?p=perfil&eid=".$CodPerfil."'><img src='../images/icone_excluir.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					else
                                    					{
                                                            //echo "<td></td>";
                                                            //echo "<td></td>";
                                    						echo "<td><a href='?p=perfil&id=".$CodPerfil."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    						echo "<td><a href='?p=perfil&eid=".$CodPerfil."'><img src='../images/icone_vazio.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					echo "</tr>";
                                    				}
                                    			}

                                    			?>
                                    	</tbody>
                 
                                    </table>
                                    
                                    
                    
                     <h2>
                        <a href='?p=perfil&nid=1'>Incluir</a>
                    </h2>
                    <br />
				</div>



