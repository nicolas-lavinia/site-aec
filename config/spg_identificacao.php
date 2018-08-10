
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
		    width: 200px;
		}
		
		div.painel_e {
			padding: 5px;
			background: #EEEEEE;
			width: 411px;
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
            width: 100px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }

    .style3 {
        	font-size:12px;
        	width: 70px;
            text-align: left;
            border: none !important;
        }
	</style>
     
	<?php 
		$proprietario[1] = EQP_DEMOSTRACAO;
		$qtd_licencas[1] = QTD_LICENCAS_DEMO;
		if( $handle = fopen( "../.licenca", "r" ) )
		{
			fscanf( $handle, "%s %s" );
			$proprietario = fscanf( $handle, "%s %s" );
			$qtd_licencas = fscanf( $handle, "%s %s" );
			fclose( $handle );
		}
	?>
                            
<script type="text/javascript">

    function habilita_ramais() {
		<?php
		if( $qtd_licencas[1] > 1 )
		{
			for( $i = 1 ; $i < $qtd_licencas[1] ; $i++ )
			{
				echo "document.getElementById( 'nomeporta_".($i+1)."' ).disabled = false;\n";
				echo "document.getElementById( 'ipramal_".($i+1)."'   ).disabled = false;\n";
			}
		}
		?>
	}
	
    function desabilita_ramais() {
		<?php
		if( $qtd_licencas[1] > 1 )
		{
			for( $i = 1 ; $i < $qtd_licencas[1] ; $i++ )
			{
				echo "document.getElementById( 'nomeporta_".($i+1)."' ).disabled = true;\n";
				echo "document.getElementById( 'ipramal_".($i+1)."'   ).disabled = true;\n";
			}
		}
		?>
	}
	
	function escolheu_rtp( )
	{
		document.getElementById( 'idr' ).disabled = false;
		document.getElementById( 'idt' ).disabled = false;
		
		document.getElementById( 'nomeporta_1' ).disabled = false;
		document.getElementById( 'ipramal_1'   ).disabled = false;

		if( document.getElementById( 'idr' ).checked == true )
		{
			<?php
			for( $i = 2 ; $i <= $qtd_licencas[1] ; $i++ )
			{
				echo "document.getElementById( 'nomeporta_".$i."' ).disabled = false;\n";
				echo "document.getElementById( 'ipramal_".$i."'   ).disabled = false;\n";
			}
			?>
		}
		
		document.getElementById( 'textarea_gravar'  ).disabled = true;
		document.getElementById( 'textarea_ngravar' ).disabled = true;
	}

	function escolheu_sip( )
	{
		if( document.getElementById( 'idr' ).checked == true )
			document.getElementById( 'idt' ).disabled = true;
		if( document.getElementById( 'idt' ).checked == true )
			document.getElementById( 'idr' ).disabled = true;
		
		<?php
			for( $i = 1 ; $i <= $qtd_licencas[1] ; $i++ )
			{
				echo "document.getElementById( 'nomeporta_".$i."' ).disabled = true;\n";
				echo "document.getElementById( 'ipramal_".$i."'   ).disabled = true;\n";
			}
		?>
		document.getElementById( 'textarea_gravar'  ).disabled = false;
		document.getElementById( 'textarea_ngravar' ).disabled = false;
		
	}

	function check_ramais( gravar )
	{
		for( i = 0 ; i < gravar.length ; i++ )
		{
			if( i == 0 )
			{
				if( !( ( gravar[ i ] >= '0' ) && ( gravar[ i ] <= '9' ) ) )
				{
					return( 0 );
				}
			}
			if( !( ( ( gravar[ i ] >= '0' ) && ( gravar[ i ] <= '9' ) ) || ( gravar[ i ] == ';' ) || ( gravar[ i ] == '-' ) ) )
			{
				return( 0 );
			}
			if( i >= 1 )
			{
				if( ( gravar[ i ] == ';' ) || ( gravar[ i ] == '-' ) )
				{
					if( !( ( gravar[ i - 1 ] >= '0' ) && ( gravar[ i -1 ] <= '9' ) ) )
					{
						return( 0 );
					}
				}
			} 
		}
		if( gravar[ i - 1 ] == '-' )
		{
			return( 0 );
		}
		return( 1 );	

	}

	function validar_ramais( )
	{
		if( check_ramais( document.getElementById( 'textarea_gravar' ).value ) == 0 )
			alert( 'Falha na validação dos ramais para gravar!' );
		else if( check_ramais( document.getElementById( 'textarea_ngravar' ).value ) == 0 )
			alert( 'Falha na validação dos ramais para não gravar!' );
		else
			alert( 'Ramais validados com sucesso!' );
	}
	
	function validar_ramais_submit( )
	{
		if( check_ramais( document.getElementById( 'textarea_gravar' ).value ) == 0 )
		{
			alert( 'Falha na validação dos ramais para gravar!' );
			return false;
		}
		else if( check_ramais( document.getElementById( 'textarea_ngravar' ).value ) == 0 )
		{
			alert( 'Falha na validação dos ramais para não gravar!' );
			return false;
		}
		else
		{
			return true
		}
	}
