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
$com = new Comments();
switch ($_GET['site']) {
    case "about":
        $fh = fopen('about.htm','r');
        $about = fread($fh, filesize('about.htm'));
        $out = new Template('about.php', array('title' => 'About', 'content' => $about));
        break;
    case "archive":
        $pics = $img->getImages('id, title, image');
        $out = new Template('archive.php', array('title' => 'Archiv', 'num_pics' => count($pics), 'pics' => $pics, 'thumbdir' => $thumbdir));
        break;
    case "random":
        $ids=$img->getImages('id');
        $id = $ids[array_rand($ids)]['id'];
        header('Location: '.$url.'pic/'.$id);
        exit;
    case "show":
        if(isset($_POST['cookie'])) {
	        $expire = time()+60*60*24*30*6; // TODO: nach settings.php verschieben. Aktueller Wert: 6 Monate
	        setcookie('name',$_POST['author'],$expire);
		$_COOKIE['name']=urlencode($_POST['author']);
	        setcookie('email',$_POST['email'],$expire);
		$_COOKIE['email']=urlencode($_POST['email']);
	        setcookie('homepage',$_POST['homepage'],$expire);
		$_COOKIE['homepage']=urlencode($_POST['homepage']);
	}
	if(isset($_POST['author']) || isset($_POST['email']) || isset($_POST['homepage']) || isset($_POST['text'])) {
		if($com->newComment((int) $_GET['id'],$_POST['author'],$_POST['email'],$_POST['homepage'],$_POST['text']))
			$msg = 'Dein Kommentar wurde erfolgreich abgesendet.';
		else
			$msg = 'Fehler bei der Kommentarabgabe. Bitte überprüfe deine Angaben.';
	}
        if(isset($_GET['id'])) $pic = $img->getImage((int) $_GET['id']);
        else {
            $picid = $img->getImages('id','1');
            $pic = $img->getImage($picid[0]['id']);
        }
        if(!is_array($pic))
            $out = new Template('error.php', array('title' => 'Bild nicht gefunden.', 'text' => 'Das gewünschte Bild wurde nicht gefunden.'));
        else
            $pic['size'] = getimagesize($imagedir.$pic['image']);
            $out = new Template('show.php', array('title' => $pic['title'], 'pic' => $pic, 'imagedir' => $imagedir, 'nextId' => $img->getNextId($pic['date']), 'prevId' => $img->getPrevId($pic['date']), 'exif' => $exif->get($imagedir.$pic['image']), 'msg' => $msg ));
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
        $out = new Template ('error.php',
            array('title' => ((!isset($codes[$_GET['site']][0])?'Fehler':$codes[$_GET['site']][0])),
                  'text'  => ((!isset($codes[$_GET['site']][1])?'Es ist ein Fehler aufgetreten.':$codes[$_GET['site']][1]).' Falls du einem Link gefolgt bist, sag mir bitte Bescheid.')
                  )
        );
}
$out->render();

?>
