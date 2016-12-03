<?php

require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;
$dom = new Dom;

$from = isset($_GET['from']) ? intval($_GET['from']) : 1;
$to   = isset($_GET['to'])   ? intval($_GET['to'])   : 1500;

$blocked = array();
for ($i = $from; $i <= $to; $i++) {

	$url = sprintf('http://www.senscritique.com/badge/%u', $i);
	$dom->load($url);
	$title = $dom->find('title')[0];

	if ($title->text == 'You have been blocked') {
		$blocked[] = $url;
	}
	if (preg_match('/^Badge :/', $title->text)) {
		printf(
			'<a href="%s" class="badge"><img src="%s">%s</a>' . PHP_EOL,
			$url,
			$dom->find('img.acvi-achievement')[0]->src,
			ucfirst(preg_replace('/^Badge : (.+?) - SensCritique$/', '$1', $title->text))
		);
	}

}

if (count($blocked) > 0) {
	printf('<br>Blocked:<br>%s', implode('<br>', $blocked));
}