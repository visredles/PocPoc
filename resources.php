<?php
require_once('settings.php');
require_once('class/template.php');

if($_GET['root']) $_GET['file']='../../'.$_GET['file'];
if(!file_exists('templates/'.$template.'/'.$_GET['file'])) exit;
if(!in_array(pathinfo($_GET['file'],PATHINFO_EXTENSION), Array('png','js','css','jpg','jpeg','ico'))) exit;

$tmp = new Template($_GET['file'], NULL);
$tmp->render(FALSE);
?>
