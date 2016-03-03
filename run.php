<?php

// Required: PHPHtmlParse (https://packagist.org/packages/paquettg/php-html-parser)
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;
$dom = new Dom;

$from = isset($_GET['from']) ? intval($_GET['from']) : 1;
$to   = isset($_GET['to'])   ? intval($_GET['to'])   : 1500;

for ($i = $from; $i <= $to; $i++) {

	$dom->load('http://www.senscritique.com/badge/'. $i);
	$title = $dom->find('title')[0];

	if (preg_match('/^Badge :/', $title->text)) {
		print '<a href="http://www.senscritique.com/badge/'. $i .'" class="badge">';
			print '<img src="'. $dom->find('img.acvi-achievement')[0]->src .'">';
			print ucfirst(preg_replace('/^Badge : (.+?) - SensCritique$/', '$1', $title->text));
		print '</a>'. PHP_EOL;
	}

}
