<?php
require_once('settings.php');
require_once('class/template.php');

$file = preg_split('/\//',$_GET['file']);
if(count($file)<2) exit;
if(strlen($file[1])<1) exit;
if(!in_array($file[0], Array('styles', 'css', 'js'))) exit;
if(!file_exists('templates/'.$template.'/'.$file[0].'/'.$file[1])) exit;
$tmp = new Template($file[0].'/'.$file[1], NULL);
$tmp->render(FALSE);
?>
