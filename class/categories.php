<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

require_once('database.php');

class Categories {
	private $db;
	function Categories() {
		$this->db = new Database();
	}
	function getCats($picid,$what='*') {
		$picide = (int) $picid;
		return $this->db->query('SELECT prefix_categories.'.$what.' FROM prefix_categories, prefix_catassoc WHERE prefix_categories.id = prefix_catassoc.catid AND prefix_catassoc.picid = '.$picid);
	}
	function getAllCats() {
		return $this->db->query('SELECT * FROM prefix_categories');
	}
	function newCat($title, $descr) {
		return $this->db->query('INSERT INTO prefix_categories (`title`, `description`) VALUES ("'.$title.'", "'.$descr.'");');
	}
	function pic2cat($picid,$catid) {
		return $this->db->query('INSERT INTO prefix_catassoc (`picid`, `catid`) VALUES ('.$picid.', '.$catid.');');
	}
	function del($id){
		return $this->db->query('DELETE FROM prefix_categories WHERE `id`='.$id);
	}
	function del_assoc($picid,$catid) {
		return $this->db->query('DELETE FROM prefix_catassoc WHERE `picid`='.$picid.' AND `catid`='.$catid);
	}

	public function getHash() {
		$str='';
		foreach($this->args as $arg){
			if(is_string($arg)) $str.=$arg;
			elseif(is_array($arg)) $str.=implode($arg);
			elseif(is_numeric($arg)) $str.=$arg;
			elseif(is_object($arg)) $str.=$arg->getHash();
		}
		return sha1($str);
	}
}
?>
