<?xml version="1.0" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->title; ?></title>
<link href="<?php echo $this->url; ?>templates/900/styles/main.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->url; ?>templates/900/styles/show.css" type="text/css" rel="stylesheet" />
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $this->url; ?>rss" />
<link rel="shortcut icon" href="<?php echo $this->url; ?>favicon.ico" />
</head>
<body>
<div id="mainbody">
<?php include $this->header; ?>
<div id="image" style="height:<?php echo $this->pic['size'][1]; ?>px;">
<?php if($this->prevId>-1) echo '<div id="left"><a class="nav" href="'.$this->url.'pic/'.$this->prevId.'"></a></div>'; ?>
<?php if($this->nextId>-1) echo '<div id="right"><a class="nav" href="'.$this->url.'pic/'.$this->nextId.'"></a></div>'; ?>
<img src="<?php echo $this->url.$this->imagedir.$this->pic['image']; ?>" alt="<?php echo $this->pic['title']; ?>" <?php echo $this->pic['size'][3]; ?> />
</div>
<div id="underimg">
<div id="info">
<h2><a href="<?php echo $this->url.'pic/'.$this->pic['id']; ?>" title="Permalink zu diesem Bild"><?php echo $this->pic['title']; ?></a></h2>
Published on <?php echo date("d.m.Y H:i",strtotime($this->pic['date'])); ?>
<div id="descr"><?php echo $this->pic['description']; ?></div>
</div>
<div id="exif">
Camera: <span class="exifitem"><?php echo $this->exif['model']; ?></span><br />
Focal length: <span class="exifitem"><?php echo $this->exif['focal']; ?></span><br />
Aperture: <span class="exifitem"><?php echo $this->exif['aperture']; ?></span><br />
Shutter: <span class="exifitem"><?php echo $this->exif['exposure']; ?></span><br />
ISO: <span class="exifitem"><?php echo $this->exif['iso']; ?></span><br />
Captured: <span class="exifitem"><?php echo date("d.m.Y H:i:s",strtotime($this->exif['date'])); ?></span>
</div>
<div id="comments">
<?php if(strlen($this->msg)>0) echo '<div id="msg">'.$this->msg.'</div>'; ?>
<form id="commentform" method="POST" action="<?php echo $this->url.'pic/'.$this->pic['id']; ?>">
<label for="author">Name *</label><input type="text" id="author" name="author" value="<?php echo htmlspecialchars($_COOKIE['name']); ?>" /><br />
<label for="email">Email *</label><input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_COOKIE['email']); ?>" /><br />
<label for="homepage">Homepage</label><input type="text" id="homepage" name="homepage" value="<?php echo urldecode($_COOKIE['homepage']); ?>" /><br />
<input type="hidden" name="key" value="<?php echo ($this->priv_key - $_SESSION['key']); ?>" />
<textarea id="text" name="text"></textarea><br />
<label style="width:200px;text-align:left">
<input id="cookie" name="cookie" type="checkbox" value="yes" style="float:none;" />&nbsp;Ja, ich will nen Keks
</label>
<input id="submit" type="submit" value="Senden" />
</form>
<?php
foreach((array) @$this->pic['comments'] as $comment) {
?>
<div class="comment">
<?php
	echo ((strlen($comment['homepage'])>0)?'<a href="'.$comment['homepage'].'">'.$comment['author'].'</a>':$comment['author']);
?>
 - <p class="date"><?php echo $comment['date']; ?></p>
<div class="comments_text"><?php echo nl2br(htmlspecialchars(stripslashes($comment['text']))); ?></div>
</div>
<?php
}
?>
</div>
</div>
</div>
</body>
</html>
