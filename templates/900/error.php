<html>
<head>
<title><?php echo $this->title; ?></title>
<link href="<?php echo $this->url; ?>templates/900/styles/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo $this->url; ?>templates/900/styles/about.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $this->url; ?>favicon.ico" />
</head>
<body>
<div id="mainbody">
<?php include $this->header; ?>
<div id="browse_main">
<?php echo $this->text; ?>
</div>
</div>
</div>
</body>
</html>
