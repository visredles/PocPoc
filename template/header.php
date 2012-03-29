<div id="header">
    <div id="menu">
        <?php if($_GET['site']=='show') echo '<a href="#" onClick="showmain();">info</a> &nbsp;·&nbsp; <a href="#" onClick="showexif();">exif</a> &nbsp;·&nbsp;' ?>
        <a href="<?php echo $this->url; ?>">Current</a>
        &nbsp;·&nbsp;
        <a href="<?php echo $this->url; ?>archive">Archiv</a>
        &nbsp;·&nbsp;
        <a href="<?php echo $this->url; ?>about">about</a>
    </div>
</div>
