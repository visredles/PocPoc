<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>templates/900/styles/main.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $this->url; ?>templates/900/styles/archive.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <div id="mainbody">
    <?php include $this->header; ?>
    <?php foreach ($this->pics as $pic) { ?>
        <div class="thumb">
            <div class="thumbwrapper">
                <a href="<?php echo $this->url.'pic/'.$pic['id']; ?>">
                <img class="thumbnails" src="<?php echo $this->url.$this->thumbdir.'thumb_'.$pic['image']; ?>" />
                </a>
                <div class="thumb_title"><?php echo $pic['title']; ?></div>
            </div>
        </div>
    <?php } ?>
    </div>
  </body>
</html>
