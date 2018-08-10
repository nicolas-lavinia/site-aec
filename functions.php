<?php
	include "comum/constantes.php";
	
    // ********************************************************************
    // ********************** login seguro ********************************
    // ********************************************************************
    function sec_session_start()
    {
        $session_name = 'sec_session_id'; // Define um nome padrão de sessão
        
        if($_SERVER["HTTPS"] != "on")
            $secure = false; // Defina como true (verdadeiro) caso esteja utilizando https.
        else
            $secure = true; // Defina como true (verdadeiro) caso esteja utilizando https.
            
        $httponly = true; // Isto impede que o javascript seja capaz de acessar a id de sessão. 
 
        ini_set('session.use_only_cookies', 1); // Força as sessões a apenas utilizarem cookies. 
        $cookieParams = session_get_cookie_params(); // Recebe os parâmetros atuais dos cookies.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        //session_set_cookie_params( ( 10 * 60 ), $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Define o nome da sessão como sendo o acima definido.
        session_start(); // Inicia a sessão php.
        $_SESSION["qtd_loads"]++;
        if( $_SESSION["qtd_loads"] >= 10 )
        {
            $_SESSION["qtd_loads"] = 0;
            session_regenerate_id(true); // regenerada a sessão, deleta a outra.
        }
    }
    
    // **************************
    // **************************
    // **************************
    // **************************
    // **************************
    
    function login_player( $login, $password, $ignora_data )
    {
        require('comum/db_connect.php');
        // utilizar declarações preparadas significa que a injeção de código SQL não será possível. 
        if ($stmt = $mysqli->prepare("SELECT CodUsu, Senha, CodPerfil, QtdDias, ExpiraEm, Ativo FROM cadusu WHERE Login = ? LIMIT 1"))
        { 
            $stmt->bind_param('s', $login ); // Vincula "$email" ao parâmetro.
            $stmt->execute(); // Executa a query preparada.
            $stmt->store_result();
            $stmt->bind_result( $user_id, $db_password, $CodPerfil, $qtd_dias, $expira, $status_user ); // obtém variáveis do resultado.
            $stmt->fetch();
            if( $stmt->num_rows == 1 )
            {   // se o usuário existe
                $_SESSION['user_id'] = $user_id;
                
                if( ( $db_password == $password ) && ( $status_user == 1 ) )
                { // Checa se a senha na base de dados confere com a senha que o usuário digitou. 
                  // Senha está correta!
                	
                	date_default_timezone_set('America/Sao_Paulo');
                	$agora = date( 'Y-m-d H:i:s' );
                	 
                	if( ( ( $qtd_dias != 0 ) && ( $agora < $expira ) ) || ( $qtd_dias == 0 ) || ( $ignora_data == 1 ) )
                	{
	                	if ($stmt = $mysqli->prepare("SELECT opc_02 FROM perfil WHERE CodPerfil = ? LIMIT 1"))
	                	{
	                		$stmt->bind_param('i', $CodPerfil );
	                		$stmt->execute();
	                		$stmt->store_result();
	                		$stmt->bind_result( $opc_02 ); // obtém variáveis do resultado.
	                		if( $stmt->fetch() )
	                		{
								if( $opc_02 == 1 )
								{
									$ip_address = $_SERVER['REMOTE_ADDR']; // Pega o endereço IP do usuário.
									$user_browser = $_SERVER['HTTP_USER_AGENT']; // Pega a string de agente do usuário.
									
									$user_id = preg_replace("/[^0-9]+/", "", $user_id); // Proteção XSS conforme poderíamos imprimir este valor
									$app = 'player';
									//$_SESSION['user_id'] = $user_id;
									//$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // Proteção XSS conforme poderíamos imprimir este valor
									//$_SESSION['username'] = $username;
									$_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser.$app);
									// Login com sucesso.
	
									$query = "UPDATE cadusu SET UltLogin='$agora' WHERE CodUsu = '$user_id'";
									$mysqli->query($query);
									
									$stmt->close();     // fecha a declaração
									$mysqli->close();   // fecha a conexão
									return( $status_user );
								}
	                		}
                		}
                	}
                }
            }
        }
        return( -1 );
    }
    

    // **************************
    // **************************
    // **************************
    // **************************
    // **************************
    // Usada para verificar se usuário está logado
    
    function login_check_player( )
    {
        // Verifica se todas as variáveis das sessões foram definidas
        if(isset($_SESSION['user_id'], $_SESSION['login_string']))
        {
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            //$username = $_SESSION['username'];
            $ip_address = $_SERVER['REMOTE_ADDR']; // Pega o endereço IP do usuário 
            $user_browser = $_SERVER['HTTP_USER_AGENT']; // Pega a string do usuário.
            
            require('comum/db_connect.php');
            if ($stmt = $mysqli->prepare("SELECT Senha, CodPerfil, QtdDias, ExpiraEm, Ativo FROM cadusu WHERE CodUsu = ? LIMIT 1"))
            { 
                $stmt->bind_param('i', $user_id ); // Atribui "$user_id" ao parâmetro
                $stmt->execute(); // Executa a tarefa atribuía
                $stmt->store_result();
                
                if($stmt->num_rows == 1)
                {   // Caso o usuário exista
                    $stmt->bind_result($password, $CodPerfil, $qtd_dias, $expira, $status_user ); // pega variáveis a partir do resultado
                    $stmt->fetch();
                    $app = 'player';
                    $login_check = hash('sha512', $password.$ip_address.$user_browser.$app);
                    
                    date_default_timezone_set('America/Sao_Paulo');
                    $agora = date( 'Y-m-d H:i:s' );
                     
                     if( ( $login_check == $login_string ) && ( $status_user == 1 ) && ( ( ( $qtd_dias != 0 ) && ( $agora < $expira ) ) || ( $qtd_dias == 0 ) ) )
                    {
                    	if ($stmt = $mysqli->prepare("SELECT opc_02 FROM perfil WHERE CodPerfil = ? LIMIT 1"))
                    	{
                    		$stmt->bind_param('i', $CodPerfil );
                    		$stmt->execute();
                    		$stmt->store_result();
                    		$stmt->bind_result( $opc_02 ); // obtém variáveis do resultado.
                    		if( $stmt->fetch() )
                    		{
                    			if( $opc_02 == 1 )
                    			{
	                    			// Logado!!!
	                    			$stmt->close();     // fecha a declaração
	                    			$mysqli->close();   // fecha a conexão
	                    			return( $status_user );
                    			}
                    		}
                    	}
                    }
                }
                // Não foi logado
                $stmt->close();     // fecha a declaração
                $mysqli->close();   // fecha a conexão
                return false;
            }
            else
            {
                // Não foi logado
                $mysqli->close();   // fecha a conexão
                return false;
            }
        }
        else
        {
            // Não foi logado
            return false;
        }
    }
    
    
    // **************************
    // **************************
    // **************************
    // **************************
    // **************************


    
?>