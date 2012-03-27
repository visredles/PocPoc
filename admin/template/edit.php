<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>template/main.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?php include $this->header; ?>
    <div id="page">
    <?php if(strlen($this->msg)>0) echo '<div id="msg">'.$this->msg.'</div>'; ?>
        <div id="thumb"><img src="<?php echo $this->url.$this->thumbdir.'thumb_'.$this->pic['image'] ?>" /></div>
        <div id="editform">
            <form action="<?php echo $this->url.'admin/?site=edit&id='.$this->pic['id']; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ini_get('upload_max_filesize')*1024*1024; ?>" />
                <input type="file" name="picture" /><br />
                Titel: <input type="text" name="title" value="<?php echo $this->pic['title']; ?>" /><br />
                Description: <textarea name="descr"><?php echo $this->pic['description']; ?></textarea><br />
                Datum: <input type="text" name="date" value="<?php echo $this->pic['date']; ?>" /><br />
                <input type="submit" value="Send" />
            </form>
        </div>
    </div>
  </body>
</html>
