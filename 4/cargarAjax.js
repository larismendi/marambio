// JavaScript Document
function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try 
	{ 
		// Creacion del objeto AJAX para navegadores distintos a IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function cargarAjax(programa,contenedor)	
{	
	//alert('entra a la funcion ok...'+programa);		   
	var obj=nuevoAjax();
	obj.open('GET',programa,true);
	obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	obj.onreadystatechange = function()
	{
		if (obj.readyState == 4)
		{
			if(obj.status == 200)
				txt=unescape(obj.responseText);
				txt2=txt.replace(/\+/gi," ");
				document.getElementById(contenedor).innerHTML = txt2;
		}
	}		
	obj.send(null);	
}