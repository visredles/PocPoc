<?php
/* This software was written by Markus Bach <markus@derpaderborner.de>
 * It is licensed as beerware. So drink up and get me a beer!
 * Just kidding. Have fun with this piece of crap.
 */

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

    public function render($cache=TRUE) {
    	global $cachedir;
    	$hash=$this->getHash();
	if(extension_loaded('zlib') && pathinfo($this->file,PATHINFO_EXTENSION)) ob_start('ob_gzhandler');
	else ob_start();
	if(file_exists($cachedir.$hash.'.html')) $this->load($cachedir.$hash.'.html');
	else {
		$this->load($this->file);
		if(!$GLOBALS['acp'] && $cache) $this->save_cached(ob_get_contents(),$hash);
	}
	ob_end_flush();
    }
    private function load($file) {
    	$ext=pathinfo($file,PATHINFO_EXTENSION);
    	switch ($ext) {
		case 'php':
		    	session_start();
			header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header('Content-type: text/html; Charset=utf-8');
			header('Expires: '.gmdate('D, d M Y H:i:s',strtotime('now')));
			include $file;
			break;
		case 'html':
			session_start();
		case 'js':
		case 'css':
			header('Last-Modified: '.gmdate('D, d M Y H:i:s',filemtime($file)).' GMT');
			header('Expires: '.gmdate('D, d M Y H:i:s',strtotime('+1 month')));
			header('Content-type: text/'.$ext.'; Charset=utf-8');
			readfile($file);
			break;
		case 'ico':
		case 'jpg':
		case 'png':
		case 'jpeg':
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			header('Last-Modified: '.gmdate('D, d M Y H:i:s',filemtime($file)).' GMT');
			header('Expires: '.gmdate('D, d M Y H:i:s',strtotime('+1 year')));
			header('Content-type: '.finfo_file($finfo, $file).'; Charset=utf-8');
			readfile($file);
			break;
	}
    }
    private function save_cached($content,$hash) {
    	global $cachedir;
	$fh=fopen($cachedir.$hash.'.html','w');
	fwrite($fh,$content);
	fclose($fh);
    }
    public function getHash() {
	return $this->getHash2($this->args);
    }
    public function getHash2($arg) {
    	if(is_string($arg)) $res=$arg;
	elseif(is_array($arg)) foreach($arg as $a) $res.=$this->getHash2($a);
	elseif(is_object($arg))	$res=$arg->getHash();
	elseif(is_resource($arg)) $res=42;
	else $res=(string) $arg;
	return sha1($res);
    }
}
?>
