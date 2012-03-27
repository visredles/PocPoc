<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>template/main.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery.hoverpulse.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('div.thumbwrapper img').hoverpulse().each(function() {
                var $img = $(this);
            });
        }); 
    </script>

  </head>
  <body>
    <?php include $this->header; ?>
    <div id="page">
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
    <?php include $this->footer; ?>
  </body>
</html>
