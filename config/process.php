<?php
	$tipo = @$_GET["tipo"];
    $link = @$_GET["link"];
    include "functions.php";
    require("../comum/db_connect.php");
    
    switch( $tipo )
    {
    case 'edit':
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
    	{
    		return;
    	}
    		
    	$query = "SELECT NomeFile FROM gravacao WHERE Codigo = ?";
    	if( $stmt = $mysqli->prepare( $query ) )
    	{
    		$stmt->bind_param('i', $id );
    		$stmt->execute();
    		$stmt->store_result();
    		$stmt->bind_result( $namefile );
    		if( $stmt->fetch() )
    		{
    				//     		const IMG_LOC = "/media/storage";
    				
    			$path     = realpath( $namefile );
    				//     		if (0 !== strpos($path, IMG_LOC)) {
    				//     			return;
    				//     		}
    				//     		if (!is_readable($filename)) {
    				//     			return;
    				//     		}
    				
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