</script>
    
				<!-- ***************** Centro ***************** -->
				<?php
				//require('db_connect.php');
				for( $i = 1 ; $i <= QTD_MAXIMA_RAMAIS ; $i++ )
				{
					if( isset( $_POST[ "nomeporta_".$i ] ) )
					{
						$NomePorta = $_POST[ "nomeporta_".$i ];
						$IPServer = $_POST[ "ipramal_".$i ];
				
						$query = "UPDATE portas SET NomePorta = '$NomePorta', IPServer = '$IPServer' WHERE cod_id = '$i'";
						$mysqli->query($query);
						$query = "UPDATE instalacao SET xml=0 WHERE id = 1";
						$mysqli->query($query);
					}
				}
				
				if( isset( $_POST["id_instalacao"] ) )
				{
					$id_instalacao = $_POST[ "id_instalacao"  ];
					$query = "UPDATE instalacao SET tipo = '$id_instalacao', xml=0 WHERE id = 1";
					$mysqli->query($query);
				}
				
				if( isset( $_POST["id_protocolo"] ) )
				{
					$id_protocolo = $_POST[ "id_protocolo"  ];
					$query = "UPDATE instalacao SET protocolo = '$id_protocolo', xml=0 WHERE id = 1";
					$mysqli->query($query);
				}
				
				if( isset( $_POST["r_gravar"] ) )
				{
					$gravar = $_POST[ "r_gravar" ];
					$query = "UPDATE instalacao SET gravar = '$gravar' WHERE id = 1";
					$mysqli->query($query);
				}
				if( isset( $_POST["r_ngravar"] ) )
				{
					$ngravar = $_POST[ "r_ngravar" ];
					$query = "UPDATE instalacao SET nao_gravar = '$ngravar' WHERE id = 1";
					$mysqli->query($query);
				}
				if( isset( $_POST["id_indexacao"] ) )
				{
					$id_indexacao = $_POST[ "id_indexacao" ];
					$query = "UPDATE instalacao SET indexacao = '$id_indexacao' WHERE id = 1";
					$mysqli->query($query);
						
					echo "<script language= 'JavaScript'>location.href='index.php'</script>";
					exit();
				}
				?>
				
				<!-- ***************** Lado Direito ***************** -->
				<div class="left">
				    <p>
				        <br />
				    </p>
				</div>

				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="right">

						<div class="painel_e">

					        <h2>
					            Indexa&ccedil&atildeo / Identifica&ccedil&atildeo dos ramais
					        </h2>

							<?php 
							$query = "SELECT Path FROM paramt LIMIT 1";
							if( $stmt = $mysqli->prepare( $query ) )
							{
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result( $pasta );
								$stmt->fetch();
							}
							
							$query = "SELECT tipo, indexacao, protocolo, gravar, nao_gravar FROM instalacao WHERE id = 1 LIMIT 1";
							if( $stmt = $mysqli->prepare( $query ) )
							{
								$stmt->execute();
								$stmt->store_result();
								$stmt->bind_result( $id_instalacao, $id_indexacao, $id_protocolo, $gravar, $ngravar );
								$stmt->fetch();
							}
