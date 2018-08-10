
	<style type="text/css">
    div.painel_e {
 			padding: 5px;
 			background: #EEEEEE;
 			width: 338px;
 		} 

    .style1 {
        	font-family: Arial, Helvetica, sans-serif;
        	width: 62px;
        	border: none !important;
            width: 100%;
            text-align: right;
        }

    .style2 {
        	font-size:12px;
        	height: 22px;
            width: 50px;
            text-align: left;
            font-weight:bold;
            border: none !important;
        }
    </style>

				<!-- ***************** Lado Esquerdo ***************** -->
				<div class="left">

        <p>
					<br />
        </p>

    </div>

    <!-- ***************** Lado Direiro ***************** -->
    <div class="right">
   
   					<div class="painel_e">
   					
            	<h2>
                	Data / Hora
                <br />
            </h2>
									<table class="style1">
                                    	
                                        <tr>
                                            <td class="style2">
												Atual:
                                            </td>
                                            <td class="style2">
                                                <span id='data_hora' ></span>
                                            </td>
                                        </tr>
									</table>
										
                                    <form method='post' action='process.php?tipo=edit&link=data'>
                                    	
                                    	<table class="style1">
                                    	
                                        <tr>
                                            <td class="style2">
												Data:
                                            </td>
                                            <td class="style2">
                                                <input type='text' id='aj_data' name='data' size=35 maxlength=10 />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="style2">
												Hora:
                                            </td>
                                            <td class="style2">
                                                <input type='text' id='aj_hora' name='hora' size=35 maxlength=8 />
                                            </td>
                                        </tr>

                                        
										<tr>
			                                <td class="style2">
				                            <br />
				                        	</td>
				                   		</tr>
				
				                    	<tr>
				                        	<td class="style2">
			                                	&nbsp;
			                                </td>
			                                <td class="style2">
                            					<input type='submit' value='Atualizar' />
			                                </td>
			                            </tr>
										
										</table>
									</form>
					</div>
				</div>
				
				<script>

				/*** AJAX ***/
				/**
				 * Determines when a request is considered "timed out"
				 */
				var timeOutMS = 5000; //ms
				 
				/**
				 * Stores a queue of AJAX events to process
				 */
				var ajaxList = new Array();

				/**
				 * Initiates a new AJAX command
				 *
				 * @param   the url to access
				 * @param   the document ID to fill, or a function to call with response XML (optional)
				 * @param	true to repeat this call indefinitely (optional)
				 * @param   a URL encoded string to be submitted as POST data (optional)
				 */
				function newAJAXCommand( url, container, repeat, data )
				{
					// Set up our object
					var newAjax = new Object();
					var theTimer = new Date();
					newAjax.url = url;
					newAjax.container = container;
					newAjax.repeat = repeat;
					newAjax.ajaxReq = null;
					
					// Create and send the request
					if( window.XMLHttpRequest )
					{
				        newAjax.ajaxReq = new XMLHttpRequest();
				        newAjax.ajaxReq.open( ( data == null )?"GET":"POST", newAjax.url, true );
				        newAjax.ajaxReq.send( data );
				    // If we're using IE6 style (maybe 5.5 compatible too)
				    } 
					else if( window.ActiveXObject )
					{
				        newAjax.ajaxReq = new ActiveXObject("Microsoft.XMLHTTP");
				        if( newAjax.ajaxReq )
						{
				            newAjax.ajaxReq.open( ( data==null )?"GET":"POST", newAjax.url, true );
				            newAjax.ajaxReq.send( data );
				        }
				    }
				    
				    newAjax.lastCalled = theTimer.getTime();
				    
				    // Store in our array
				    ajaxList.push( newAjax );
				}

				/**
				 * Loops over all pending AJAX events to determine
				 * if any action is required
				 */
				function pollAJAX()
				{
					
					var curAjax = new Object();
					var theTimer = new Date();
					var elapsed;
					
					// Read off the ajaxList objects one by one
					for( i = ajaxList.length; i > 0; i-- )
					{
						curAjax = ajaxList.shift();
						if(!curAjax)
							continue;
						elapsed = theTimer.getTime() - curAjax.lastCalled;
								
						// If we suceeded
						if(curAjax.ajaxReq.readyState == 4 && curAjax.ajaxReq.status == 200)
						{
							// If it has a container, write the result
							if( typeof( curAjax.container ) == 'function' )
							{
								curAjax.container( curAjax.ajaxReq.responseXML.documentElement );
							}
							else if( typeof( curAjax.container ) == 'string' )
							{
								document.getElementById(curAjax.container).innerHTML = curAjax.ajaxReq.responseText;
							} // (otherwise do nothing for null values)
							
					    	curAjax.ajaxReq.abort();
					    	curAjax.ajaxReq = null;

							// If it's a repeatable request, then do so
							if( curAjax.repeat )
								newAJAXCommand( curAjax.url, curAjax.container, curAjax.repeat );
							continue;
						}
						
						// If we've waited over 1 second, then we timed out
						if(elapsed > timeOutMS) {
							// Invoke the user function with null input
							if( typeof( curAjax.container ) == 'function' )
							{
								curAjax.container( null );
							}
							else
							{
								// Alert the user
								alert("Falha na comunica��o.\nConex�o com equipamento perdida.");
							}

					    	curAjax.ajaxReq.abort();
					    	curAjax.ajaxReq = null;
							
							// If it's a repeatable request, then do so
							if( curAjax.repeat )
								newAJAXCommand( curAjax.url, curAjax.container, curAjax.repeat );
							continue;
						}
						
						// Otherwise, just keep waiting
						ajaxList.push( curAjax );
					}
					
					// Call ourselves again in 500ms
					setTimeout("pollAJAX()",500);
					
				}// End pollAjax
							
				/**
				 * Parses the xmlResponse returned by an XMLHTTPRequest object
				 *
				 * @param	the xmlData returned
				 * @param	the field to search for
				 */
				function getXMLValue( xmlData, field )
				{
					try
					{
						if(xmlData.getElementsByTagName(field)[0].firstChild.nodeValue)
							return xmlData.getElementsByTagName(field)[0].firstChild.nodeValue;
						else
							return null;
					} 
					catch(err) { return null; }
				}

				newAJAXCommand( 'datahora.php', 'data_hora', true, 0 );
				
				//kick off the AJAX Updater
				setTimeout( "pollAJAX()", 500 );
					
				</script>
