<?php 
	include 'functions.php';
	sec_session_start();
	$status_user = login_check_player();
	require('comum/db_connect.php');

	$senha_invalida = 0;
	
	if( isset( $_POST['login'], $_POST['senha'] ) )
	{
		$login = $_POST['login'];
		$senha = $_POST['senha'];
		
		if( isset( $_POST['alt_senha'] ) )
		{
			$nova_senha1 = $_POST['nova_senha1'];
			$nova_senha2 = $_POST['nova_senha2'];
		
			if( ( strlen ( $nova_senha1 ) > 0 ) || ( strlen ( $nova_senha2 ) > 0 ) )
			{
				if( strcmp( $nova_senha1, $nova_senha2 ) == 0 )
				{
					if( strcmp( $senha, $nova_senha1 ) != 0 )
					{
						$status_user = login_player( $login, $senha, 1 );
						if( $status_user == 1 )
						{
							$_SESSION = array();

							$date = new DateTime();
								
							$_SESSION[ 'f_data_inicial' ]    = $date->format('d/m/Y');
							$_SESSION[ 'f_data_final' ]      = $date->format('d/m/Y');
							$_SESSION[ 'f_hora_inicial' ]    = '';
							$_SESSION[ 'f_hora_final' ]      = '';
							$_SESSION[ 'f_duracao_inicial' ] = '';
							$_SESSION[ 'f_duracao_final' ]   = '';
							$_SESSION[ 'f_iniciadas' ]       = 1;
							$_SESSION[ 'f_recebidas' ]       = 1;
							$_SESSION[ 'f_ramal' ]           = '';
							$_SESSION[ 'f_telefone' ]        = '';
							$_SESSION[ 'f_comentario' ]      = '';
								
							require("comum/db_connect.php");
							$stmt = $mysqli->prepare("SELECT QtdDias FROM cadusu WHERE login = ?");
							$stmt->bind_param('s', $login );
							$stmt->execute();
							$stmt->store_result();
							$stmt->bind_result( $qtd_dias );
							$stmt->fetch();
							if( $qtd_dias != 0 )
							{
								$agora = mktime( date( 'H:i:s m-d-Y' ) );
								$agora += ( $qtd_dias * 24 * 3600 );
								$vence = date( 'Y-m-d H:i:s', $agora );
							}
							else
							{
								$vence = '2099-12-31 23:59:59';
							}
								
							require("comum/db_connect.php");
							$query = "UPDATE cadusu SET Senha='$nova_senha1', ExpiraEm = '$vence' WHERE Login = '$login'";
							$mysqli->query($query);
								
							$status_user = login_player( $login, $nova_senha1, 0 );
						}
						else
						{
							$senha_invalida = 1;
						}
					}
					else
					{
						$senha_invalida = 4;
					}
				}
				else
				{
					$senha_invalida = 3;
				}
			}
			else
			{
				$senha_invalida = 2;
			}
		}
		else
		{
			$status_user = login_player( $login, $senha, 0 );
			if( $status_user == 1 )
			{
				$date = new DateTime();
				
				$_SESSION[ 'f_data_inicial' ]    = $date->format('d/m/Y');;
				$_SESSION[ 'f_data_final' ]      = $date->format('d/m/Y');;
				$_SESSION[ 'f_hora_inicial' ]    = '';
				$_SESSION[ 'f_hora_final' ]      = '';
				$_SESSION[ 'f_duracao_inicial' ] = '';
				$_SESSION[ 'f_duracao_final' ]   = '';
				$_SESSION[ 'f_iniciadas' ]       = 1;
				$_SESSION[ 'f_recebidas' ]       = 1;
				$_SESSION[ 'f_ramal' ]           = '';
				$_SESSION[ 'f_telefone' ]        = '';
				$_SESSION[ 'f_comentario' ]      = '';
			}
			else
			{
				$senha_invalida = 1;
			}
		}
	}
