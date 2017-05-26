<?php
	require_once ('Avtoradosti.php');
	require_once ('Helper.php');

	set_time_limit(300);

	function getAvtoradostiPrices () {
		$avtoradosti = new Avtoradosti();
		return $avtoradosti->parseAllPages();
	}

	function getCSV ($site, $arr) {
		$head = array ('Сайт', 'Категория', 'Группа', 'Подгруппа', 'Название товара', 'Цена', 'Наличие');
		$file = $site.'_'.date('d-m-Y').'.csv';
		$fp = fopen($file, 'w');
		fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
		fputcsv($fp, $head);
		foreach ($arr as $row) {
			fputcsv($fp, $row);
		}
		fclose($fp);
		return $file;
	}

	if (isset($_POST['getAvtoradostiData'])) {
		$site='avtoradosti.com.ua';
		$arr = getAvtoradostiPrices();
		echo getCSV ($site, $arr);
	}