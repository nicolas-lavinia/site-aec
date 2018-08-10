				<!-- ***************** Centro ***************** -->
				<?php
				//require('db_connect.php');
				if( isset( $_POST["pasta"] ) )
				{
					$pasta   = $_POST["pasta"];
					
					$query = "UPDATE paramt SET Path='$pasta'";
					$mysqli->query($query);
				}
				?>				
				
				<script>
					function SubmitForm( )
					{
						//document.formato.submit()
					}
				</script>
				
				<main id="center" class="column">
					<article>
						
						
						<h1>Pasta Armazenamento</h1>
						
							<?php 
                                $query = "SELECT Path FROM paramt LIMIT 1";
                                if( $stmt = $mysqli->prepare( $query ) )
                                {
	                                $stmt->execute();                           // Executa a query preparada.
	                                $stmt->store_result();
	                                $stmt->bind_result( $pasta );           // obt�m vari�veis do resultado.
	                                $stmt->fetch();
                                }
           					?>
                          
						<form method="post" name="pasta" >
                                    					
							<p>Pasta de grava&ccedil&atildeo arquivos de &aacuteudio: 
							<input type='text' name='pasta' value='<?php echo $pasta; ?>' maxlength=100 onblur="SubmitForm()" /> 
						  
							<br/>
						  	<br/>
						  	
							<input type="submit" value="Gravar" />  	
						</form>
					                                          
					</article>								
				</main>
				
				<!-- ***************** Lado Direito ***************** -->
				<!--  <div id="right" class="column">
					
				</div>  -->



