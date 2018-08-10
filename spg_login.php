	<script>
    	function Mudarestado() {
        	var display = document.getElementById('nova_senha1').style.visibility;
            document.getElementById('v_nova_senha1').value = '';
            document.getElementById('v_nova_senha2').value = '';

            if(display == "hidden")
            {
            	document.getElementById('nova_senha1').style.visibility = 'visible';
            	document.getElementById('nova_senha2').style.visibility = 'visible';
            }
            else
            {
            	document.getElementById('nova_senha1').style.visibility = 'hidden';
            	document.getElementById('nova_senha2').style.visibility = 'hidden';
            }
        }
    </script>
              
	<style type="text/css">
        .style2
        {
            width: 80px;
        }
        .style3
        {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            font-size: small;
        }
	</style>
				
				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">
                    <p>
                        <br />
                    </p>
				</div>
				
				
				<!-- ***************** Lado Direito ***************** -->
				<div class="right">
						
					<h3>
                        Identifique-se
                    </h3>
					
					<br />
						
					<form method='post' >
					
						<table>
							<tr>
								<td class="style2">
                                    <span class="style3">Usu&aacuterio</span>
                                </td>
								<td class="style2">
                                    <span class="style3"><input type='text' name='login' maxlength=8 style="width:150px;"/></span>
                                </td>
							</tr>
							<tr>
								<td class="style2">
                                    <span class="style3">Senha</span>
                                </td>
								<td class="style2">
                                    <span class="style3"><input type='password' name='senha' maxlength=8 style="width:150px;" /></span>
                                </td>
							</tr>
							<tr>
                                <td class="style2">
                                </td>
                                <td class="style2" style="width:150px;" colspan=2>
                                	<span class="style3"><input type="checkbox" name="alt_senha" onclick="Mudarestado()"> Alterar Senha</span>
                                </td>
                            </tr>
                            
							<tr id="nova_senha1" style="visibility:hidden;">
								<td class="style2">
                                    <span class="style3">Nova Senha</span>
                                </td>
								<td class="style2">
                                    <span class="style3"><input type='password' name='nova_senha1' id='v_nova_senha1' maxlength=10 /></span>
                                </td>
							</tr>
							<tr id="nova_senha2" style="visibility:hidden;">
								<td class="style2">
                                    <span class="style3">Confirme</span>
                                </td>
								<td class="style2">
                                    <span class="style3"><input type='password' name='nova_senha2' id='v_nova_senha2' maxlength=10 /></span>
                                </td>
							</tr>
							<tr>
                                <td class="style2">

                                </td>
                                <td>
                                    <input type='submit' value='Login' >
                                </td>
                            </tr>
						</table>
					</form>
				</div>
				
				<?php
				if( $senha_invalida == 1 ) {
					echo '<script type="text/javascript">alert( "Usuário ou Senha Inválida!" );</script>';
				}
				else if( $senha_invalida == 2 ) {
					echo '<script type="text/javascript">alert( "Nova senha inválida!" );</script>';
				}
				else if( $senha_invalida == 3 ) {
					echo '<script type="text/javascript">alert( "Falha na verificação da nova senha! Utilize entre 1 e 8 dígitos." );</script>';
				}
				else if( $senha_invalida == 4 ) {
					echo '<script type="text/javascript">alert( "A nova senha deve ser diferente da atual!" );</script>';
				}
				?>
