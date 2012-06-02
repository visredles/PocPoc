<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

class Database {
    public  $data_array;

    function Database() {
        global $db;
    }
    function connect() {
        global $db, $dbconnect;
        $dbconnect = @mysql_connect($db['hostname'],$db['username'],$db['password']) or header('Location: admin/?site=settings');
        mysql_select_db($db['database'],$dbconnect) or trigger_error("SQL",E_USER_ERROR);
    }
    function query($query) {
        global $db,$dbconnect;
        $this->data_array = Array();
        if(!isset($dbconnect)) $this->connect();
        $query = preg_replace('/prefix_/',$db['prefix'],$query);
        $result= mysql_query($query,$dbconnect) or trigger_error("SQL", E_USER_ERROR);
        if(is_bool($result)) return $result;
        while ($row = mysql_fetch_assoc($result)) {
            $this->data_array[] = $row;
        }
        mysql_free_result($result);      
        return $this->data_array;
    }
    function escape($string) {
    	global $dbconnect;
        if(!isset($dbconnect)) $this->connect();
    	return mysql_real_escape_string($string,$dbconnect);
    }
    public function getHash() {
    	return FALSE;
    }
}
?>
