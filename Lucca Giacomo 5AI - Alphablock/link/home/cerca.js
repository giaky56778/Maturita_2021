function mostra(str)
{
	if (str.length == 0)
	{
		document.getElementById("risposta").innerHTML = "";
		return;
	}
	if (window.XMLHttpRequest)
		ajax = new XMLHttpRequest();  // browser IE7+, Firefox, Chrome, Opera, Safari
	else                        
		ajax = new ActiveXObject("Microsoft.XMLHTTP");// browser IE6, IE5
		
	ajax.onreadystatechange = function()
	{
		if (ajax.readyState == 4 && ajax.status == 200)
			document.getElementById("risposta").innerHTML = ajax.responseText;
	}
	ajax.open("GET", "ricerca.php?stringa=" + str, true);
	ajax.send();
}