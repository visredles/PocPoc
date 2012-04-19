<html>
    <head>
        <title><?php echo $this->title; ?></title>
        <link href="<?php echo $this->url; ?>templates/900/styles/main.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="mainbody">
            <?php include $this->header; ?>
            <div id="image">
                <?php if($this->prevId>-1) echo '<div id="left"><a class="nav" href="'.$this->url.'pic/'.$this->prevId.'"></a></div>'; ?>
                <?php if($this->nextId>-1) echo '<div id="right"><a class="nav" href="'.$this->url.'pic/'.$this->nextId.'"></a></div>'; ?>
                <img src="<?php echo $this->url.$this->imagedir.$this->pic['image']; ?>" alt="<?php echo $this->pic['title']; ?>">
            </div>
            <div id="underimg">
                <div id="info">
                    <h2><?php echo $this->pic['title']; ?></h2>
                    Published on <?php echo date("d.m.Y H:i",strtotime($this->pic['date'])); ?>
                    <div id="descr"><?php echo $this->pic['description']; ?></div>
                </div>
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
    </body>
</html>
