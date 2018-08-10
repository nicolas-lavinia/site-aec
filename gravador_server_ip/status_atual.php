<?php
    $id = @$_GET["id"];
    require("db_connect.php");
    $query = "SELECT status FROM gravadores INNER JOIN processo ON processo.id_grv = gravadores.id INNER JOIN status_grv ON processo.id_status = status_grv.id WHERE gravadores.id = ?";                              
    if( $stmt = $mysqli->prepare( $query ) )
    {
	$stmt->bind_param( 'i', $id );
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $status );
	$stmt->fetch();
	echo $status;
    }
?>

