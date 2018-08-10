
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
		    text-align: center;
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
            width: 338px;
        }

    .style7 {
            height: 22px;
            font-size: 12px;
            font-weight:bold;
			border: none;
			text-align: left;
	width: 110px;
        }
    </style>
     
	<script>
		
    	$(function() { 

            // Setup the player to autoplay the next track
        var a = audiojs.createAll(/*{
          /*trackEnded: function() {
            var next = $('ol li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
          }
        }*/);
     
        
        // Load in the first track
        var audio = a[0];
        first = $('tr a').attr('data-src');
        $('tr td').first().addClass('playing');
        audio.load(first);
		
		
        // Load in a track on click
        $('#table_ouvir tr td').click(function(e) {
			if ($('a', this).attr('data-src') != null) {
	            e.preventDefault();
	        	$(this).addClass('playing').siblings().removeClass('playing');
	        	audio.load($('a', this).attr('data-src'));
	        	audio.play();
			}
        });

        /*
        // Keyboard shortcuts
        $(document).keydown(function(e) {
          var unicode = e.charCode ? e.charCode : e.keyCode;
             // right arrow
          if (unicode == 39) {
            var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
            // back arrow
          } else if (unicode == 37) {
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
            // spacebar
          } else if (unicode == 32) {
            audio.playPause();
          }
        })*/
      });
        
    </script>
				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">
				    <h3>
		Crit&eacuterio de Pesquisa
		<br />
                    </h3>
					<br />
   
   					<div class="painel_e">
   					
   					<?php    					
   					if( isset( $_POST["f_data_inicial"] ) )
   					{
   						if( isset( $_POST[ 'f_iniciadas'] ) )
   							$f_iniciadas = 1;
   						else
   							$f_iniciadas = 0;
   						if( isset( $_POST[ 'f_recebidas'] ) )
   							$f_recebidas = 1;
   						else
   							$f_recebidas = 0;
   							
   						$f_ramal    = $_POST[ 'f_ramal' ];
   						$f_telefone = $_POST[ 'f_telefone' ];
   						$f_comentario = $_POST[ 'f_comentario' ];
   						
   						$f_data_inicial = $_POST[ 'f_data_inicial' ];
   						$f_data_final = $_POST[ 'f_data_final' ];
   						
   						$f_hora_inicial = $_POST[ 'f_hora_inicial' ];
   						$f_hora_final = $_POST[ 'f_hora_final' ];
   						
   						$f_duracao_inicial = $_POST[ 'f_duracao_inicial' ];
   						$f_duracao_final = $_POST[ 'f_duracao_final' ];
   						
   						$_SESSION[ 'f_data_inicial' ] = $f_data_inicial;
   						$_SESSION[ 'f_data_final' ] = $f_data_final;
   						$_SESSION[ 'f_hora_inicial' ] = $f_hora_inicial;
   						$_SESSION[ 'f_hora_final' ] = $f_hora_final;
   						$_SESSION[ 'f_duracao_inicial' ] = $f_duracao_inicial;
   						$_SESSION[ 'f_duracao_final' ] = $f_duracao_final;
   						$_SESSION[ 'f_iniciadas' ] = $f_iniciadas;
   						$_SESSION[ 'f_recebidas' ] = $f_recebidas;
   						$_SESSION[ 'f_ramal' ] = $f_ramal;
   						$_SESSION[ 'f_telefone' ] = $f_telefone;
   						$_SESSION[ 'f_comentario' ] = $f_comentario;
   					}
   					else
   					{
   						$f_data_inicial = $_SESSION[ 'f_data_inicial' ];
   						$f_data_final = $_SESSION[ 'f_data_final' ];
   						$f_hora_inicial = $_SESSION[ 'f_hora_inicial' ];
   						$f_hora_final = $_SESSION[ 'f_hora_final' ];
   						$f_duracao_inicial = $_SESSION[ 'f_duracao_inicial' ];
   						$f_duracao_final = $_SESSION[ 'f_duracao_final' ];
   						$f_iniciadas = $_SESSION[ 'f_iniciadas' ];
   						$f_recebidas = $_SESSION[ 'f_recebidas' ];
   						$f_ramal = $_SESSION[ 'f_ramal' ];
   						$f_telefone = $_SESSION[ 'f_telefone' ];
   						$f_comentario = $_SESSION[ 'f_comentario' ];



   					}
   					?>
   					
   					<form method='post' >
   					
   					     <table class="style1">
                            <tr>
					<td class="style7"></td>
                                <td class="style7">
                                    de
                                </td>
                                <td class="style7">
                                    at&eacute
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Per&iacuteodo
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_data_inicial" id="f_data_inicial" value="<?php echo $f_data_inicial; ?>" style="width:110px;" />
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_data_final" id="f_data_final" value="<?php echo $f_data_final; ?>" style="width:110px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Horário
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_hora_inicial" id="f_hora_inicial" value="<?php echo $f_hora_inicial; ?>" style="width:110px;" />
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_hora_final" id="f_hora_final" value="<?php echo $f_hora_final; ?>" style="width:110px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Duração
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_duracao_inicial" id="f_duracao_inicial" value="<?php echo $f_duracao_inicial;?>" style="width:110px;" />
                                </td>
                                <td class="style7">
                                    <input type="text" name="f_duracao_final" id="f_duracao_final" value="<?php echo $f_duracao_final; ?>" style="width:110px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Tipo
                                </td>
                                <td class="style7">
						<input type="checkbox" name="f_iniciadas" <?php if( $f_iniciadas ){echo "checked";}?> />Iniciadas
                                </td>
                                <td class="style7">
						<input type="checkbox" name="f_recebidas" <?php if( $f_recebidas ){echo "checked";}?> />Recebidas
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Ramal
                                </td>
                                <td class="style7" colspan="2">
                                    <input type="text" name="f_ramal" value="<?php echo $f_ramal;?>" style="width:220px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Telefone
                                </td>
                                <td class="style7" colspan="2">
                                    <input type="text" name="f_telefone" value="<?php echo $f_telefone;?>" style="width:220px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="style7">
                                    Comentários
                                </td>
                                
                                <td class="style7" colspan="2">
                                    <input type="text" name="f_comentario" value="<?php echo $f_comentario;?>" style="width:220px;" />
                                </td>
                            </tr>



                            <tr>
                                <td class="style7">
						<br />

                                    </td>
					<td class="style7" colspan="2"></td>


					<tr>
						<td class="style7"></td>
						<td class="style7" colspan="2">
							<input type="submit" value="Pesquisar" />
                                </td>
                            </tr>
                        </table>
   					
						</form>
   					</div>
   				</div>
   					
   				<!-- ***************** Lado Direito ***************** -->
				<div class="right">
					<?php 
					
					$permisao = '';
					$query = "SELECT CodGrupo, CodPerfil FROM cadusu WHERE CodUsu = ".$id_user;
					$stmt = $mysqli->prepare( $query );
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result( $cod_grupo, $cod_perfil );
					$stmt->fetch();
					
					$query = "SELECT opc_03, opc_04, opc_05, opc_06, opc_07 FROM perfil WHERE CodPerfil = ".$cod_perfil;
					$stmt = $mysqli->prepare( $query );
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result( $opc_03, $opc_04, $opc_05, $opc_06, $opc_07 );
					$stmt->fetch();
						
					
					$query = "SELECT NomePorta FROM portas INNER JOIN gruporamal ON portas.CodPorta = gruporamal.CodPorta WHERE gruporamal.CodGrupo = ".$cod_grupo;
					$stmt = $mysqli->prepare( $query );
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result( $nome_porta );
					while( $stmt->fetch() )
					{
						if( $permisao == '' )
							$permisao = " and ( Estacao = '".$nome_porta."'";
						else
							$permisao .= " or Estacao = '".$nome_porta."'";
					}
					 
					if( $permisao |= '' )
						$permisao .= " )";
						 
					$SqlStr = "select  Estacao, HoraIni, Cast(Sec_To_Time(Time_To_Sec(HoraFim) - Time_To_Sec(HoraIni)) as Char) as durac, Tipo, Telefone, Coment, NomeFile, HoraFim, Codigo ";
					$SqlStr .= "From gravacao WHERE 1";
						 
					if( trim( $f_ramal ) <> "" )
						$SqlStr .= " and Estacao like '%".trim( $f_ramal )."%'";
						 
					if( trim( $f_comentario ) <> "" )
						$SqlStr .= " and Coment like '%".trim( $f_comentario )."%'";
						 
					if( trim( $f_telefone ) <> "" )
						$SqlStr .= " and Telefone like '%".trim( $f_telefone )."%'";
						 
						 
					if( ( trim( $f_data_inicial ) <> "" ) && ( trim( $f_data_final ) <> "" ) )
					{
						$aux = explode( "/", $f_data_inicial );
						$SqlStr .= " and HoraIni Between '".$aux[2]."/".$aux[1]."/".$aux[0]." 00:00:00' and '";// & Format(CDate(Me.dtHoraFim.Value), "yyyy/M/d") & " 23:59:59'";
				
						$aux = explode( "/", $f_data_final );
						$SqlStr .= $aux[2]."/".$aux[1]."/".$aux[0]." 23:59:59'";
					}
					else if( ( trim( $f_data_inicial ) <> "" ) && ( trim( $f_data_final ) == "" ) )
					{
						$aux = explode( "/", $f_data_inicial );
						$SqlStr .= " and HoraIni >= '".$aux[2]."/".$aux[1]."/".$aux[0]." 00:00:00'";
					}
					else if( ( trim( $f_data_inicial ) == "" ) && ( trim( $f_data_final ) <> "" ) )
					{
						$aux = explode( "/", $f_data_final );
						$SqlStr .= " and HoraIni <= '".$aux[2]."/".$aux[1]."/".$aux[0]." 23:59:59'";
					}
						 
					if( ( trim( $f_hora_inicial ) <> "" ) && ( trim( $f_hora_final ) <> "" ) )
					{
						$SqlStr .= " and Date_Format(HoraIni,'%T') Between '".$f_hora_inicial."' and '".$f_hora_final."'";
					}
					else if( ( trim( $f_hora_inicial ) <> "" ) && ( trim( $f_hora_final ) == "" ) )
					{
						$SqlStr .= " and Date_Format(HoraIni,'%T') >= '".$f_hora_inicial."'";
					}
					else if( ( trim( $f_hora_inicial ) == "" ) && ( trim( $f_hora_final ) <> "" ) )
					{
						$SqlStr .= " and Date_Format(HoraIni,'%T') <= '".$f_hora_final."'";
					}
						 
					if( ( trim( $f_duracao_inicial ) <> "" ) && ( trim( $f_duracao_final ) <> "" ) )
					{
						$aux = explode( ":", $f_duracao_inicial );
						$t_inicial = $aux[0] * 3600 + $aux[1] * 60 + $aux[2];
						$aux = explode( ":", $f_duracao_final );
						$t_final = $aux[0] * 3600 + $aux[1] * 60 + $aux[2];
				
						$SqlStr .= " and Time_To_Sec(HoraFim) - Time_To_Sec(HoraIni) Between ".$t_inicial." and ".$t_final." ";
					}
					else if( ( trim( $f_duracao_inicial ) <> "" ) && ( trim( $f_hduracao_final ) == "" ) )
					{
						$aux = explode( ":", $f_duracao_inicial );
						$t_inicial = $aux[0] * 3600 + $aux[1] * 60 + $aux[2];
				
						$SqlStr .= " and Time_To_Sec(HoraFim) - Time_To_Sec(HoraIni) >= ".$t_inicial;
					}
					else if( ( trim( $f_duracao_inicial ) == "" ) && ( trim( $f_duracao_final ) <> "" ) )
					{
						$aux = explode( ":", $f_duracao_final );
						$t_final = $aux[0] * 3600 + $aux[1] * 60 + $aux[2];
				
						$SqlStr .= " and Time_To_Sec(HoraFim) - Time_To_Sec(HoraIni) <= ".$t_final;
					}
					 
					if( ( $f_iniciadas == 1 ) && ( $f_recebidas == 0 ) )
						$SqlStr .= " and Tipo = 'I' ";
					else if( ( $f_iniciadas == 0 ) && ( $f_recebidas == 1 ) )
						$SqlStr .= " and Tipo = 'R' ";
				
					$SqlStr .= $permisao;
