<?xml version="1.0" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->title; ?></title>
<link href="<?php echo $this->url; ?>styles/main.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->url; ?>styles/archive.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo $this->url; ?>favicon.ico" />
</head>
<body>
<div id="mainbody">
<?php include $this->header; ?>
<?php foreach ($this->pics as $pic) { ?>
<div class="thumb">
<div class="thumbwrapper">
<a href="<?php echo $this->url.'pic/'.$pic['id']; ?>"><img alt="<?php echo $pic['title']; ?>" class="thumbnails" src="<?php echo $this->url.$this->thumbdir.'thumb_'.$pic['image']; ?>" /></a>
<div class="thumb_title"><?php echo $pic['title']; ?></div>
</div>
</div>
<?php } ?>
</div>
</body>
</html>
