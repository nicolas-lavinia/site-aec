<?php
// **************************
// **************************
// **************************
// **************************
// **************************

function sendmail( $id, $destino, $cc, $cco, $assunto, $texto )
{
	// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
	require("phpmailer/class.phpmailer.php");
	require("phpmailer/class.smtp.php");
	 
	require("comum/db_connect.php");
	$query = "SELECT email, servidor, porta, nome, usuario, senha FROM email WHERE id = 1";
	$stmt = $mysqli->prepare( $query );
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $email, $servidor, $porta, $nome, $usuario, $senha );
	$stmt->fetch();
	
	
	// Inicia a classe PHPMailer
	$mail = new PHPMailer();
	 
	// Define os dados do servidor e tipo de conexão
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->SMTPDebug = 0;
	$mail->IsSMTP(); 								// Define que a mensagem será SMTP
	 
	$mail->Host = $servidor;						// Endereço do servidor SMTP
	$mail->Port = $porta;                  			// set the SMTP port
	$mail->SMTPAuth = true; 						// Usa autenticação SMTP? (opcional)
	//    						$Email->SMTPSecure = "ssl";
	 
	$mail->Username = $usuario;						// Usuário do servidor SMTP
	$mail->Password = $senha;	 					// Senha do servidor SMTP
	 
	// Define o remetente
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->From = $email;							// Seu e-mail
	$nome = trim(preg_replace('/[\r\n]+/', '', $nome)); //Strip breaks and trim
	$mail->FromName = $nome;						// Seu nome
	
	// Define os destinatário(s)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->AddAddress( $destino );
	if( strlen ( $cc ) > 0 )
		$mail->AddCC( $cc );						// Copia
	if( strlen ( $cco ) > 0 )
		$mail->AddBCC( $cco );						// Copia Oculta
			
	// Define os dados técnicos da Mensagem
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->IsHTML(true);        // Define que o e-mail será enviado como HTML
	$mail->CharSet = 'UTF-8';   // Charset da mensagem (opcional)
	$mail->MsgHTML( mb_convert_encoding( $texto, 'UTF-8') );

	// Define a mensagem (Texto e Assunto)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$mail->Subject  = mb_convert_encoding($assunto, 'UTF-8'); // Assunto da mensagem
	//$mail->Body  = $texto;
	//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n <img src="http://i2.wp.com/blog.thiagobelem.net/wp-includes/images/smilies/icon_smile.gif?w=625" alt=":)" class="wp-smiley" height="15" width="15"> ";
	 
	// Define os anexos (opcional)
	// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	$query = "SELECT NomeFile FROM gravacao WHERE Codigo = ".$id;
	$stmt = $mysqli->prepare( $query );
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $path );
	$stmt->fetch();
	
	$namefile = str_replace("/media/storage","audios", $path );
	
	$mail->AddAttachment( $namefile ); //, "novo_nome.pdf");  // Insere um anexo
	 
	// Envia o e-mail
	$enviado = $mail->Send();
	 
	// Limpa os destinatários e os anexos
	$mail->ClearAllRecipients();
	$mail->ClearAttachments();
	 
	// Exibe uma mensagem de resultado
	if ($enviado)
	{
		return( 1 );
	}
	else
	{
		echo "Não foi possível enviar o e-mail.<br /><br />";
		return( "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo );
		//return( $mail->ErrorInfo );
	}
}

// **************************
// **************************
// **************************
// **************************
// **************************

	$tipo = @$_GET["tipo"];
    $link = @$_GET["link"];
    require("comum/db_connect.php");
    require("comum/constantes.php");

//     if( ( $tipo != 'download' ) && ( $tipo != 'export' ) )
//     {
//     	echo "<script>";
//     	echo "function Refresh( arq ) {";
//     	echo "window.opener.location.href = arq;";
//     	echo "}";
    
