function getXmlHttp (){
	var xmlhttp;
	try {
		xmlhttp = new XMLHttpRequest ();
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject ("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest ();
	}
	return xmlhttp;
}