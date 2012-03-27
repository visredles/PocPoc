<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>template/main.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?php include $this->header; ?>
    <div id="page">
    <?php if(strlen($this->msg)>0) echo '<div id="msg">'.$this->msg.'</div>'; ?>
        <div id="editform">
            <form action="<?php echo $this->url.'admin/?site=settings' ?>" method="post">
<?php foreach($this->content as $key=>$val) {
                echo "$key<input type='text' name='$key' value='$val' /><br />";
} ?>
                <input type="submit" name="submit" value="save" />
            </form>
        </div>
    </div>
  </body>
</html>
