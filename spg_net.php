				<!-- ***************** Centro ***************** -->
<script type="text/javascript">

	function habilita_a( eth )
	{
		document.getElementById('ip'+eth+'_manual').style.visibility = 'visible';
		document.getElementById('mask'+eth+'_manual').style.visibility = 'visible';
		document.getElementById('gw'+eth+'_manual').style.visibility = 'visible';
		document.getElementById('dns'+eth+'_manual').style.visibility = 'visible';
	
	}
	
	
	function desabilita_a( eth )
	{
		document.getElementById('ip'+eth+'_manual').style.visibility = 'hidden';
		document.getElementById('mask'+eth+'_manual').style.visibility = 'hidden';
		document.getElementById('gw'+eth+'_manual').style.visibility = 'hidden';
		document.getElementById('dns'+eth+'_manual').style.visibility = 'hidden';
	}
	
	var sSecs = 60;
	
	function getSecs()
	{
		sSecs--;
	
		if( sSecs == 0 )
		{
			window.location.replace("process_logout.php");
		}
		else
		{
			clock1.innerHTML=sSecs;
		    setTimeout('getSecs()',1000);
		}
	}
	
</script>

	<style type="text/css">
		div.painel_e
		{
			padding: 5px;
			background: #EEEEEE;
			width: 338px;
		}
        .style1
        {
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
            width: 80px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
	</style>
	
			<?php
				if( isset( $_POST["hostname"] ) )
				{
					$hostname = $_POST[ "hostname" ];
					$dhcp0 = $_POST[ "dhcp0" ];
					$ip0 = $_POST[ "ip0" ];
					$mask0 = $_POST[ "mask0" ];
					$gw0 = $_POST[ "gw0" ];
					$dns0 = $_POST[ "dns0" ];
					
					$query = "UPDATE rede SET hostname='$hostname', dhcp = '$dhcp0', ip='$ip0', mask='$mask0', gw='$gw0', dns='$dns0', up_date = 1 WHERE id = 1";
					$mysqli->query($query);
					
					$dhcp1 = $_POST[ "dhcp1" ];
					$ip1 = $_POST[ "ip1" ];
					$mask1 = $_POST[ "mask1" ];
					$gw1 = $_POST[ "gw1" ];
					$dns1 = $_POST[ "dns1" ];
						
					$query = "UPDATE rede SET hostname='$hostname', dhcp = '$dhcp1', ip='$ip1', mask='$mask1', gw='$gw1', dns='$dns1', up_date = 1 WHERE id = 2";
					$mysqli->query($query);
					
					$restart = 1;
				}
				else
				{
					$restart = 0;
				}
				?>				
				
				
				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left" >
					<p>
                        <br />
                    </p>
				</div>

				<!-- ***************** Lado Direito ***************** -->
				<div class="right" >
						
					<div class="painel_e">	
						<?php 
                                $query = "SELECT mac, hostname, dhcp, ip, mask, gw, dns FROM rede WHERE id = 1";
                                if( $stmt = $mysqli->prepare( $query ) )
                                {
	                                $stmt->execute();                           // Executa a query preparada.
	                                $stmt->store_result();
	                                $stmt->bind_result( $mac0, $hostname, $dhcp0, $ip0, $mask0, $gw0, $dns0 );
	                                $stmt->fetch();
                                }
                                $query = "SELECT mac, hostname, dhcp, ip, mask, gw, dns FROM rede WHERE id = 2";
                                if( $stmt = $mysqli->prepare( $query ) )
                                {
                                	$stmt->execute();                           // Executa a query preparada.
                                	$stmt->store_result();
                                	$stmt->bind_result( $mac1, $hostname, $dhcp1, $ip1, $mask1, $gw1, $dns1 );
                                	$stmt->fetch();
                                }
           				?>
           					
						
						<?php
							if( $restart )
							{
						?>
							<table class="style1">
	                            
	                            <tr>
									<td class="style2" colspan=2>
                                        <h2>
										Aguarde, o sistema ser&aacute reiniciado para aplicar as novas configura&ccedil&otildees.
                                        </h2>
	                                </td>
								</tr>
	                            <tr>
									<td class="style2" colspan=2>
										Redirecionamento autom&aacutetico em <span id="clock1">60</span> segundos.
	                                </td>
								</tr>
							</table>
								<script>setTimeout('getSecs()',1000);</script>
						<?php		
							}
							else
							{
						?>
						<form method="post" name="rede" >

                                    <h2>
									ATEN&Ccedil;&Atilde;O:</strong> Par&acirc;metros incorretos causam a perda de conex&atilde;o!
                                    </h2>


						<table class="style1">
							
							<tr>
								<td class="style2">
									Hostname:
                                </td>
								<td class="style2">
                                    <input name="hostname" type="text" value="<?php echo $hostname;?>" maxlength=16  />
                                </td>
							</tr>
							
							<tr>
								<td class="style2" colspan=2>
									Interface eth0 (VoIP) 
                                </td>
								<td class="style2">
                                </td>
							</tr>
                                    
							<tr>
								<td class="style2">
                                    DHCP:
                                </td>
                                <td class="style2">
									<input type="radio" name="dhcp0" value="1" <?php if( $dhcp0 == 1 ){echo "checked";}?> onclick="desabilita_a( 0 );">Enable
								    <br/>
								    <input type="radio" name="dhcp0" value="0" <?php if( $dhcp0 == 0 ){echo "checked";}?> onclick="habilita_a( 0 );">Disable
								</td>
							</tr>
                            
							<tr id="ip0_manual" <?php if( $dhcp0 ){ echo "style='visibility:hidden'"; } ?> >
								<td class="style2">
                                    IP:
                                </td>
								<td class="style2">
                                    <input type="text" name="ip0" value="<?php echo $ip0;?>" maxlength="15" />
                                </td>
							</tr>
							
							<tr id="mask0_manual" <?php if( $dhcp0 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    M&aacute;scara:
                                </td>
								<td class="style2">
                                    <input type="text" name="mask0" value="<?php echo $mask0;?>" maxlength="15" />
                                </td>
							</tr>
								
							<tr id="gw0_manual" <?php if( $dhcp0 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    Gateway:
                                </td>
								<td class="style2">
                                    <input type="text" name="gw0" value="<?php echo $gw0;?>" maxlength="15" />
                                </td>
							</tr>
								
							<tr id="dns0_manual" <?php if( $dhcp0 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    DNS:
                                </td>
								<td class="style2">
                                    <input type="text" name="dns0" value="<?php echo $dns0;?>" maxlength="15" />
                                </td>
							</tr>



							<tr>
								<td class="style2" colspan=2>
									Interface eth1 (Player) 
                                </td>
								<td class="style2">
                                </td>
							</tr>

							<tr>
								<td class="style2">
                                    DHCP:
                                </td>
                                <td class="style2">
									<input type="radio" name="dhcp1" value="1" <?php if( $dhcp1 == 1 ){echo "checked";}?> onclick="desabilita_a( 1 );">Enable
								    <br/>
								    <input type="radio" name="dhcp1" value="0" <?php if( $dhcp1 == 0 ){echo "checked";}?> onclick="habilita_a( 1 );">Disable
								</td>
							</tr>
                            
							<tr id="ip1_manual" <?php if( $dhcp1 ){ echo "style='visibility:hidden'"; } ?> >
								<td class="style2">
                                    IP:
                                </td>
								<td class="style2">
                                    <input type="text" name="ip1" value="<?php echo $ip1;?>" maxlength="15" />
                                </td>
							</tr>
							
							<tr id="mask1_manual" <?php if( $dhcp1 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    M&aacute;scara:
                                </td>
								<td class="style2">
                                    <input type="text" name="mask1" value="<?php echo $mask1;?>" maxlength="15" />
                                </td>
							</tr>
								
							<tr id="gw1_manual" <?php if( $dhcp1 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    Gateway:
                                </td>
								<td class="style2">
                                    <input type="text" name="gw1" value="<?php echo $gw1;?>" maxlength="15" />
                                </td>
							</tr>
								
							<tr id="dns1_manual" <?php if( $dhcp1 ){ echo "style='visibility:hidden'"; } ?>>
								<td class="style2">
                                    DNS:
                                </td>
								<td class="style2">
                                    <input type="text" name="dns1" value="<?php echo $dns1;?>" maxlength="15" />
                                </td>
							</tr>




							<tr>
                                <td class="style2">
                                </td>
                                <td class="style2">
                                    <input type='submit' value='Atualizar' >
                                </td>
                            </tr>
                            
						</table>
						
						</form>
						
						<?php
							}
						?>
					</div>		
				</div>



