<div id="menu">
<?php if(basename($this->file)=='show.php') echo '<a href="https://twitter.com/intent/tweet?text='.urlencode($this->title.' - '.$this->url.'pic/'.$this->pic['id']).'" target="_blank"><img style="float:left;" src="'.$this->url.'templates/900/images/twitter.png"></a>'; ?>
<a href="<?php echo $this->url; ?>">Current</a> <a href="<?php echo $this->url; ?>random">Random</a> <a href="<?php echo $this->url; ?>archive">Archiv</a> <a href="<?php echo $this->url; ?>about">About</a></div>
