	/*** Manipulação de data e hora ***/
function ultimoDiaMes(mes, ano)
{
	var ultimoDia=[];
	ultimoDia[0] = 31;
	ultimoDia[1] = 28;
	ultimoDia[2] = 31;
	ultimoDia[3] = 30;
	ultimoDia[4] = 31;
	ultimoDia[5] = 30;
	ultimoDia[6] = 31;
	ultimoDia[7] = 31;
	ultimoDia[8 ] = 30;
	ultimoDia[9 ] = 31;
	ultimoDia[10] = 30;
	ultimoDia[11] = 31;
	
	if((mes == 2) && (anoBissexto(ano)))
		return(ultimoDia[mes - 1] + 1);
	
	return(ultimoDia[mes - 1]);
}

function anoBissexto(ano)
{
	return((ano & 0x03) == 0);
}

function mascaraCampo(campo, separador)
{
	var valor = campo.value;
	var total = 0;
	
	for(i = 0 ; i < valor.length ; i++)
	{
		if(valor.substring(i, i+1) == separador)
		{
			total++;
		}
	}
	
	if((valor.length == 2) ||
	   (valor.length == 5))
	{
		if((valor.substring(valor.length-1, valor.length) != separador) && (total < 2))
		{
			campo.value += separador;
		}
	}
}

function digitaNumero(e)
{
	var tecla = 0;
	
	if(document.all)tecla = event.keyCode;	  // IE
	else if(document.layers) tecla = e.which; // Netscape
	
	if((tecla > 47) && (tecla < 58))
		return(true);
	
	if(tecla != 8)
		event.keyCode = 0;
	else
		return(true);
}

function DataHoraVerifica()
{
	var campoData  = document.getElementById( 'rec_dt' );
	var campoHora= document.getElementById( 'rec_hr' );
	var campo1	= ( campoData.value.substring( 0, 2 ) );
	var campo2	= ( campoData.value.substring( 3, 5 ) ); 
	var campo3	= ( campoData.value.substring( 6, 10 ) );
	var err_data = 0;
	var err_hora = 0;
	var msg = '';
	
	if( ( campoData.value.charAt( 2 ) != "/" ) || ( campoData.value.charAt( 5 ) != "/" ) )	err_data = 2;
	if(	( campoHora.value.charAt( 2 ) != ":" ) || ( campoHora.value.charAt( 5 ) != ":" ) )	err_hora = 2;
	
	if( ( ( campo1 >= 1  ) && ( campo1 <= ultimoDiaMes( campo2, campo3 ) ) ) &&
		( ( campo2 >= 1  ) && ( campo2 <= 12 ) ) &&
		( ( campo3 >= 08 ) && ( campo3 <= 99 ) ) )
	{
		campo1 = ( campoHora.value.substring( 0, 2 ) );
		campo2 = ( campoHora.value.substring( 3, 5 ) );
		campo3 = ( campoHora.value.substring( 6, 9 ) );
		
		if( ( ( campo1 >= 0 )  && ( campo1 < 24 ) ) &&
			( ( campo2 >= 0 )  && ( campo2 < 60 ) ) &&
			( ( campo3 >= 0 )  && ( campo3 < 60 ) ) )
			err_hora = err_hora;
		else
			err_hora = 2;
	}
	else
		err_data = 2;
		
	if( campoData.value.length != campoData.maxLength )	err_data = 1;
	if( campoHora.value.length != campoHora.maxLength )	err_hora = 1;
	
	switch( err_data )
	{
		case 1: msg = 'A data está incompleta'; break;
		case 2: msg = 'A data não está no formato DD/MM/AA'; break;
	}
	
	switch( err_hora )
	{
		case 1: msg += '\n\nA hora está incompleta'; break;
		case 2: msg += '\n\nA hora não está no formato HH:MM:SS'; break;
	}

	if( err_data || err_hora )
	{
		alert(msg);
		return false;
	}

	return true;
}

	/*** Manipulação de senha ***/
function SenhaExibe( indice )
{
	var divEdit    	= document.getElementById('edit');
	var tipoUsu		= document.getElementById('usu');
	var campoSenha 	= document.getElementById('pwd_s1');
	var campoConf 	= document.getElementById('pwd_s2');
	
	tipoUsu.value 		= indice;
	campoSenha.value 	= '';
	campoConf.value		= '';	
	divEdit.style.display = '';

	campoSenha.focus();
}

function SenhaVerifica()
{
	var campoSenha = document.getElementById('pwd_s1');
	var campoConf  = document.getElementById('pwd_s2');
	var err = 0;
	var msg ='';

	if( campoSenha.value.length != 	campoSenha.maxLength )	err = 1;
	if( campoConf.value.length  != 	campoConf.maxLength ) 	err = 1;
	if( campoSenha.value 		!= 	campoConf.value )		err = 2;

	switch( err )
	{
		case 1: msg = 'A senha deve possuir 8 caracteres';		campoSenha.focus(); break;
		case 2: msg = 'Os valores informados são diferentes';	campoSenha.focus();	break;
	}

	if( err )
	{
		alert( msg );
		return false;
	}

	return true;
}

function SenhaCancela()
{
	var divEdit = document.getElementById('edit');
	divEdit.style.display = 'none';
}

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
				alert("Falha na comunicação.\nConexão com equipamento perdida.");
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

//kick off the AJAX Updater
setTimeout( "pollAJAX()", 500 );

