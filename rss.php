<?php
require_once('settings.php');
require_once('class/images.php');

$img = new Images();
$imgs = $img->getImages();

$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$rss = $xml->createElement('rss');
$rss->setAttribute('version', '2.0');
$xml->appendChild($rss);
$channel = $xml->createElement('channel');
$rss->appendChild($channel);
#$title = $xml->createElement('title', utf8_encode('PocPoc'));
$channel->appendChild($xml->createElement('title', utf8_encode('PocPoc')));
$channel->appendChild($xml->createElement('description', utf8_encode('Feed von '.$url)));
$channel->appendChild($xml->createElement('language', utf8_encode('de')));
$channel->appendChild($xml->createElement('link', utf8_encode($url)));
$channel->appendChild($xml->createElement('lastBuildDate', utf8_encode(date("D, j M Y H:i:s ",strtotime($imgs[0]['date'])).'GMT')));

foreach($imgs as $pic) {
    $item = $xml->createElement('item');
    $channel->appendChild($item);
    $item->appendChild($xml->createElement('title', $pic['title']));
#    $item->appendChild($xml->createElement('description')->appendChild($xml->createCDATASection('<img src="'.$url.$thumbdir.'thumb_'.$pic['image'].'" alt="'.$pic['title'].'" />'.$pic['description'])));
    $descr = $xml->createElement('description');
    $item->appendChild($descr);
    $descr->appendChild($xml->createCDATASection('<a href="'.$url.'pic/'.$pic['id'].'"><img src="'.$url.$thumbdir.'thumb_'.$pic['image'].'" alt="'.$pic['title'].'" /></a>'.$pic['description']));
    $item->appendChild($xml->createElement('link', utf8_encode($url.'pic/'.$pic['id'])));
    $item->appendChild($xml->createElement('pubDate', utf8_encode(date("D, j M Y H:i:s ",strtotime($pic['date'])).'GMT')));
    $item->appendChild($xml->createElement('guid', utf8_encode($url.'pic/'.$pic['id'])));
}
echo $xml->saveXML();
?>
