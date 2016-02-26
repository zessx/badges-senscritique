<?php

// Required: PHPHtmlParse (https://packagist.org/packages/paquettg/php-html-parser)
require_once 'vendor/autoload.php';

use PHPHtmlParser\Dom;
$dom = new Dom;

for ($i = 1; $i <= 1500; $i++) {

	$dom->load('http://www.senscritique.com/badge/'. $i);
	$title = $dom->find('title')[0];
	
	if (preg_match('/^Badge :/', $title->text)) {
		print '<a href="http://www.senscritique.com/badge/'. $i .'" class="badge">';
			print '<img src="'. $dom->find('img.acvi-achievement')[0]->src .'">';
			print ucfirst(preg_replace('/^Badge : (.+?) - SensCritique$/', '$1', $title->text));
		print '</a>'. PHP_EOL;
	}
	
}
