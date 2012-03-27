<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */
$_GLOBALS['acp'] = true;

require_once('../settings.php');
require_once('../class/template.php');
require_once('../class/images.php');
require_once('../class/exif.php');

$img = new Images();
$exif = new Exif();

global $thumbdir;

switch ($_GET['site']) {
    case 'edit':
        if(isset($_GET['id']) && (isset($_POST['title']) || isset($_POST['date']) || isset($_POST['descr']) || isset($_FILES['picture']))) {
            if(!$img->update($_GET['id'], $_POST['date'], $_POST['title'], $_POST['descr'], $_FILES['picture'])) $msg = 'Fehler beim editieren.';
            else $msg = 'Die Änderungen wurden erfolgreich hochgeladen.';
        }
        if(!isset($_GET['id'])) {
            $out = new Template('../template/error.php', array('title' => 'Fehler', 'text' => 'o.O wat soll ich editieren??'));
            break;
        }
        $pic = $img->getImage((int) $_GET['id'] );
        if(!is_array($pic)) $out = new Template('../template/error.php', array('title' => 'Fehler', 'text' => 'Sorry, aber es gibt kein Bild mit der ID '.$_GET['id'].' in meiner DB'));
        else $out = new Template('template/edit.php', array('title' => $pic['title'].' bearbeiten', 'pic' => $pic, 'exif' => $exif->get('../'.$imagedir.$pic['image']), 'thumbdir' => $thumbdir, 'msg' => $msg ));
        break;
    case 'settings':
        if(count($_POST)) {
            foreach($_POST as $key => $val) {
                if(is_array($val)) {
                    foreach($val as $key2 => $val2)
                        $line[]='$'.$key.'['.stripslashes($key2).']=\''.$val2.'\';';
                }
                elseif($key!='submit')
                    $line[]='$'.$key.'=\''.$val.'\';';
            }
            $fh=fopen('../settings.php','w');
            fwrite($fh,"<?php\n/* These settings were updated via PocPoc's ACP\n * Pleace be careful while editing.\n * Last edited: ".date("d.m.Y H:i:s")."\n */\n\n");
            foreach($line as $val)
                fwrite($fh,$val."\n");
            fwrite($fh,'?>');
            fclose($fh);
        }
        $content = file('../settings.php');
        foreach($content as $line) {
            $line = trim($line);
            if(substr($line,0,1)=='$')
                $options[htmlspecialchars(substr($line,1,strpos($line,'=')-1),ENT_QUOTES)] = htmlspecialchars(trim(substr($line,strpos($line,'=')+1,-1),"'"),ENT_QUOTES);
        }
        $out = new Template('template/settings.php', array('title' => 'Settings', 'content' => $options));
        break;
    case 'images':
    default:
        $msg = '';
        if(isset($_POST['date']) && isset($_POST['title']) && isset($_POST['descr']) && isset($_FILES['picture'])) {
            if(!$img->upload($_POST['date'],$_POST['title'],$_POST['descr'],$_FILES['picture'])) $msg = 'Fehler beim hochladen der Datei!';
            else $msg = 'Das Bild "'.$_POST['title']." wurde erfolgreich hochgeladen.";
        }
        $pics = $img->getImages('id, title, image, date');
        $out = new Template('template/images.php', array('title' => 'Bilderverwaltung', 'pics' => $pics, 'thumbdir' => $thumbdir, 'msg' => $msg));
        break;
}
$out->render();
?>