// 							$proprietario[1] = EQP_LEUCOTRON;
           					?>
                          
						<form method="post" name="portas" >

                            <table class="style1">
                            	
                            	<tr>
                                	<td class="style2">
										Tipo de Indexa&ccedil&atildeo:
                                    </td>
                                    <td class="style3">
	                            		<input type='radio' name='id_indexacao' value='<?php echo INDEXACAO_BD_LOCAL; ?>' <?php if( $id_indexacao == INDEXACAO_BD_LOCAL ){echo 'checked';}?> />Local<br/>
			                            <input type='radio' name='id_indexacao' value='<?php echo INDEXACAO_XML;      ?>' <?php if( $id_indexacao == INDEXACAO_XML      ){echo 'checked';}?> />Remota<br/>
                          			</td>
                            	</tr>
                            	
   								<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
                                	<td class="style2">
                                    </td>
                                    <td class="style3">
                            		</td>
                            	</tr>
                            	
                               	<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
                                	<td class="style2">
										Protocolo:
                                    </td>
                                    <td class="style3">
                            			<input type='radio' name='id_protocolo' value='<?php echo RTP; ?>' <?php if( $id_protocolo == RTP ){echo 'checked';}?>  onclick="escolheu_rtp( );">  RTP<br/>
                            			<input type='radio' name='id_protocolo' value='<?php echo SIP; ?>' <?php if( $id_protocolo == SIP ){echo 'checked';}?>  onclick="escolheu_sip( );">  SIP<br/>
                            		</td>
                            	</tr>

								<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
			                        <td class="style2">
			                        </td>
			                        <td class="style3">
			                        </td>
			                    </tr>

                    			<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
                                	<td class="style2">
                            			Tipo de Instala&ccedil&atildeo:
                                    </td>

                                    <td class="style3">
			                            <input id="idr" type='radio' name='id_instalacao' value='<?php echo RAMAL; ?>' <?php if( $id_instalacao == RAMAL  ){echo 'checked';}else{if( $id_protocolo == SIP ){echo 'disabled';}}?> onclick="habilita_ramais( );" />Ramal<br/>
			                            <input id="idt" type='radio' name='id_instalacao' value='<?php echo TRONCO;?>' <?php if( $id_instalacao == TRONCO ){echo 'checked';}else{if( $id_protocolo == SIP ){echo 'disabled';}}?> onclick="desabilita_ramais( );" />Tronco<br/>
                            		</td>
                    			</tr>

                    			<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
			                        <td class="style2">
			                        </td>
			                        <td class="style3">
			                        </td>
                            	</tr>
                            	
                            	<tr <?php if( $proprietario[1] == EQP_LEUCOTRON ){echo "style='display:none;'";} ?> >
  									<th style='text-align: center;'>Ramal</th>
  									<th style='text-align: center;'>IP</th>
  								</tr>

	  									<?php
	                                    	$query = "SELECT cod_id, NomePorta, IPServer FROM portas ORDER BY cod_id ASC LIMIT ".$qtd_licencas[1];
	                               			if( $stmt = $mysqli->prepare( $query ) )
	                               			{
		                           				$stmt->execute();
		                           				$stmt->store_result();
		                           				$stmt->bind_result( $cod_id, $NomePorta, $IPServer );
		                               			while( $stmt->fetch() )
		                           				{
		                           					if ( $proprietario[1] == EQP_LEUCOTRON )
		                           						echo "<tr style='display:none;'>";
		                           					else
		                           						echo "<tr>";
		                           					echo "<td><input type='text' value='".$NomePorta."' name='nomeporta_".$cod_id."' id='nomeporta_".$cod_id."' maxlength=50 style='width:90%;' ";
		                           						if( ( ( $cod_id > 1 ) && ( $id_instalacao == TRONCO ) ) || ( $id_protocolo == SIP ) )
		                           						echo "disabled";
		                           					echo "/></td>";
		                           					echo "<td><input type='text' value='".$IPServer."'  name='ipramal_".$cod_id."'   id='ipramal_".$cod_id."'   maxlength=15 style='width:90%;' ";
		                           						if( ( ( $cod_id > 1 ) && ( $id_instalacao == TRONCO ) ) || ( $id_protocolo == SIP ) )
		                           							echo "disabled";
		                           					echo "/></td>";
		                           					echo "</tr>";
		                                    	}
	                                    	}
										?>
								
								<tr>
	                                <td class="style2">
	                            		<br />
	                                </td>
	                                <td class="style3">
	                            		<br />
	                            	</td>
                            	</tr>
                            	
       							<tr>
                                	<td  class="style2" colspan=2>
                                	Identifica&ccedil&atildeo Protocolo SIP:<br/>
                                	Informe os ramais separados por ";" e, para informar um intervalo, utilize "-".<br/>
                                	Ex: 4001;4002;4005-4009;4011<br/>
                                	<a onclick='validar_ramais();'>Validar Ramais</a>
                                    </td>
                            	</tr>
								<tr>
                                	<td  class="style2">
                                	Ramais p/ Gravar:
                                    </td>
                                    <td class="style3">
                                    	<textarea id='textarea_gravar' rows='5' cols='30' name='r_gravar' <?php if( $id_protocolo == RTP ){echo "disabled";} ?>/><?php echo $gravar; ?></textarea>
                            		</td>
                            	</tr>
                            	<tr>
                                	<td class="style2">
                                	Ramais p/ N&atildeo Gravar:
                                    </td>
                                    <td class="style3">
                                    	<textarea id='textarea_ngravar' rows='5' cols='30' name='r_ngravar' <?php if( $id_protocolo == RTP ){echo "disabled";} ?>/><?php echo $ngravar; ?></textarea>
                            		</td>
                            	</tr>
                            	
                                <tr>
                                    <td class="style2">
                            			<br />
                                    </td>
                                    <td class="style2">
                            			<input type="submit" value="Gravar" onClick="return validar_ramais_submit()"/>
                                	</td>
                           		</tr>
                            </table>
						</form>

					</div>
						
				</div>
