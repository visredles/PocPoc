<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

require_once('database.php');

class Comments {
	private $db;
	function Comments() {
		$this->db = new Database('comments');
	}
	function getComments($picid,$limit='') {
		$picide = (int) $picid;
		return $this->db->query('SELECT * FROM <table> WHERE picid='.$picid. ($GLOBALS['acp']?'':' AND `active`=1').' ORDER BY `date` DESC'.(empty($limit)?';':' LIMIT '.$limit.';'));
	}
	function getAllComments() {
		return $this->db->query('SELECT * FROM <table> '.($GLOBALS['acp']?'':'WHERE `active`=1 ').' ORDER BY `date` DESC');
	}
	function newComment($id=-1,$author='',$email='',$homepage='',$text='') {
		if($id==-1 || strlen($author)==0 || strlen($email)==0 || strlen($text)==0)
			return false;
		if(!preg_match('/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i', $email)) return false;
		if(!preg_match('/^(https?|ftp):\/\/(?:[A-Z0-9-]+.)+[A-Z]{2,6}([\/?].+)?$/i', $homepage)) $homepage='';

		return $this->db->query(sprintf("INSERT INTO <table> (`picid`, `author`, `email`, `homepage`, `text`, `date`, `active`) VALUES ('%u', '%s', '%s', '%s', '%s', now(), 0);",
			(int) $id,
			$this->db->escape($author),
			$this->db->escape($email),
			$this->db->escape($homepage),
			$this->db->escape($text)))==1;
	}
	function setactive($id,$active=false) {
		return $this->db->query("UPDATE <table> SET `active`=$active WHERE `id`=$id;");
	}
	function del($id){
		return $this->db->query("DELETE FROM <table> WHERE `id`=$id");
	}
}
?>
