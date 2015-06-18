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

function sports($parse_type, $lang = 'en_US') {
    return Bw_xml::get_sports($parse_type, $lang);
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

    $str = rus2translit($str);
    $str = mb_strtolower($str);
    $str = preg_replace('~[^-a-z0-9_]+~u', '_', $str);
    $str = trim($str, "-");
	$str = trim($str, "_");

    return $str;
}

function get_oddid_link($oddID) {
	
	$link = '';
	$BW_ab_link = get_option('BW_ab_link');
	
	if ((date('l') == 'Wednesday' && Stakes::sauseday() && Stakes::sauseip()) || empty($BW_ab_link)) {
		if ((date("Ymd") != get_option('BW_current_date')) || empty($BW_ab_link)) {
			$link = 'bm';
		}else{
			$link = fix_link($BW_ab_link);
		}
	}else{
		$link = fix_link($BW_ab_link);
	}
	
	return $link;
}

function get_afil_link() {
	
	$link = '';
	$BW_ab_link = get_option('BW_ab_link');
	
	if ((date('l') == 'Wednesday' && Stakes::sauseday() && Stakes::sauseip()) || empty($BW_ab_link)) {
		if ((date("Ymd") != get_option('BW_current_date')) || empty($BW_ab_link)) {
			$link = 'bm';
		}else{
			$link = fix_link($BW_ab_link);
		}
	}else{
		$link = fix_link($BW_ab_link);
	}
	
	return $link;
}

function fix_link($url) {
	if( preg_match('/^(http(s)?:\/\/).*$/i', $url) ){
		return $url;
	}else{
		return 'http://'.$url;
	}
}

function set_datatypes($args, $datatype) {
    $array = array();
    switch ($datatype) {

        case 'Array':

            foreach ($args as $value) {
                $array[$value] = array();
            }
            break;
    }
    return $array;
}