//     	echo "function CloseWindow( arq ) {";
//     	echo "Refresh( arq );";
//     	echo "window.close();";
//     	echo "}";
//     	echo "</script>";
//     }
    
    switch( $tipo )
    {
    case 'edit':
		switch( $link )
		{
    	case 'comentario':
    		$id = $_POST['id'];
   			$notes = $_POST['notes'];
   			
    		$query = "UPDATE gravacao SET Coment='$notes' WHERE Codigo = '$id'";
    		$mysqli->query($query);
   			echo "<script>CloseWindow( 'index.php' )</script>";
   			break;
   			
   			case 'grv':
   				$id = $_POST['id'];
   				$grv_enable = $_POST['grv_enable'];
   				$server_ip = $_POST['server_ip'];
   				$server_port = $_POST['server_port'];
   				$local_port = $_POST['local_port'];
   				$diretorio = $_POST['diretorio'];
   				$nome1 = $_POST['nome1'];
   				$nome2 = $_POST['nome2'];
   				$nome3 = $_POST['nome3'];
   				$nome4 = $_POST['nome4'];
   				$nome5 = $_POST['nome5'];
   				$nome6 = $_POST['nome6'];
   				$nome7 = $_POST['nome7'];
   				$nome8 = $_POST['nome8'];
   			
   			
   				$query = "UPDATE gravadores SET grv_enable='$grv_enable', server_ip='$server_ip', server_port='$server_port', local_port='$local_port', diretorio='$diretorio', nome1='$nome1', nome2='$nome2', nome3='$nome3', nome4='$nome4', nome5='$nome5', nome6='$nome6', nome7='$nome7', nome8='$nome8' WHERE id = '$id'";
   				$mysqli->query($query);
   			
   				header("Location: index.php");
   				exit();
   				break;
   			
   			case 'perfil':
   				$id = $_POST['id'];
   				$nome = $_POST['nome'];
   			
   				for( $i = 1 ; $i <= 7/*13*/ ; $i++ )
   				{
   					if( $_POST['opc_'.$i] == 'on' )
   						$opc[$i] = 1;
   						else
   							$opc[$i] = 0;
   				}
   			
   				$query = "UPDATE perfil SET NomePerfil='$nome', opc_01='$opc[1]', opc_02='$opc[2]', opc_03='$opc[3]', opc_04='$opc[4]', opc_05='$opc[5]', opc_06='$opc[6]', opc_07='$opc[7]' WHERE CodPerfil = '$id'";
   				$mysqli->query($query);
   				header( "Location: index.php?p=config" );
   				break;
   			
   			case 'user':
   				$id = $_POST['id'];
   				$nome = $_POST['nome'];
   				$login = $_POST['login'];
   				$senha = $_POST['senha'];
   				$CodPerfil =  $_POST['perfil'];
   				$CodGrupo =  $_POST['grupo'];
   				$expira =  $_POST['expira'];
   			
   				if( retorna_num( $expira ) )
   				{
   					if( $expira < 0 )
   						$expira = 0;
   					  
   						// 	    	date_default_timezone_set('America/Sao_Paulo');
   						$data = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$expira, date("Y"));
   						$vencimento = date('Y-m-d H:i:s', $data);
   					  
   						$query = "UPDATE cadusu SET Login='$login', Senha='$senha', NomeUsu='$nome', CodGrupo='$CodGrupo', CodPerfil='$CodPerfil', QtdDias='$expira', ExpiraEm = '$vencimento' WHERE CodUsu = '$id'";
   						$mysqli->query($query);
   				}
   				header( "Location: index.php?p=config" );
   				break;
   			
   			case 'grupo':
   				$id = $_POST['id'];
   				$nome = $_POST['nome'];
   			
   				$query = "UPDATE grupos SET NomeGrupo='$nome' WHERE CodGrupo = '$id'";
   				$mysqli->query($query);
   				header( "Location: index.php?p=config" );
   				break;
   			
   			case 'email':
   				$email = $_POST['email'];
   				$servidor = $_POST['servidor'];
   				$porta = $_POST['porta'];
   				$nome = $_POST['nome'];
   				$usuario = $_POST['usuario'];
   				$senha = $_POST['senha'];
   			
   				if( retorna_num( $porta ) )
   				{
   					$query = "UPDATE email SET email='$email', servidor='$servidor', porta='$porta', nome='$nome', usuario='$usuario', senha='$senha' WHERE id = 1";
   					$mysqli->query($query);
   				}
   			
   				header( "Location: index.php?p=config" );
   				exit();
   				break;
   			
   			case 'data':
   				$data = $_POST['data'];
   				$hora = $_POST['hora'];
   			
   				$aux = explode( "/", $data );
   			
   				$agora = $aux[2]."-".$aux[1]."-".$aux[0]." ".$hora;
   			
   				$query = "UPDATE instalacao SET agora='$agora' WHERE id = 1";
   				$mysqli->query($query);
   			
   				header( "Location: index.php" );
   				exit();
   				break;
		}
		break;
    
    case 'insert':
    	switch( $link )
    	{
    		case 'grv':
    			$id = $_POST['id'];
    			$grv_enable = $_POST['grv_enable'];
    			$server_ip = $_POST['server_ip'];
    			$server_port = $_POST['server_port'];
    			$local_port = $_POST['local_port'];
    			$diretorio = $_POST['diretorio'];
    			$nome1 = $_POST['nome1'];
    			$nome2 = $_POST['nome2'];
    			$nome3 = $_POST['nome3'];
    			$nome4 = $_POST['nome4'];
    			$nome5 = $_POST['nome5'];
    			$nome6 = $_POST['nome6'];
    			$nome7 = $_POST['nome7'];
    			$nome8 = $_POST['nome8'];
    	
    			$query = "INSERT INTO gravadores ( grv_enable, server_ip, server_port, local_port, diretorio, nome1, nome2, nome3, nome4, nome5, nome6, nome7, nome8 ) VALUES ( '$grv_enable', '$server_ip', '$server_port', '$local_port', '$diretorio', '$nome1', '$nome2', '$nome3', '$nome4', '$nome5', '$nome6', '$nome7', '$nome8' )";
    			$mysqli->query($query);
    			$query = "INSERT INTO processo ( id_grv, id_status ) VALUES ( '$id', 1 )";
    			$mysqli->query($query);
    	
    			header("Location: index.php");
    			exit();
    			break;
    	
    		case 'perfil':
    			$nome = $_POST['nome'];
    			if( ( $nome == null ) || ( $nome == "" ) )
    				$nome = "sem nome";
    					
    				for( $i = 1 ; $i <= 7/*13*/ ; $i++ )
    				{
    					if( $_POST['opc_'.$i] == 'on' )
    						$opc[$i] = 1;
    						else
    							$opc[$i] = 0;
    				}
    	
    				// 	    	$query = "INSERT INTO perfil ( NomePerfil, opc_01, opc_02, opc_03, opc_04, opc_05, opc_06, opc_07, opc_08 ,opc_09, opc_10, opc_11, opc_12, opc_13, opc_14, opc_15, opc_16, opc_17, opc_18, opc_19, opc_20, opc_21, opc_22, opc_23, opc_24, opc_25, opc_26, opc_27, opc_28, opc_29, opc_30 ) VALUES ( '$nome', '$opc[1]', '$opc[2]', '$opc[3]', '$opc[4]', '$opc[5]', '$opc[6]', '$opc[7]', '$opc[8]', '$opc[9]', '$opc[10]', '$opc[11]', '$opc[12]', '$opc[13]', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 )";
    				$query = "INSERT INTO perfil ( NomePerfil, opc_01, opc_02, opc_03, opc_04, opc_05, opc_06, opc_07, opc_08 ,opc_09, opc_10, opc_11, opc_12, opc_13, opc_14, opc_15, opc_16, opc_17, opc_18, opc_19, opc_20, opc_21, opc_22, opc_23, opc_24, opc_25, opc_26, opc_27, opc_28, opc_29, opc_30 ) VALUES ( '$nome', '$opc[1]', '$opc[2]', '$opc[3]', '$opc[4]', '$opc[5]', '$opc[6]', '$opc[7]', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 )";
    				$mysqli->query($query);
    				header( "Location: index.php?p=config" );
    				break;
    	
    		case 'user':
    			$nome = $_POST['nome'];
    			$login = $_POST['login'];
    			$senha = $_POST['senha'];
    			$CodPerfil =  $_POST['perfil'];
    			$CodGrupo =  $_POST['grupo'];
    			$expira =  $_POST['expira'];
    	
    			if( retorna_num( $expira ) )
    			{
    				if( $expira < 0 )
    					$expira = 0;
    	
    					$data = mktime(date("H"), date("i"), date("s"), date("m"), date("d")+$expira, date("Y"));
    					$vencimento = date('Y-m-d H:i:s', $data);
    					 
    					$query = "INSERT INTO cadusu ( Login, Senha, NomeUsu, CodGrupo, CodPerfil, QtdDias, Ativo, ExpiraEm, UltLogin ) VALUES ( '$login', '$senha', '$nome', '$CodGrupo', '$CodPerfil', '$expira', 1, '$vencimento', '2001-01-01 01:01:01' )";
    					$mysqli->query($query);
    			}
    			header( "Location: index.php?p=config" );
    			break;
    	
    		case 'grupo':
    			$nome = $_POST['nome'];
    			if( strlen ( $nome ) > 0 )
    			{
    				$query = "INSERT INTO grupos ( NomeGrupo ) VALUES ( '$nome' )";
    				$mysqli->query($query);
    			}
    			header( "Location: index.php?p=config" );
    			break;
    	
    		case 'portagrupo':
    			$CodGrupo = $_POST['id'];
    			$CodPorta = $_POST['porta'];
    	
    			if( $CodPorta == 0 )
    			{
    				$query = "DELETE FROM gruporamal WHERE CodGrupo =".$CodGrupo;
    				$mysqli->query($query);
    			}
    			else
    			{
    				$query = "SELECT CodGrupo FROM gruporamal WHERE CodGrupo = ? AND CodPorta = ?";
    				if( $stmt = $mysqli->prepare( $query ) )
    				{
    					$stmt->bind_param( 'ii', $CodGrupo, $CodPorta );
    					$stmt->execute();
    					$stmt->store_result();
    					if( $stmt->fetch() == 0 )
    					{
    						$query = "INSERT INTO gruporamal ( CodGrupo, CodPorta ) VALUES ( '$CodGrupo', '$CodPorta' )";
    						$mysqli->query($query);
    					}
    				}
    			}
    			header( "Location: index.php?p=grupos&id=".$CodGrupo );
    			break;
    	}
		break;
		
    case 'delete':
    	switch( $link )
    	{
  		case 'arquivo_audio':
  			$id = $_POST['id'];

  			$query = "SELECT NomeFile FROM gravacao WHERE Codigo = ".$id;
  			$stmt = $mysqli->prepare( $query );
  			$stmt->execute();
  			$stmt->store_result();
  			$stmt->bind_result( $namefile );
  			$stmt->fetch();
  			
  			$namefile = str_replace("/media/storage","audios", $namefile );
  			
  			unlink($namefile);
  			
  			$query = "DELETE FROM gravacao WHERE Codigo = ".$id;
  			$mysqli->query($query);
  			
  			echo "<script>CloseWindow( 'index.php' )</script>";
  			break;
  			
  			case 'perfil':
  				$id = $_POST['id'];
  				$query = "DELETE FROM perfil WHERE CodPerfil =".$id;
  				$mysqli->query($query);
  				header( "Location: index.php?p=config" );
  				break;
  				 
  			case 'user':
  				$id = $_POST['id'];
  				$query = "DELETE FROM cadusu WHERE CodUsu =".$id;
  				$mysqli->query($query);
  				header( "Location: index.php?p=config" );
  				break;
  			
  			case 'grupo':
  				$id = $_POST['id'];
  				$query = "DELETE FROM grupos WHERE CodGrupo =".$id;
  				$mysqli->query($query);
  				header( "Location: index.php?p=config" );
  				break;
  					
  			case 'portagrupo':
  				$CodGrupo = @$_GET["CodGrupo"];
  				$CodPorta = @$_GET["CodPorta"];
  			
  				$query = "DELETE FROM gruporamal WHERE CodPorta =".$CodPorta;
  				$mysqli->query($query);
  				header( "Location: index.php?p=grupos&id=".$CodGrupo );
  				break;
  		 }
    
    case download:
    	$id = @$_GET["id"];
    	
    	// validate filename input
    	if (!isset($_GET['id']))
    		return;
    		
    	$query = "SELECT NomeFile FROM gravacao WHERE Codigo = ?";
    	if( $stmt = $mysqli->prepare( $query ) )
    	{
    		$stmt->bind_param('i', $id );
    		$stmt->execute();
    		$stmt->store_result();
    		$stmt->bind_result( $namefile );
    		if( $stmt->fetch() )
    		{
    			$namefile = str_replace("/media/storage","audios", $namefile );
    			$path     = realpath( $namefile );
    			
    			// obtain data
    			$basename  = basename($namefile);
    			$mime_type = "application/octet-stream"; # can be improved later
    			$size      = filesize($path);
    				
    			// output
    			header('Content-Description: File Transfer');
    			header('Content-Type: ' . $mime_type);
    			header('Content-Disposition: attachment; filename=' . $basename);
    			header('Content-Length: ' . $size);
    			readfile($namefile);
    		}
    	}	
    	break;
    	
    case email:
    	$id = $_POST['id'];
    	
    	$para = $_POST['para'];
    	$cc = $_POST['cc'];
    	$cco = $_POST['cco'];
    	
    	$txt_assunto = $_POST['txt_assunto'];
    	$txt_corpo   = $_POST['txt_corpo'];
    	
    	sendmail( $id, $para, $cc, $cco, $txt_assunto, $txt_corpo );
    	
    	echo "<script>CloseWindow( 'index.php' )</script>";
    	break;
    	
    case export:
    	$sqlstr = $_POST['sqlstr'];
    	
    	$agora = date( 'Y-m-d H:i:s' );
    	$arquivo = 'gravacoes_'.$agora.'.xls';
    	
    	$txt_arquivo = '<table border="1">
    	                                    	<tr>
    	                                    		<th>Ramal</th>
    		                                    	<th>Inicio</th>
    		                                    	<th>Duracao</th>
    		                                    	<th>Tipo</th>
    		                                    	<th>Telefone</th>
    		                                    	<th>Comentarios</th>
    	                                    	</tr>
    	                                    	<tbody>';
    	 
    	
    	$stmt = $mysqli->prepare( $sqlstr );
    	$stmt->execute();
    	$stmt->store_result();
   		$qtd = $stmt->num_rows;
   		$stmt->bind_result( $estacao, $horaini, $duracao, $tipo, $telefone, $coment, $namefile, $horafim, $codigo );
   		
   		$count = 0;
		while( ( $stmt->fetch() ) && ( $count < QTD_MAX_LIGACOES_EXIBIDAS ) )
		{
			$count++;
    	            
			//$duracao = ( strtotime( $horafim ) - strtotime( $horaini ) );
			//MHS
    	    //$hor_gasto = intval( $duracao / 3600 );
    	    //$duracao = $duracao - ( 60 * $hor_gasto );
    	    //$min_gasto = intval( $duracao / 60 );
    	    //$seg_gasto = $duracao - ( 60 * $min_gasto );
    	                                    					
    	    $aux  = explode(" ",$horaini );
    	    $data = explode("-",$aux[0]  );
    	    $hora = explode(":",$aux[1]  );
                                					
    	    $txt_arquivo .= "<tr>";
    	    $txt_arquivo .= "<td>".$estacao."</td>";
    	    $txt_arquivo .= "<td>".$data[2]."/".$data[1]."/".$data[0]." ".$hora[0].":".$hora[1].":".$hora[2]."</td>";
    	    //$txt_arquivo .= "<td>".sprintf( "%02d", $hor_gasto).":".sprintf( "%02d", $min_gasto ).":".sprintf( "%02d", $seg_gasto )."</td>";
			$txt_arquivo .= "<td>".$duracao."</td>";
    	    $txt_arquivo .= "<td>".$tipo."</td>";
    	    $txt_arquivo .= "<td>".$telefone."</td>";
    	    $txt_arquivo .= "<td>".$coment."</td>";
    	    $txt_arquivo .= "</tr>";
		}

		$txt_arquivo .= '</tbody></table>';
    		
    	// Configurações header para forçar o download
    	header ("Expires: Mon, 03 Out 2009 15:00:00 GMT");
    	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    	header ("Cache-Control: no-cache, must-revalidate");
    	header ("Pragma: no-cache");
    	header ("Content-type: application/x-msexcel");
    	header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    	header ("Content-Description: PHP Generated Data" );
    	
    	// Envia o conteúdo do arquivo
    	echo $txt_arquivo;

    	//echo "<script>CloseWindow( 'index.php' )</script>";
    	break;
    }
    
?>
<script>
	function carregar()
	{
		window.opener = window;
		window.close();
	}
	
	function Refresh( arq )
	{
		window.opener.location.href = arq;
	}
	
	function CloseWindow( arq )
	{
		Refresh( arq );
		window.close();
	}
</script>

