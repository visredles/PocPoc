<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>template/main.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?php include $this->header; ?>
    <div id="error"><?php echo $this->text; ?></div>
    <?php include $this->footer; ?>
  </body>
</html>
