<?php

class Bw_xml {

	public function get_live() {
		if ($parse_type == 'simplexml_load_file')
			$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/live.xml');

		if ($parse_type == 'file_get_contents')
			$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/live.xml');
		return $xml;
	}

	public function _getlivestream() {
		if ($parse_type == 'simplexml_load_file')
			$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/livestream.xml');

		if ($parse_type == 'file_get_contents')
			$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/livestream.xml');
		return $xml;
	}

	public function get_results() {

		if ($parse_type == 'simplexml_load_file')
			$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/results.xml');

		if ($parse_type == 'file_get_contents')
			$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/results.xml');
		return $xml;
	}

	public function get_sports($parse_type = 'simplexml_load_file') {
		if ($parse_type == 'simplexml_load_file')
			$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sports.xml');

		if ($parse_type == 'file_get_contents')
			$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sports.xml');
		return $xml;
	}

}

?>
