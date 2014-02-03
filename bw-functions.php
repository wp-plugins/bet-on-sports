<?php

function live() {
	return Bw_xml::get_live();
}

function livestream() {
	return Bw_xml::get_livestream();
}

function results() {
	return Bw_xml::get_results();
}

function sports($parse_type,$lang = 'en_US') {
	return Bw_xml::get_sports($parse_type,$lang);
}

function deleteOptions() {

	$args = func_get_args();
	$num = count($args);

	if ($num == 1) {
		return (delete_option($args[0]) ? TRUE : FALSE);
	} elseif ($num > 1) {
		foreach ($args as $option) {
			if (!delete_option($option))
				return FALSE;
		}
		return TRUE;
	}
	return FALSE;
}

function rus2translit($string) {

	$converter = array(
		'а' => 'a', 'б' => 'b', 'в' => 'v',
		'г' => 'g', 'д' => 'd', 'е' => 'e',
		'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
		'и' => 'i', 'й' => 'y', 'к' => 'k',
		'л' => 'l', 'м' => 'm', 'н' => 'n',
		'о' => 'o', 'п' => 'p', 'р' => 'r',
		'с' => 's', 'т' => 't', 'у' => 'u',
		'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
		'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
		'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
		'А' => 'A', 'Б' => 'B', 'В' => 'V',
		'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
		'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
		'И' => 'I', 'Й' => 'Y', 'К' => 'K',
		'Л' => 'L', 'М' => 'M', 'Н' => 'N',
		'О' => 'O', 'П' => 'P', 'Р' => 'R',
		'С' => 'S', 'Т' => 'T', 'У' => 'U',
		'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
		'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
		'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
	);

	return strtr($string, $converter);
}

function str2url($str) {

	// переводим в транслит

	$str = rus2translit($str);

	// в нижний регистр

	$str = strtolower($str);

	// заменям все ненужное нам на "-"

	$str = preg_replace('~[^-a-z0-9_]+~u', '_', $str);

	// удаляем начальные и конечные '-'

	$str = trim($str, "-");

	return $str;
}

function get_oddid_link($oddID) {

	@$link .= 'https://affiliates.bet-at-home.com/processing/clickthrgh.asp?';
	$link .= 'btag=' . get_option('BW_ab_link');
	$link .= '&lang=' . get_option('BW_ab_lang');
	$link .= '&oddid=' . $oddID;


	return $link;
}
