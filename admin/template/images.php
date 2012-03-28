<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>template/styles/main.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $this->url; ?>template/styles/archive.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery.hoverpulse.js"></script>

  </head>
  <body>
    <?php include($this->header); ?>
    <div id="page">
    <?php if(strlen($this->msg)>0) echo '<div id="msg">'.$this->msg.'</div>'; ?>
    <div id="upload">
    <form action="<?php echo $this->url; ?>admin/?site=images" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ini_get('upload_max_filesize')*1024*1024; ?>" />
        <input type="file" name="picture" /><br />
        Titel: <input type="text" name="title" /><br />
        Description: <textarea name="descr"></textarea><br />
        Datum: <input type="text" name="date" value="<?php echo date('Y-m-d H:i:s'); ?>" /><br />
        <input type="submit" value="Send" />
    </form>
    </div>
    <?php foreach ($this->pics as $pic) { ?>
        <div class="thumb">
            <div class="thumbwrapper">
                <a href="<?php echo $this->url.'admin/?site=edit&id='.$pic['id']; ?>">
                <img class="thumbnails" src="<?php echo $this->url.$this->thumbdir.'thumb_'.$pic['image']; ?>" />
                </a>
                <div class="thumb_title"><?php echo $pic['title']; ?></div>
            </div>
        </div>
    <?php } ?>
    </div>
  </body>
</html>
