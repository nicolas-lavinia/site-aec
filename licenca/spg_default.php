                <script>
                function Mudarestado(el) {
                    var display = document.getElementById(el).style.display;
                    if(display == "none")
                        document.getElementById(el).style.display = 'block';
                    else
                        document.getElementById(el).style.display = 'none';
                }
                </script>
                
                <?php
	                if( $_SERVER['REQUEST_METHOD']=='POST' )
	                {
	                	$request = md5( implode( $_POST ) );
	                
	                	if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request )
	                	{
	                		//echo 'refresh';
	                	}
	                	else
	                	{
	                		$_SESSION['last_request']  = $request;

	                		if( isset( $_POST["new_qtd"] ) )
	                		{
	                			$new_qtd   = $_POST["new_qtd"];
	                			$id_device   = $_POST["id_device"];
	                		
	                			$query = "SELECT qtd_licencas FROM devices WHERE id = ".$id_device;
	                			if( $stmt = $mysqli->prepare( $query ) )
	                			{
	                				$stmt->execute();                           // Executa a query preparada.
	                				$stmt->store_result();
	                				$stmt->bind_result( $qtd_atual );           // obt�m vari�veis do resultado.
	                				$stmt->fetch();
	                			}
	                		
	                			if( $qtd_atual != $new_qtd )
	                			{
	                				if( $qtd_atual > $new_qtd )
	                				{
	                					$acao = ACAO_DECRESCIMO;
	                					$dif = $qtd_atual - $new_qtd;
	                				}
	                				else
	                				{
	                					$acao = ACAO_ACRESCIMO;
	                					$dif = $new_qtd - $qtd_atual;
	                				}
	                				 
	                				require('dbconnlic.php');
	                				 
	                				$query = "UPDATE devices SET id_proprietario='$id_user' WHERE id='$id_device'";
	                				$mysqli->query($query);
	                				 
	                				$agora = date( 'Y-m-d H:i:s' );
	                				$query = "INSERT INTO log ( pedido, id_device, acao, qtd, status ) VALUES ( '$agora', '$id_device', '$acao','$dif', ".STATUS_SOLICITADO." )";
	                				$mysqli->query($query);
	                			}
	                		}
	                	}
	                }
                ?>
                
                <div class="left">
                    <p>
                        <br />
                    </p>
                </div>
                
                <div class="right">
	                <?php
		                if( $handle = fopen( "../.licenca", "r" ) )
		                {
		                	$serial = fscanf( $handle, "%s %s" );
		                	fclose( $handle );
		                	
	                		require('dbconnlic.php');
	                		$query = "SELECT status FROM log INNER JOIN devices ON devices.id = log.id_device WHERE devices.serial = ? ORDER BY log.id DESC LIMIT 1";
	                		$stmt = $mysqli->prepare( $query );
	                		$stmt->bind_param( 's', $serial[1] );
	                		$stmt->execute();
	                		$stmt->store_result();
	                		$stmt->bind_result( $status );
	                		if( $stmt->fetch() )
	                		{
	                			if( $status == STATUS_SOLICITADO )
	                			{
	                				// noa autorizados
	                				echo "<h3>Existem solicita&ccedil&otildees de novas licen&ccedilas que ainda n&atildeo foram autorizadas pela Nexttech.</h3>";
	                			}
	                			else if( $status == STATUS_AUTORIZADO )
	                			{
	                				// nao homologado
	                				echo "<h3>Existem licen&ccedilas autorizadas que ainda n&atildeo foram homologadas no equipamento.</h3>";
	                			}
	                			else
	                			{
	                				$query = "SELECT id, qtd_licencas, id_proprietario FROM devices WHERE serial = ?";
	                				$stmt = $mysqli->prepare( $query );
	                				$stmt->bind_param( 's', $serial[1] );
	                				$stmt->execute();                           // Executa a query preparada.
	                				$stmt->store_result();
	                				$stmt->bind_result( $id_device, $qtd_licencas, $id_proprietario );           // obt�m vari�veis do resultado.
	                				if( $stmt->fetch() )
	                				{
	                					if( $id_proprietario != EQP_DEMOSTRACAO )
	                					{
	                						echo "<h3>N&uacutem. Serial: ".$serial[1]."<br/><br/>Quantidade Atual de Licen&ccedilas: ".$qtd_licencas."</h3>";
	                					}
	                					else
	                					{
	                						echo "<h3>N&uacutem. Serial: ".$serial[1]."<br/><br/>Quantidade Atual de Licen&ccedilas: ".$qtd_licencas." (Demonstra&ccedil&atildeo)</h3>";
	                					}
	                				
	                					echo "<br/>";
	                					echo "<br/>";
	                					?>
                				        	<span><input type="checkbox" name="alt_qtd_lic" onclick="Mudarestado('alt_qtd_lic')">Adicionar / Remover Licen&ccedilas</span>
                												
                							<div id="alt_qtd_lic" style="display: none;"> 
                												
	                							<form method='post' >
	                								
	                								<input type="hidden" name="id_device" value="<?php echo $id_device;?>" >
	                									
	                								<br/>
	                														
	                								<span>Alterar para:
	                								<select name="new_qtd">
	                								<?php 
	                									for( $i = 1 ; $i <= 30 ; $i++ )
	                									{
	                										if( $id_proprietario == 0 )
	                										{
	                											echo "<option value='".$i."'>".$i."</option>";
	                										}
	                										else
	                										{
	                										if( $i != $qtd_licencas )
	                											echo "<option value='".$i."'>".$i."</option>";
	                										}
	                									}
	           										?>
	                								</select> Licen&ccedilas</span>
	                								
	                								<br/>
	                								<br/>
	                								
	                								<input type="submit" value="Alterar">
	                								
	                							</form>
                							</div>
										<?php
	                				}
                				    else
                				    {
                				    	echo "<h3>Equipamento ainda n&atildeo foi cadastrado!</h3>";
                				    }
	                			}
	                		}
	                		else
	                		{
	                			echo "<h3>Equipamento ainda n&atildeo foi cadastrado!</h3>";
	                		}
                		}
	                	else
	                	{
	                		echo "<h3>Equipamento ainda n&atildeo declarou seu MAC Address!</h3>";
	                	}
	                ?>
                </div>