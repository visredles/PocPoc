<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>templates/default/styles/main.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $this->url; ?>templates/default/styles/show.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo $this->url; ?>templates/default/scripts/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>templates/default/scripts/jquery.effects.core.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->url; ?>templates/default/scripts/jquery.superbgimage.min.js"></script>
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
        });
        function showexif() {
            $('#exifbox').toggle();
            $('#exifboxtitle').toggle(); 
        }
        function showmain() {
            $('#main').toggle();
            $('#title').toggle();
        }
    </script>

  </head>
  <body>
    <?php include $this->header; ?>
    <div id="mainwrapper">
        <div class="boxtitle" id="title"><p class="title"><?php echo $this->pic['title']; ?></p></div>
        <div class="box" id="main">
            <div class="scroll">
                <div id="notes">
<?php echo $this->pic['description']; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="exifwrapper">
        <div class="boxtitle" id="exifboxtitle"><p class="title">exif informationen</p></div>
        <div class="box" id="exifbox">
            <div class="scroll" id="exif">
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
