<?php
	if( isset( $_POST["formato"] ) || isset( $_POST["duracao"] ) )
	{
		$formato   = $_POST["formato"];
		$duracao   = $_POST["duracao"];
		
		if( retorna_num( $duracao ) )
		{
			if( $duracao < 0 )
				$duracao = 0;
			$query = "UPDATE paramt SET Formato='$formato', MinGrava='$duracao'";
			$mysqli->query($query);
		}
		echo "<script language= 'JavaScript'>location.href='index.php'</script>";
		exit();	
	}
	
	if( isset( $_POST["qualidade"] ) )
	{
		$qualidade = $_POST["qualidade"];
		
		$query = "UPDATE paramt SET Qualidade='$qualidade'";
		$mysqli->query($query);
		echo "<script language= 'JavaScript'>location.href='index.php'</script>";
		exit();
	}
?>

	<script>
	function escolheu_wave( )
	{
		document.getElementById( 'qb' ).disabled = true;
		document.getElementById( 'qm' ).disabled = true;
		document.getElementById( 'qa' ).disabled = true;
	}

	function escolheu_mp3( )
	{
		document.getElementById( 'qb' ).disabled = false;
		document.getElementById( 'qm' ).disabled = false;
		document.getElementById( 'qa' ).disabled = false;
	}
	</script>
	<style type="text/css">
		div.painel_e
		{
			padding: 5px;
			background: #EEEEEE;
			width: 338px;
		}
        .style1
        {
        	font-family: Arial, Helvetica, sans-serif;
        	width: 62px;
        	border: none !important;
            width: 100%;
            text-align: right;
        }
        .style2
        {
        	font-size:12px;
        	height: 22px;
            width: 80px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
        .style3
        {
        	font-size:12px;
        	width: 50px;
            text-align: left;
            border: none !important;
        }
	</style>

				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">
						
                    <p>
                        <br />
                    </p>

						<?php 
                                $query = "SELECT Formato, Qualidade, MinGrava FROM paramt LIMIT 1";
                                if( $stmt = $mysqli->prepare( $query ) )
                                {
	                                $stmt->execute();                           // Executa a query preparada.
	                                $stmt->store_result();
	                                $stmt->bind_result( $formato, $qualidade, $duracao );           // obt�m vari�veis do resultado.
	                                $stmt->fetch();
                                }
       					?>

                </div>

                <!-- ***************** Lado Direito ***************** -->
				<div class="right">
						
                   <div class="painel_e">
                          
						<form method="post" name="formato" >
						
							<table class="style1">
                                    	<h2>
                                            Formato dos arquivos de &aacuteudio
                                        </h2>
                            	<tr>
                                	<td class="style2">
										Formato:
                                    </td>
                                    <td class="style3">
                            			<input type="radio" name="formato" value='<?php echo FORMATO_WAVE; ?>' <?php if( $formato == FORMATO_WAVE ){ echo checked; }?> onclick="escolheu_wave( );"> Wave<br/>
										<input type="radio" name="formato" value='<?php echo FORMATO_MP3;  ?>' <?php if( $formato == FORMATO_MP3 ) { echo checked; }?> onclick="escolheu_mp3( );" > MP3<br/>
                                	</td>
                            	</tr>
                            	
                            	<tr>
                                	<td class="style2">
                                        <br />
                                    </td>
                                </tr>

                            	<tr>
                                	<td class="style2">
										Qualidade:
                                    </td>
                                    <td class="style3">
			   							<input id="qb" type="radio" name="qualidade" value='<?php echo QUALIDADE_BAIXA; ?>' <?php if( $qualidade == QUALIDADE_BAIXA ){ echo checked; }else{if( $formato == FORMATO_WAVE ){ echo disabled; }}?> > Baixa<br/>
										<input id="qm" type="radio" name="qualidade" value='<?php echo QUALIDADE_MEDIA; ?>' <?php if( $qualidade == QUALIDADE_MEDIA ){ echo checked; }else{if( $formato == FORMATO_WAVE ){ echo disabled; }}?> > Media<br/>
			  							<input id="qa" type="radio" name="qualidade" value='<?php echo QUALIDADE_ALTA;  ?>' <?php if( $qualidade == QUALIDADE_ALTA  ){ echo checked; }else{if( $formato == FORMATO_WAVE ){ echo disabled; }}?> > Alta<br/>
                                	</td>
                            	</tr>
                            	
                            	<tr>
                                	<td class="style2">
                                        <br />
                                    </td>
                                </tr>

                            	<tr>
                                	<td class="style2">
										Ignorar grava&ccedil&otildees menores que (seg.):
                                    </td>
                                    <td class="style2">
			   							<input type='text' name='duracao' value='<?php echo $duracao; ?>' size="5" maxlength=3 />
                                	</td>
                            	</tr>
                            	
                            	<tr>
                                	<td class="style2">
                                        <br />
                                    </td>
                            	</tr>

                            	<tr>
                                	<td class="style2">
                                    </td>
                                    <td class="style2">
			   							<input type="submit" value="Gravar" />
                                	</td>
                            	</tr>

                            </table>

						</form>
					</div>
					                                    						
				</div>
				



