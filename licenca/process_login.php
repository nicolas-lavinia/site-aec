<?php
    include 'functions.php';
    sec_session_start();
    
    if( isset( $_POST['login'], $_POST['senha'] ) )
    { 
        $login = $_POST['login'];
        $senha = $_POST['senha']; // A senha em hash.
       
        if( $handle = fopen( "../.licenca", "r" ) )
        {
        	$serial = fscanf( $handle, "%s %s" );
        	fclose( $handle );
        	
        	require('dbconnlic.php');
       		$query = "SELECT qtd_licencas, id_proprietario FROM devices WHERE serial = '".$serial[1]."'";
       		$stmt = $mysqli->prepare( $query );
       		$stmt->execute();                           // Executa a query preparada.
       		$stmt->store_result();
       		$stmt->bind_result( $qtd_licencas, $id_proprietario );           // obt�m vari�veis do resultado.
       		if( $stmt->fetch() )
       		{
       			if( $id_proprietario != EQP_DEMOSTRACAO )
       			{
       				$query = "SELECT id FROM users WHERE login = '".$login."'";
       				$stmt = $mysqli->prepare( $query );
       				$stmt->execute();
       				$stmt->store_result();
       				$stmt->bind_result( $id_aux );
       				if( $stmt->fetch() )
       				{
       					if( $id_proprietario == $id_aux )
       					{
       						login_oem_user( $login, $senha );
       					}
       				}
       			}
       			else
       			{
       				login_oem_user( $login, $senha );
       			}
       		}
        }
    }
    session_write_close();
    header('Location: index.php');
    exit();
?>