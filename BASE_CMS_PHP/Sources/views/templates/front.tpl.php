
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="<?php echo DS; ?>public/css/test.css" />

</head>
<body>
<header>
    <nav>
        <ul class="clearfix">
            <li><img src="<?php echo DS."private/img/panda.png"; ?>"></li>
            <li><a href="/novels/">Novels</a></li>
            <li><a href="/update/">Update</a></li>
            <li><a href="/rss/">RSS</a></li>
        </ul>
    </nav>
</header>
<?php include "views/".$this->tpl."".$this->view;?>
</body>
<footer>
    <li><a href="#">Legal Notice</a></li>
    <li><a href="#">Use conditional</a></li>
    <li><a href="#">RSS</a></li>
</footer>
</html>