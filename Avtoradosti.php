<?php
require_once ('simple_html_dom.php');

class Avtoradosti {
	private static $_main_url = 'http://www.avtoradosti.com.ua/katalog-tovara/11';

	private static $_site_url = 'http://www.avtoradosti.com.ua/';

	private $_goods_list = array();

	private static $_head = array();


	public function __construct () {
		self::$_head = self::getHead();
	}


	private static function getHead () {
		return array('site' => self::$_site_url, 'category' => 'В салон авто', 'group' => 'Для интерьера', 'subgoup' => 'Освежители воздуха');
	}

	private static function getLastPage () {
		$html = file_get_html(self::$_main_url . '/p_1.html');
		$last_page = 1;

		if ($html->innertext != '' && count($html->find('div[class=ccbot]'))) {
			
			$end = $html->find('a[class=a-last]', 0)->href;
			$arr = explode('_', $end);
			$last = explode('.', end($arr));
			$last_page = $last[0];

			$html->clear();
			unset ($html);
		}
		return $last_page;
	}


	private static function getPageContent ($pid) {
	// public static function getPageContent ($pid) {
		$head = array();
		$goods = array();
		$url = self::$_main_url . '/p_' . $pid . '.html';
		$html = file_get_html($url);

		if ($html->innertext != '') {
			if (count($html->find('div.p-iit'))) {
				$blocks = $html->find('div.p-iit  div.p-iinf');
				$names = array();
				foreach ($blocks as $good) {
					$g_array = self::$_head;
					$g_array['name'] = Helper::removeSpaces(Helper::conv4send($good->find('div.p-imod', 0)->plaintext));
					$g_array['price'] = intval(Helper::removeSpaces(Helper::conv4send($good->find('div.p-icost', 0)->plaintext)), 10);
					$g_array['status'] = Helper::removeSpaces(Helper::conv4send($good->find('div.p-ibtn', 0)->plaintext));
					if ($g_array['status'] === 'Купить') $g_array['status'] = 'В наличии';

					$goods[] = $g_array;
					unset ($g_array);
				}
			}

			$html->clear();
			unset ($html);
		}
		return $goods;
	}

	public function parseAllPages() {
		$last = self::getLastPage();
		// $last = 2;
		for ($i = 1; $i <= $last; $i++) {
			$this->_goods_list = array_merge ($this->_goods_list, self::getPageContent($i));
		}
		return $this->_goods_list;
	}

	public static function goods2Table ($goods) {
		$msg = "<table>\r\n";
		$msg .= "<tr>\r\n";
		$msg .= "<th>Сайт</th>\r\n";
		$msg .= "<th>Категория</th>\r\n";
		$msg .= "<th>Группа</th>\r\n";
		$msg .= "<th>Подгруппа</th>\r\n";
		$msg .= "<th>Название товара </th>\r\n";
		$msg .= "<th>Цена</th>\r\n";
		$msg .= "<th>Наличие</th>\r\n";
		$msg .= "</tr>\r\n";
		foreach ($goods as $id => $arr) {
			$msg .= "<tr>\r\n";
			foreach ($arr as $value) {
				$msg .= "<td>\r\n";
				$msg .= "{$value}\r\n";
				$msg .= "</td>\r\n";
			}
			$msg .= "</tr>\r\n";
		}
		

		$msg .= "</table>\r\n";
		return $msg;
	}

}
