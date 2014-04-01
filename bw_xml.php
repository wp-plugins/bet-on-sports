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

	public function get_sports($parse_type = 'simplexml_load_file', $lang = 'en_US') {
		
		if ($lang == 'en_US') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsEN.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsEN.xml');
			return $xml;
		}

		if ($lang == 'ru_RU') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sports.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sports.xml');
			return $xml;
		}
		
		if ($lang == 'de_DE') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsDE.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsDE.xml');
			return $xml;
		}
		if ($lang == 'pt_PT') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsPT.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsPT.xml');
			return $xml;
		}
		if ($lang == 'it_IT') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsIT.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsIT.xml');
			return $xml;
		}
		if ($lang == 'es_ES') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsES.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsES.xml');
			return $xml;
		}
		if ($lang == 'cs_CZ') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsCZ.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsCZ.xml');
			return $xml;
		}
		if ($lang == 'pl_PL') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsPL.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsPL.xml');
			return $xml;
		}
		if ($lang == 'lt_LT') {
			if ($parse_type == 'simplexml_load_file')
				$xml = simplexml_load_file('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsEN.xml');

			if ($parse_type == 'file_get_contents')
				$xml = file_get_contents('http://www.bukmekerskajakontora.ru/wp-content/themes/gameday/xml/sportsEN.xml');
			return $xml;
		}
	}

}

?>
