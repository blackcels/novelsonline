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
            <li><a href="/back/"> <img id = "panda" src="<?php echo DS."private/img/panda.png"; ?>"></a></li>

        </ul>
    </nav>
</header>
<br>
<?php include "views/".$this->tpl."".$this->view;?>
<br>

</body>

<footer>
    <li><a href="#">Legal Notice</a></li>
    <li><a href="#">Use conditional</a></li>
    <li><a href="#">RSS</a></li>
</footer>
</html>