<?php 
	include 'functions.php';
	sec_session_start();
	$status_user = login_check_config();
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
						$status_user = login_config( $login, $senha, 1 );
						if( $status_user == 1 )
						{
							$_SESSION = array();
			
							require("../comum/db_connect.php");
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
								
							require("../comum/db_connect.php");
							$query = "UPDATE cadusu SET Senha='$nova_senha1', ExpiraEm = '$vence' WHERE Login = '$login'";
							$mysqli->query($query);
			
							$status_user = login_config( $login, $nova_senha1, 0 );
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
			$status_user = login_config( $login, $senha, 0 );
			if( $status_user != 1 )
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
        <title>Gravador VoIP</title>
        
    <link href="style/style.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/mask.js"></script>
        <script>	    
	    $(function(){
			masks()
		    })
		    
		function masks(args) {
		    //code
		    $('#aj_data').mask('99/99/9999');
		    $('#aj_hora').mask('99:99:99');
		}
	    </script>
	    
        <script>
        function abrirJanela(pagina, largura, altura) {
				// Definindo centro da tela
				var esquerda = (screen.width - largura)/2;
				var topo = (screen.height - altura)/2;
				
				// Abre a nova janela
				minhaJanela = window.open(pagina,'toolbar=no,location=no,tab=no,status=no,menubar=no,scrollbars=no,resizable=no','height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
		    }
        </script>
        
        <script>
        function SetOpc(num1, num2) {
				if( document.getElementById( 'opc_'+num1 ).checked == true )
					document.getElementById( 'opc_'+num2 ).checked = true;
			}
        </script>
	</head>
	
	<body>
	<?php
		$page = @$_GET["p"];
	?>
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

            <div class="clr"></div>
		            <div class="menu">
		                <div class="logo">
		                	<img src="images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />
		                </div>
		                <?php
		                if( $status_user == 1 )
		                {
		                ?>
		                <ul class="menu-list" >
                    <li>
                        <a href="?p=config" <?php if(($page=='config')||($page=='perfil')||($page=='users')||($page=='grupos'))echo "class='active'"; ?>>
                            <span>Configura&ccedil&atildeo</span>
                        </a>
                    </li>
                    <li>
                        <a href="?p=formato" <?php if($page=='formato')echo "class='active'"; ?>>
                            <span>&Aacuteudio</span>
                        </a>
                    </li>
                    <li>
                        <a href="?p=identificacao" <?php if($page=='identificacao')echo "class='active'"; ?>>
                            <span>Identifica&ccedil&atildeo</span>
                        </a>
                    </li>
                    <li>
                        <a href="?p=net" <?php if($page=='net')echo "class='active'"; ?>>
                            <span>Conex&atildeo</span>
                        </a>
                    </li>
		                </ul>
		                <?php
		                }
		                ?>
                <div class="clr"></div>
		                </div>
            <div class="clr"></div>
		        </div>
        
        
        		<div id="slider">
		            <h2>
		            
        		<?php
				$page = @$_GET["p"];
				
				if( $status_user == 1 )
				{
					switch( $page )
					{
						case 'config':
							echo "Configura&ccedil&atildeo";
							break;
						case 'net':
							echo "Rede";
							break;
						case 'identificacao':
							echo "Identifica&ccedil&atildeo de Ramais";
							break;
						case 'formato':
							echo "&Aacuteudio";
							break;

						case 'perfil':
							echo "Configurar - Perfis de Acesso";
							break;
						case 'users':
							echo "Configurar - Usu&aacuterios";
							break;
						case 'grupos':
							echo "Configurar - Grupos de Ramais";
							break;
						case 'email':
							echo "Configurar - Servidor de e-mail";
							break;
						case 'data':
							echo "Configurar - Data / Hora";
							break;
						default:
							echo "Bem-vindo";
							break;
					}
				}
				else
				{
					echo "Login";
				}
				?>
		        
		            </h2>
            <div class="clr"></div>
		            </div>
        <div class="clr"></div>
        
				<!-- ***************** Corpo Principal ***************** -->
				<div class="body">
		            <div class="body_resize">
                <div class="clr"></div>
                
			<?php
				//$page = "perfil"; //@$_GET["p"];
			
				if( $status_user == 1 )
				{
					switch( $page )
					{
					case 'config':
						include 'spg_config.php';
						break;
					case 'net':
						include "spg_net.php";
						break;
					case 'identificacao':
						include "spg_identificacao.php";
						break;
					case 'formato':
						include "spg_formato.php";
						break;
					case 'perfil':
						include "spg_perfil.php";
						break;
					case 'users':
						include "spg_users.php";
						break;
					case 'grupos':
						include "spg_grupos.php";
						break;
					case 'email':
						include "spg_email.php";
						break;
					case 'data':
						include "spg_data.php";
						break;
							
					default:
						include "spg_default.php";
						break;
					}
				}
				else
				{
					include "spg_login.php";
				}
			?>
                <div class="clr"></div>
		                </div>
		            </div>
        <div class="clr"></div>
		    </div>
	</body>
</html>