// 					echo $SqlStr;
								
					if( $stmt = $mysqli->prepare( $SqlStr ) )
					{
						$stmt->execute();
						$stmt->store_result();
						$qtd = $stmt->num_rows;
						$stmt->bind_result( $estacao, $horaini, $duracao, $tipo, $telefone, $coment, $namefile, $horafim, $codigo );
					}
					
					?>
					
     		<div id="wrapper">
				<?php if( $qtd > 0 ){ echo "<audio preload></audio>"; } ?>
							
					<h3>

			<?php
			if( $qtd == 0 )
				echo "Nenhuma grava&ccedil&atildeo encontrada.";
			else if( $qtd == 1 )
				echo "Uma grava&ccedil&atildeo encontrada.";
			else
				echo  "".$qtd." grava&ccedil&otildees encontradas.";
            ?>





                        <?php
                        if( $qtd > QTD_MAX_LIGACOES_EXIBIDAS )
                        {
                        	echo "<br/>";
                        	echo "ATEN&Ccedil&AtildeO: Exibi&ccedil&atildeo limitada a ".QTD_MAX_LIGACOES_EXIBIDAS." grava&ccedil&otildees. Refine sua pesquisa";
                        }
                        ?>
                    </h3>
					<br />
					
					                <table id='table_ouvir'>
                                    	<tr>
                                    		<th></th>
                                    		<th>Ramal</th>
	                                    	<th>In&iacutecio</th>
	                                    	<th>Dura&ccedil&atildeo</th>
	                                    	<th>Tipo</th>
	                                    	<th>Telefone</th>
	                                    	<th>Coment&aacuterios</th>
 	                                    	<?php
 	                                    	if( $opc_04 == 1 )
 	                                    		echo "<th></th>";
 	                                   		if( $opc_03 == 1 )
 	                                   			echo "<th></th>";
 	                                   		if( $opc_05 == 1 )
 	                                   			echo "<th></th>";
 	                                    	?>
                                    	</tr>
                                    	<tbody>
                                    			<?php
                                    				$count = 0;
                                    				
                                    				while( ( $stmt->fetch() ) && ( $count < QTD_MAX_LIGACOES_EXIBIDAS ) )
                                    				{
                                    					$count++;
                                    					
                                    					//$duracao = ( strtotime( $horafim ) - strtotime( $horaini ) );
					//AQUI AQUI MHS MHS ...
					//$hor_gasto = intval( $duracao / 3600 );
					//$duracao = $duracao - ( 60 * $hor_gasto );
					//$min_gasto = intval( $duracao / 60 );
					//$seg_gasto = $duracao - ( 60 * $min_gasto );
                                    					
                                    					$aux  = explode(" ",$horaini );
                                    					$data = explode("-",$aux[0]  );
                                    					$hora = explode(":",$aux[1]  );
                                    					
                                    					$namefile = str_replace("/media/storage","audios", $namefile );
                                    					
                                    					echo "<tr>";
                                    					echo "<td><a href='#' data-src='".$namefile."'><img src='images/icone_ouvir.jpg' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					echo "<td>".$estacao."</td>";
                                    					echo "<td>".$data[2]."/".$data[1]."/".$data[0]." ".$hora[0].":".$hora[1].":".$hora[2]."</td>";
					//echo "<td>".sprintf( "%02d", $hor_gasto).":".sprintf( "%02d", $min_gasto ).":".sprintf( "%02d", $seg_gasto )."</td>";
					echo "<td>".$duracao."</td>";
                                    					echo "<td>".$tipo."</td>";
                                    					echo "<td>".$telefone."</td>";
                                    					
                                    					if( $opc_06 == 1 )
                                    					{
															if( strlen( $coment ) > 0 )
	                                    						echo "<td><a href='javascript:abrirJanela(\"form_notes.php?id=".$codigo."\", 650, 400);'>".$coment."</a></td>";
	                                    					else
	                                    						echo "<td><a href='javascript:abrirJanela(\"form_notes.php?id=".$codigo."\", 650, 400);'><img src='images/icone_editar.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					}
                                    					else
                                    					{
                                    						echo "<td>".$coment."</td>";
                                    					}
                                    					
                                    						
                                    					if( $opc_04 == 1 )
                                    						echo "<td><a href='process.php?tipo=download&id=".$codigo."'><img src='images/icone_download.png' width='16' border='0' alt='logo' style='height: 16px' /></a></td>";
                                    					if( $opc_03 == 1 )
                                    						echo "<td><a href='javascript:abrirJanela(\"form_excluir.php?id=".$codigo."\", 400, 200);'><img src='images/icone_excluir.png' width='16' border='0' alt='logo' style='height: 16px' /></td>";
                           								if( $opc_05 == 1 )
                           									echo "<td><a href='javascript:abrirJanela(\"form_email.php?id=".$codigo."\", 650, 500);'><img src='images/icone_email.png' width='16' border='0' alt='logo' style='height: 16px' /></td>";
                                    					
                                    					echo "</tr>";
                                    				}
                                    			?>
                                    	</tbody>
                                    </table>
                      </div>
                      
                      <h3> </h3>
					<form method='post' action='process.php?tipo=export'>
		<br />
		
					<input type='hidden' value="<?php echo $SqlStr;?>" name='sqlstr' />
		
		<input type='submit' <?php if($qtd == 0) {?> disabled="disabled" <?php } ?> value='Exportar para Excel' />
					</form>
					
				</div>




