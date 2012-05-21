<div id="menu">
<a href="<?php echo $this->url; ?>rss" title="RSS-Feed"><img src="<?php echo $this->url; ?>templates/900/images/rss.png" alt="RSS-Logo"></a>
<?php
if(basename($this->file)=='show.php')
	echo '<a href="https://twitter.com/intent/tweet?text='.urlencode($this->title.' - '.$this->url.'pic/'.$this->pic['id']).'" title="Bild zu diesem Link tweeten" target="_blank"><img alt="Twitter-Logo" src="'.$this->url.'templates/900/images/twitter.png"></a>';
?>
<a href="<?php echo $this->url; ?>" title="Aktuelles Bild">Current</a>
<a href="<?php echo $this->url; ?>random" title="Zufälliges Bild">Random</a>
<a href="<?php echo $this->url; ?>archive" title="Bilderarchiv">Archiv</a>
<a href="<?php echo $this->url; ?>about" title="Impressum usw">About</a>
</div>
