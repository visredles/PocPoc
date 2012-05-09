<html>
  <head>
    <title><?php echo $this->title; ?></title>
    <link href="<?php echo $this->url; ?>templates/default/styles/main.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $this->url; ?>templates/default/styles/archive.css" type="text/css" rel="stylesheet">
    <link href="<?php echo $this->url; ?>admin/templates/default/comments.css" type="text/css" rel="stylesheet">
  </head>
  <body>
    <?php include($this->header); ?>
    <div id="page">
    <?php if(strlen($this->msg)>0) echo '<div id="msg">'.$this->msg.'</div>'; ?>
    <table>
    <tr>
    	<th>#</th><th>pic</th><th>author</th><th>text</th><th>email</th><th>url</th><th>date</th><th>delete</th><th>active</th>
    </tr>
    <?php foreach ($this->comments as $comment) { ?>
    <tr style="border:1px solid #000">
    	<td><?php echo $comment['id']; ?></td>
    	<td><a href="<?php echo $this->url; ?>pic/<?php echo $comment['picid']; ?>"><?php echo $comment['picid']; ?></a></td>
	<td><?php echo $comment['author']; ?></td>
	<td><div style="width:200px;height:100px;overflow:hidden;"><?php echo htmlspecialchars(stripslashes($comment['text'])); ?></div></td>
	<td><a href="mailto:<?php echo $comment['email']; ?>"><?php echo $comment['email']; ?></a></td>
	<td><a href="<?php echo $comment['homepage']; ?>"><?php echo $comment['homepage']; ?></td>
	<td><?php echo $comment['date']; ?></td>
	<td><a href="<?php echo $this->url; ?>admin/?site=comments&action=del&id=<?php echo $comment['id']; ?>">DELETE</a></td>
	<td><a href="<?php echo $this->url; ?>admin/?site=comments&action=setactive&id=<?php echo $comment['id']; ?>&bool=<?php echo ($comment['active']?'false':'true'); ?>"><?php echo ($comment['active']?'true':'false'); ?></td>
    </tr>
    <?php } ?>
    </div>
  </body>
</html>
