<?php
	// Banco de dados na Raspberry
//  	define("HOST", "localhost"); // O host no qual voc� deseja se conectar.
//  	define("USER", "root"); // O nome de usu�rio do banco de dados.
//  	define("PASSWORD", "master"); // A senha do usu�rio do banco de dados.
//  	define("DATABASE", "Next"); // O nome do banco de dados.

	// Banco de dados interno no MAC para desenvolvimento
   define("HOST", "localhost"); // O host no qual voc� deseja se conectar.
   define("USER", "root"); // O nome de usu�rio do banco de dados.
   define("PASSWORD", "n32c134L"); // A senha do usu�rio do banco de dados.
   define("DATABASE", "Next"); // O nome do banco de dados.
    
//     // Banco de dados no servidor Vivibe para uso pelo Marcelo
//     //servidor: nextvoip.mysql.dbaas.com.br
//     // usuario: nextvoip
//     define("HOST", "nextvoip.mysql.dbaas.com.br"); // O host no qual voc� deseja se conectar.
//     define("USER", "nextvoip"); // O nome de usu�rio do banco de dados.
//     define("PASSWORD", "n32c134L"); // A senha do usu�rio do banco de dados.
//     define("DATABASE", "nextvoip"); // O nome do banco de dados.
    
    
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
?>
