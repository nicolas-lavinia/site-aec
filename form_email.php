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
        <title>Enviar e-mail</title>
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
	        .style3
	        {
	        	font-size:12px;
	        	height: 22px;
	            width: 150px;
	            text-align: left;
	            font-weight:bold;
	            border: none !important;
	        }
	    </style>
    </head>
    <body>

    	<form method='post' action='process.php?tipo=email'>
    
	    <?php
		    $id = @$_GET["id"];
			echo "<p><input type='hidden' value='".$id."' name='id'/></p>";
		?>
		
		<table class="style1">
                                    	
			<tr>
				<td class="style2">
					Para:
				</td>
				<td class="style2">
					<input type='text' name='para' size=35 maxlength=128 />
				</td>
			</tr>
			<tr>
				<td class="style2">
					Cc:
				</td>
				<td class="style2">
					<input type='text' name='cc' size=35 maxlength=128 />
				</td>
			</tr>
			<tr>
				<td class="style2">
					Cco:
				</td>
				<td class="style2">
					<input type='text' name='cco' size=35 maxlength=128 />
				</td>
			</tr>
			<tr>
				<td class="style2">
					Assunto:
				</td>
				<td class="style2">
					<input type='text' name='txt_assunto' size=35 maxlength=128 />
				</td>
			</tr>
		</table>
          
        <table class="style1">
			<tr>
				<td class="style3">
					Mensagem do e-mail:
				</td>
			</tr>
		</table>
		<span class="style1"><textarea type='text' rows='10' cols='60' name='txt_corpo' /></textarea></span>
		
		<table class="style1">
			<tr>
				<td class="style3">
					<input type='submit' value='Enviar'/>
				</td>
			</tr>
		</table>

		</form>

    </body>
</html>