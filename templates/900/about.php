<?xml version="1.0" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->title; ?></title>
<link href="<?php echo $this->url; ?>styles/main.css" type="text/css" rel="stylesheet" />
<link href="<?php echo $this->url; ?>styles/about.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="<?php echo $this->url; ?>favicon.ico" />
</head>
<body>
<div id="mainbody">
<?php include $this->header; ?>
<div id="browse_main">
<div id="aboutbox">
<?php echo $this->content; ?>
</div>
</div>
</div>
</body>
</html>
