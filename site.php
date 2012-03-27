<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

require_once('settings.php');
require_once('class/template.php');
require_once('class/images.php');
require_once('class/exif.php');

global $url,$thumbdir,$imagedir;

$img = new Images();
$exif = new Exif();

switch ($_GET['site']) {
    case "about":
        $fh = fopen('about.htm','r');
        $about = fread($fh, filesize('about.htm'));
        $out = new Template('template/about.php', array('title' => 'About', 'content' => $about));
        break;
    case "archive":
        $pics = $img->getImages('id, title, image');
        $out = new Template('template/archive.php', array('title' => 'Archiv', 'num_pics' => count($pics), 'pics' => $pics, 'thumbdir' => $thumbdir));
        break;
    case "random":
        $id = array_rand($img->getImages('id'));
        header('Location: '.$url.'pic/'.$id);
        exit;
    case "home":
    case "show":
        if(isset($_GET['id'])) $pic = $img->getImage((int) $_GET['id']);
        else {
            $pic = $img->getImages('*','1');
            $pic = $pic[0];
        }
        if(!is_array($pic))
            $out = new Template('template/error.php', array('title' => 'Bild nicht gefunden.', 'text' => 'Das gewünschte Bild wurde nicht gefunden.'));
        else
            $out = new Template('template/show.php', array('title' => $pic['title'], 'pic' => $pic, 'imagedir' => $imagedir, 'nextId' => $img->getNextId($pic['date']), 'prevId' => $img->getPrevId($pic['date']), 'exif' => $exif->get($imagedir.$pic['image']) ));
        break;
    default:
        $codes = array( 
            403 => array('403 verboten', 'Du kommst hir nicht rein.'), 
            404 => array('404 nicht gefunden', 'Die Datei/URL wurde nicht gefunden.'), 
            405 => array('405 Methode nicht erlaubt', 'Die Methode ist nicht erlaubt.'),
            408 => array('408 Anfragen-Zeitüberschreitung', 'Bei deiner Anfrage kam es zu einer Zeitüberschreitung.'), 
            500 => array('500 Interner Diener Fehler', 'Bei der Bearbeitung deiner Anfrage, kam es zu einem unbekannten Fehler.'), 
            502 => array('502 Schlechter Knoten', ' Irgendwo auf der Strecke zwischen dir und dieser Seite gab es einen Fehler..'), 
            504 => array('504 Knoten Zeitüberschreitung', 'Irgendwo auf der Strecke zwischen dir und dieser Seite ist eine Schnarchnase.') 
        ); 
        $out = new Template ('template/error.php',
            array('title' => ((!isset($codes[$_GET['site']][0])?'Fehler':$codes[$_GET['site']][0])),
                  'text'  => ((!isset($codes[$_GET['site']][1])?'Es ist ein Fehler aufgetreten.':$codes[$_GET['site']][1]).' Falls du einem Link gefolgt bist, sag mir bitte Bescheid.')
                  )
        );
}
$out->render();

?>
