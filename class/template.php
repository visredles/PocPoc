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
        global $url;
        $this->file = $file;
        $this->args = $args;
        $this->args['header'] = 'template/header.php';
        $this->args['footer'] = 'template/footer.php';
        $this->args['url']    = $url;
    }

    public function render() {
        session_start();
        header('Content-type: text/html; Charset=utf-8');
        include $this->file;
    }
}
?>
