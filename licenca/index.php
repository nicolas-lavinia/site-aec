<?php 
	include 'functions.php';
	sec_session_start();
	$status_user = login_check();
 	require('dbconnlic.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
        <title>Licen&ccedilas</title>
        <link href="../style/style.css" rel="stylesheet" type="text/css" />
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
		                		$id_user = $_SESSION['oem_user_id'];
		                	
		                		$query = "SELECT nome FROM users WHERE id = ?";
		                		if( $stmt = $mysqli->prepare( $query ) )
		                		{
		                			$stmt->bind_param( 'i', $id_user );
		                			$stmt->execute();                           // Executa a query preparada.
		                			$stmt->store_result();
		                			$stmt->bind_result( $NomeUser );           // obt�m vari�veis do resultado.
		                			if( $stmt->fetch() )
		                				echo $NomeUser;
		                		}
		                		echo "<form action='process_logout.php' method='post' >";
		                		echo "<input type='submit' value='Sair'>";
		                		echo "</form>";
		                	}
		                ?>
		                <br />
		            </div>
		            <div class="search">
		                <br />
		            </div>
		            <div class="clr">
		            </div>

		            <div class="menu">
		                <div class="logo">
		                    <?php
		                    	if( $status_user == 1 )
			                	{
			                		switch( $id_user )
			                		{
			                		case EQP_DEMOSTRACAO:
		                			case EQP_NEXTTECH:
		                				echo '<img src="../images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
		                				break;
	                				case EQP_LEUCOTRON:
	                					echo '<img src="../images/logo_leucotron.png" width="323" border="0" alt="logo" style="height: 86px" />';
	                					break;
                					case EQP_INTELBRAS:
                						echo '<img src="../images/logo_intelbras.png" width="323" border="0" alt="logo" style="height: 86px" />';
                						break;
			                		}
			                	}
			                	else
			                	{
			                		if( $handle = fopen( "../.licenca", "r" ) )
			                		{
				                		$serial = fscanf( $handle, "%s %s" );
				                		fclose( $handle );

			                			require('dbconnlic.php');
			                			$query = "SELECT id_proprietario FROM devices WHERE serial = '".$serial[1]."'";
			                			$stmt = $mysqli->prepare( $query );
			                			$stmt->execute();                           // Executa a query preparada.
			                			$stmt->store_result();
			                			$stmt->bind_result( $id_proprietario );           // obt�m vari�veis do resultado.
			                			if( $stmt->fetch() )
			                			{
			                				switch( $id_proprietario )
			                				{
		                					case EQP_DEMOSTRACAO:
	                						case EQP_NEXTTECH:
	                							echo '<img src="../images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
	                							break;
	                						case EQP_LEUCOTRON:
	                							echo '<img src="../images/logo_leucotron.png" width="323" border="0" alt="logo" style="height: 86px" />';
	                							break;
                							case EQP_INTELBRAS:
                								echo '<img src="../images/logo_intelbras.png" width="323" border="0" alt="logo" style="height: 86px" />';
                								break;
			                				}
			                			}
			                			else
			                			{
			                				echo '<img src="../images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
			                			}
			                		}
			                		else
			                		{
			                			echo '<img src="../images/logo_nexttech.png" width="323" border="0" alt="logo" style="height: 86px" />';
			                		}
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
		            <h2>
		        		<?php
						if( $status_user == 1 )
							echo "Gerenciador de Licen&ccedilas";
						else
							echo "Gerenciador de Licen&ccedilas - Login";
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
									include "spg_default.php";
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


