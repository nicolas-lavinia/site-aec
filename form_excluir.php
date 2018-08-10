<?php
	include 'functions.php';
	sec_session_start();
	$status_user = login_check_player();
	require('comum/db_connect.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">
    <head>
        <meta content="text/html; charset=iso-8859-1" http-equiv="content-type" />
        <title>Excluir arquivo</title>
        <link href="style/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
	        .style1
	        {
	        	padding: 10px;
	        	font-family: Arial, Helvetica, sans-serif;
	        	width: 62px;
	        	border: none !important;
	            width: 100%;
	            text-align: right;
	        }
	        .style2
	        {
	        	font-size:12px;
	        	height: 22px;
	            width: 50px;
	            text-align: left;
	            font-weight:bold;
	            border: none !important;
	        }
	    </style>
    </head>
    <body>
        <?php
		$id = @$_GET["id"];
		?>
		
		<form method='post' action='process.php?tipo=delete&link=arquivo_audio'>
		
		<input type='hidden' value='<?php echo $id;?>' name='id'/>
	    
	    <table class="style1">                  	
			<tr>
				<td class="style2" colspan=2>
					Confirma exclus&atildeo?
				</td>
			</tr>
			<tr>
				<td class="style2" colspan=2>
				</td>
			</tr>
			<tr>
				<td class="style2">
					<input type='reset' value='Cancelar' onclick='window.close();'/>
				</td>
				<td class="style2">
					<input type='submit' value='Confirma'/>
				</td>
			</tr>
		</table>
		
	    </form>
	    
    </body>
</html>