<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */
require_once('settings.php');

class Template {
    private $args;
    private $file;

    public function __get($name) {
        return $this->args[$name];
    }

    public function __construct($file, $args = array()) {
        global $url,$template;
        if(!is_dir('templates/'.$template)) $template='default';
        $this->file = 'templates/'.$template.'/'.$file;
        $this->args = $args;
        $this->args['header'] = 'templates/'.$template.'/header.php';
        $this->args['footer'] = 'templates/'.$template.'/footer.php';
        $this->args['url']    = $url;
    }

    public function render() {
    	global $cachedir;
    	$hash=$this->getHash();
	if(file_exists($cachedir.$hash) && !$GLOBALS['acp']) $this->load($cachedir.$hash);
	else {
		ob_start();
		$this->load($this->file);
		$this->save_cached(ob_get_contents(),$hash);
		ob_end_flush();
	}
    }
    private function load($file) {
    	session_start();
    	header('Content-type: text/html; Charset=utf-8');
	include $file;
    }
    private function save_cached($content,$hash) {
    	global $cachedir;
	$fh=fopen($cachedir.$hash,'w');
	fwrite($fh,$content);
	fclose($fh);
    }
    public function getHash() {
    	$str='';
    	foreach($this->args as $arg){
	    if(is_string($arg)) $str.=$arg;
	    elseif(is_numeric($arg)) $str.=$arg;
	    elseif(is_object($arg)) $str.=$arg->getHash();
	}
	return sha1($str);
    }

}
?>
