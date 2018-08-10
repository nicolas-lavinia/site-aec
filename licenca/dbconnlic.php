<?php
	// Banco de dados no servidor Vivibe para uso pelo Marcelo
    define("HOST_LICENCA", "licencasvoip.mysql.dbaas.com.br"); // O host no qual voc� deseja se conectar.
    define("USER_LICENCA", "licencasvoip"); // O nome de usu�rio do banco de dados.
    define("PASSWORD_LICENCA", "M486Fo66"); // A senha do usu�rio do banco de dados.
    define("DATABASE_LICENCA", "licencasvoip"); // O nome do banco de dados.
    
    $mysqli = new mysqli(HOST_LICENCA, USER_LICENCA, PASSWORD_LICENCA, DATABASE_LICENCA);
?>
