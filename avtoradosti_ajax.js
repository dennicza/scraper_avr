function getAvtoradostiData () {
	var param = 'getAvtoradostiData=1';
	document.getElementById('avtoradosti_lnk').innerHTML = 'Ожидайте - парсер собирает данные';
	var req = getXmlHttp ();
	req.onreadystatechange = function () {
		if (req.readyState == 4) {
			if (req.status == 200) {
				var answer = req.responseText;
				if (answer) {
					document.getElementById('avtoradosti_lnk').innerHTML = "<a class='lnk' href='" + window.location.href + '/' + answer + "' target=_blank>Скачать результат</a>";
				}
			}
		}
	};
	req.open ('POST', '/avtoradosti_ajax.php', true);
	req.setRequestHeader ('Content-Type', 'application/x-www-form-urlencoded');
	req.send (param);
}