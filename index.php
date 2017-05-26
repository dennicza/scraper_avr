<?php
	ini_set('memory_limit', '128M');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>parsery saitov</title>
	<style>
		table, th, td {
			border: 1px solid black;
		}
		button {
			margin: 10px;
			padding: 5px;
		}
		.active {
			cursor: pointer;
		}
	</style>
</head>
<body>
	<h1>Парсинг сайтов</h1>
	<div id="avtoradosti_lnk">
		<button class="active" id="avtoradosti" onclick="getAvtoradostiData()">Парсить данные с <b>avtoradosti.com.ua</b></button>
	</div>

	<script type="text/javascript" src="ajax.js"></script>
	<script type="text/javascript" src="avtoradosti_ajax.js"></script>
</body>
</html>