<html>
<head>
<title><?php echo $this->title; ?></title>
<link href="<?php echo $this->url; ?>templates/default/styles/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo $this->url; ?>templates/default/styles/about.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include $this->header; ?>
<div id="browse_main">
<div id="aboutbox">

<?php echo $this->content; ?>

</div>
<?php include $this->footer; ?>
</div>
</body>
</html>