?>

 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<!--  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
        <title>Player Web</title>
        
    	<link href="style/style.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/mask.js"></script>
        <script>	    
	    $(function(){
			masks()
		    })
		    
		function masks(args) {
		    //code
		    $('#f_data_inicial').mask('99/99/9999');
		    $('#f_data_final').mask('99/99/9999');
		    $('#f_hora_inicial').mask('99:99:99');
		    $('#f_hora_final').mask('99:99:99');
		    $('#f_duracao_inicial').mask('99:99:99');
		    $('#f_duracao_final').mask('99:99:99');
		}
	    </script>
    
    	<script>
	    function abrirJanela(pagina, largura, altura) {
			// Definindo centro da tela
			var esquerda = (screen.width - largura)/2;
			var topo = (screen.height - altura)/2;
			
			// Abre a nova janela
			minhaJanela = window.open(pagina,'janela','toolbar=no,location=no,tab=no,status=no,menubar=no,scrollbars=no,resizable=no,directories=no,height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
	    }

	    function Enviar(NomeDoForm) {
	       document.forms[NomeDoForm].submit();
	    }
		</script>
	
	
    	<script src="audiojs/audio.min.js"></script>
	</head>
	
	<body>
        <div class="main">
			<!-- ***************** Header ***************** -->
			<div class="header">
	            <div class="Click">
	                Usu&aacuterio:
	                <?php
	                	if( $status_user == 1 )
	                	{
	                		$id_user = $_SESSION['user_id'];
	                	
	                		$query = "SELECT Login FROM cadusu WHERE CodUsu = ?";
	                		if( $stmt = $mysqli->prepare( $query ) )
	                		{
	                			$stmt->bind_param( 'i', $id_user );
	                			$stmt->execute();                           // Executa a query preparada.
	                			$stmt->store_result();
	                			$stmt->bind_result( $NomeUser );           // obt�m vari�veis do resultado.
	                			if( $stmt->fetch() )
	                				echo $NomeUser;
	                		}
	                	}
	                ?>
		                <br />
		            </div>
		            <div class="search">
                        <?php
						if( $status_user == 1 )
						{
							echo "<form action='process_logout.php' method='post' >";
							echo "<input type='submit' value='Sair'>";
							echo "</form>";
						}
                        ?>

	            </div>
	            <div class="clr">
	            </div>

	            <div class="menu">
	                <div class="logo">
	                    <!-- <a href="Default.aspx">
	                        <img src="images/logo.png" width="323" border="0" alt="logo" style="height: 86px" />
	                    </a> -->
	                    <?php
			               		if( $handle = fopen( ".licenca", "r" ) )
			                	{
				               		fscanf( $handle, "%s %s" );
				                	$proprietario = fscanf( $handle, "%s %s" );
				                	fclose( $handle );

		                			switch( $proprietario[1] )
		                			{
		               				case EQP_DEMOSTRACAO:
	               					case EQP_NEXTTECH:
	               						echo '<img src="images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
	               						break;
	              					case EQP_LEUCOTRON:
	              						echo '<img src="images/logo_leucotron.png" width="323" border="0" alt="logo" style="height: 86px" />';
	              						break;
               						case EQP_INTELBRAS:
               							echo '<img src="images/logo_intelbras.png" width="323" border="0" alt="logo" style="height: 86px" />';
              							break;
		               				}
			               		}
			               		else
			               		{
			                		echo '<img src="../images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
			                	}
		                	?>
		                </div>
		                
		                <div class="clr">
		                </div>
		            </div>
		            <div class="clr">
		            </div>
		        </div>
        
        
        		<div id="slider">
		            <h2>Player WEB - 
		            <?php
					if( $status_user == 1 )
						echo "Pesquisar Grava&ccedil&otildees";
					else
						echo "Login";
					?>
		            </h2>
		            <div class="clr">
		            </div>
		        </div>
		        <div class="clr">
		        </div>
        
				<!-- ***************** Corpo Principal ***************** -->
			<div class="body">
	            <div class="body_resize">
	                <div class="clr">
	                </div>
					<?php
						if( $status_user == 1 )
							include "spg_gravacoes.php";
						else
							include "spg_login.php";
					?>
	                <div class="clr">
	                </div>
	            </div>
	        </div>
	        <div class="clr">
	        </div>
	    </div>
	</body>
</html>


