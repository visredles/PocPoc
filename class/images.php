<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

require_once('database.php');
require_once('comments.php');

class Images {
    private $db;
    function Images() {
        $this->db = new Database('pics');
    }
    function getImage($id,$what='*') {
        $id=(int) $id;
        $result = $this->db->query('SELECT '.$what.' FROM <table> WHERE `id`='.$id.($GLOBALS['acp']?'':' AND `date`<now()').';');
	$com = new Comments();
	$result[0]['comments']=$com->getComments($id);
        return $result[0];
    }
    function getImages($what='*',$limit='') {
        return $this->db->query('SELECT '.$what.' FROM <table> '.($GLOBALS['acp']?'':'WHERE `date`<now()').' ORDER BY `date` DESC'.(empty($limit)?';':' LIMIT '.$limit.';'));
    }
    function getNextId($date) {
        $res=$this->db->query('SELECT id FROM <table> WHERE '.($GLOBALS['acp']?'':'`date`<now() AND ').'`date`>"'.$date.'" ORDER BY `date` ASC LIMIT 1;');
        if(is_array($res) AND is_array($res[0])) return $res[0]['id'];
        return;
    }
    function getPrevId($date) {
        $res=$this->db->query('SELECT id FROM <table> WHERE '.($GLOBALS['acp']?'':'`date`<now() AND ').'`date`<"'.$date.'" ORDER BY `date` DESC LIMIT 1;');
        if(is_array($res) AND is_array($res[0])) return $res[0]['id'];
        return;
    }
    function upload($date,$title,$descr,$pic) {
        if(!$GLOBALS['acp']) return false;
        global $imagedir;
        $newpic = date('YmdHis').'_'.basename($pic['name']);
        if(!move_uploaded_file($pic['tmp_name'],'../'.$imagedir.$newpic)) return false;
        if(!$this->thumbnail($newpic)) return false;
        return $this->db->query('INSERT INTO <table> (date, title, description, image) VALUES ("'.$date.'", "'.$title.'", "'.$descr.'", "'.$newpic.'");');
    }
    function thumbnail($pic) {
        global $thumbnail,$thumbdir,$imagedir;
        list($width, $height) = getimagesize('../'.$imagedir.$pic);
        $thumb = imagecreatetruecolor($thumbnail['w'], $thumbnail['h']);
        if(!$source = @imagecreatefromjpeg('../'.$imagedir.$pic)) {
            unlink('../'.$imagedir.$pic);
            return false;
        }
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $thumbnail['w'], $thumbnail['h'], $width, $height);
        return imagejpeg($thumb, '../'.$thumbdir.'thumb_'.$pic, $thumbnail['q']);
    }
    function update($id,$date='',$title='',$descr='',$pic='') {
        if(!$GLOBALS['acp']) return false;
        global $imagedir;
        if(!$id) return false;
        if(is_array($pic) && $pic['size']>0 && $pic['error']==0) {
            $filename = $this->db->query('SELECT image FROM <table> WHERE id='.$id.';');
            $filename=$filename[0]['image'];
            if(!move_uploaded_file($pic['tmp_name'],'../'.$imagedir.$filename)) return false;
            if(!$this->thumbnail($filename)) return false;
        }
        $up = (isset($title)?" title='$title',":'').(isset($date)?" date='$date',":'').(isset($descr)?" description='$descr',":'');
        if(strlen($up)>0 && substr($up,-1)==',') $up=substr($up,0,-1);
        return $this->db->query('UPDATE <table> SET'.$up.' WHERE id=\''.$id.'\';');
    }
}
?>
