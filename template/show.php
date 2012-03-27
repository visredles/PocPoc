<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <!-- nextId: <?php echo $this->nextId; ?>, prevId: <?php echo $this->prevId; ?> -->
    <link href="<?php echo $this->url; ?>template/main.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery.effects.core.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>template/scripts/jquery.superbgimage.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $.fn.superbgimage.options = { speed: 'fast' };
            $('#image').superbgimage().hide();
            $("#left").click(function () {
                window.location='<?php echo $this->url; ?>pic/<?php echo $this->prevId; ?>';
            });
            $("#right").click(function () {
                window.location='<?php echo $this->url; ?>pic/<?php echo $this->nextId; ?>';
            });
            $("#menu").html("<a href='#' onClick='showexif();'>exif</a> &nbsp;·&nbsp;" + $("#menu").html());
        });
        function showexif() {
            $('#exifbox').css({'opacity' : 0.9 });
            $('#exifbox').toggle();
            $('#exifboxtitle').css({'opacity' : 0.65 });
            $('#exifboxtitle').toggle(); 
        }
    </script>

  </head>
  <body>
    <?php include $this->header; ?>
    <div id="exifwrapper">
        <div id="exifboxtitle"><p class="exiftitle">exif informationen</p></div>
        <div id="exifbox">
            <div id="exif">
                Camera: <span class="exifitem"><?php echo $this->exif['model']; ?></span><br />
                Focal length: <span class="exifitem"><?php echo $this->exif['focal']; ?></span><br />
                Aperture: <span class="exifitem"><?php echo $this->exif['aperture']; ?></span><br />
                Shutter: <span class="exifitem"><?php echo $this->exif['exposure']; ?></span><br />
                ISO: <span class="exifitem"><?php echo $this->exif['iso']; ?></span><br />
                Captured: <span class="exifitem"><?php echo date("d.m.Y H:i:s",strtotime($this->exif['date'])); ?></span>
            </div>
        </div>
    </div>
    <div id="wrap">
        <?php if($this->prevId>-1) echo '<div id="left"></div>'; ?>
        <?php if($this->nextId>-1) echo '<div id="right"></div>'; ?>
    </div>
    <div id="image">
        <a class="activeslide" href="<?php echo $this->url.$this->imagedir.$this->pic['image']; ?>" alt="<?php echo $this->pic['title']; ?> rel='1'">1</a>
    </div>
    <?php include $this->footer; ?>
  </body>
</html>
